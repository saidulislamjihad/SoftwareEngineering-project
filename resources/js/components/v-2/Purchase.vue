<template>
    <div>
        <form @submit.prevent="purchaseAdd">
            <div class="form-group">
                <label>Customer Name : </label>
                <input type="text" name="customer_name" v-model="customer_name" class="form-control" placeholder="Enter customer name..." />
            </div>
            <div class="input-group mb-3 mt-3" v-for="(input, index) in purchaseData"
                 :key="`nameInput-${index}`">
                <input type="text" name="product_name" v-model="input.product_name" class="form-control" placeholder="Enter product name..." />
                <input type="text" name="qty" id="qty" @change="updateQty(index, input.qty)" v-model="input.qty" class="form-control" placeholder="Enter product qty..." />
                <input type="text" name="price" id="price" @change="updatePrice(index, input.price)" v-model="input.price" class="form-control" placeholder="Enter product per price..." />
                <input type="text" name="total_price" :id="'total_price' + index" v-model="input.total_price" class="form-control" readonly placeholder="Enter product total price..." />
                <div class="input-group-append" style="">
                    <span class="input-group-text" id="basic-addon2" style="cursor: pointer; background-color: #08ff78" @click="addField(input, purchaseData)">
                        <i class='bx bx-plus-circle' style="font-size: 20px;"></i>
                    </span>
                </div>
                <div class="input-group-append" v-show="purchaseData.length > 1">
                    <span class="input-group-text" id="basic-addon3" style="cursor: pointer; background-color: red" @click="removeField(input, purchaseData)">
                        <i class='bx bx-minus-circle' style="font-size: 20px; color: white"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-success">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Purchase",
    data(){
        return {
            purchaseData: [{ qty: "", product_name: "", price: "", total_price: "" }],
            customer_name: '',
        }
    },
    methods: {
        updateQty(i, qty){
            this.purchaseData[i].qty = qty;
            this.purchaseData[i].total_price = parseInt(this.purchaseData[i].qty) * parseInt(this.purchaseData[i].price)
        },
        updatePrice(j, perPrice){
            this.purchaseData[j].price = perPrice;
            this.purchaseData[j].total_price = parseInt(this.purchaseData[j].qty) * parseInt(this.purchaseData[j].price)
        },
        purchaseAdd(){
            axios.post('/purchase/store', {
                customer_name: this.customer_name,
                customer_data: this.purchaseData,
            }).then(response => {
                if (response.status == 200){
                    alert('Purchase has been created');
                }
            }).catch(error => {
                console.log(error)
            })
        },
        addField(value, fieldType) {
            fieldType.push({ value: "" });
        },
        removeField(index, fieldType) {
            fieldType.splice(index, 1);
        },
    },
}
</script>

<style scoped>

</style>
