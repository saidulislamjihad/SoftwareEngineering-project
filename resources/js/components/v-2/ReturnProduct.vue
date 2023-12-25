<template>
    <div>
        <form method="POST" class="return-process-form form-group" @submit.prevent="returnProductProcessForm()" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-item-wrapper">
                        <label for="name">Name</label>
                        <input type="text" name="name" v-model="name" class="form-control" placeholder="Name*">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-item-wrapper">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone" v-model="phone" class="form-control" placeholder="Phone*">
                    </div>
                </div>
<!--                <div class="col-md-6">-->
<!--                    <div class="input-item-wrapper">-->
<!--                        <label for="email">Email</label>-->
<!--                        <input type="email" name="email" v-model="email" class="form-control" placeholder="Email*">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-md-6">
                    <div class="input-item-wrapper">
                        <label for="address">Address</label>
                        <input type="text" name="address" v-model="address" class="form-control" placeholder="Address*">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-item-wrapper">
                        <label for="order_id">Order Id</label>
                        <input type="text" name="order_id" v-model="order_id" class="form-control" placeholder="Order Id*">
                    </div>
                </div>
<!--                <div class="col-md-6">-->
<!--                    <div class="input-item-wrapper">-->
<!--                        <label for="product_id">Product Id</label>-->
<!--                        <input type="text" name="product_id" v-model="product_id" class="form-control" placeholder="Product Id*">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-md-12">
                    <div class="input-item-wrapper">
                        <label for="issue">Define issues</label>
                        <textarea name="issue" v-model="issues" class="form-control" cols="50" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-item-wrapper">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="return-process-btn-outer">
                <button type="submit" id="productReturnProcess" class="return-process-btn-inner">
                    Submit
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "ReturnProduct",
    data(){
        return {
            name: '',
            phone: '',
            email: '',
            address: '',
            order_id: '',
            product_id: '',
            issues: '',
            images: '',

            errorCount: 0,
            nameError: '',
            emailError: '',
            phoneError: '',
            addressError: '',
            imageError: '',
            orderIdError: '',
            productIdError: '',
            issueError: '',

        }
    },
    methods:{
        resetError(){
            this.errorCount = 0
            this.nameError = ''
            this.phoneError = ''
            this.addressError = ''
            this.imageError = ''
            this.orderIdError = ''
            this.productIdError = ''
            this.issueError = ''
        },

        validation_error(){
            if(this.name.length === 0){
                this.nameError = 'Name is required'
                this.errorCount++
            }
            if(this.phone.length === 0){
                this.phoneError = 'Phone is required'
                this.errorCount++
            }

            if(this.address.length === 0){
                this.addressError = 'Address is required'
                this.errorCount++
            }

            if(this.order_id.length === 0){
                this.orderIdError = 'Order id is required'
                this.errorCount++
            }

            if(this.product_id.length === 0){
                this.productIdError = 'Product id is required'
                this.errorCount++
            }

            if(this.issues.length === 0){
                this.issueError = 'Issues is required'
                this.errorCount++
            }
        },
        returnProductProcessForm(){
            this.resetError()
            this.validation_error()

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };

            let customerData = new FormData();
            let productImage = document.getElementById('image').files[0];
            customerData.append('images', productImage);
            customerData.append('name', this.name);
            customerData.append('phone', this.phone);
            customerData.append('email', this.email);
            customerData.append('address', this.address);
            customerData.append('order_id', this.order_id);
            customerData.append('product_id', this.product_id);
            customerData.append('issues', this.issues);

            axios.post('/customer/product/return/info', customerData, config)
                .then(response => {
                    if(response.status == 201){
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your information has been submitted',
                            showConfirmButton: false,
                        })
                        $('#image').val('');
                        this.name = '';
                        this.phone = '';
                        this.email = '';
                        this.address = '';
                        this.order_id = '';
                        this.product_id = '';
                        this.issues = '';
                    }
                }).catch(error => {
                if (error.response.status == 422){
                    if (error.response.data.errors.name && error.response.data.errors.name.length > 0) {
                        this.nameError = error.response.data.errors.name[0]
                    }
                    if (error.response.data.errors.email && error.response.data.errors.email.length > 0) {
                        this.emailError = error.response.data.errors.email[0]
                    }
                    if (error.response.data.errors.phone && error.response.data.errors.phone.length > 0) {
                        this.phoneError = error.response.data.errors.phone[0]
                    }
                    if (error.response.data.errors.address && error.response.data.errors.address.length > 0) {
                        this.addressError = error.response.data.errors.address[0]
                    }

                    if (error.response.data.errors.issues && error.response.data.errors.issues.length > 0) {
                        this.issueError = error.response.data.errors.issues[0]
                    }

                    if (error.response.data.errors.order_id && error.response.data.errors.order_id.length > 0) {
                        this.orderIdError = error.response.data.errors.order_id[0]
                    }

                    if (error.response.data.errors.product_id && error.response.data.errors.product_id.length > 0) {
                        this.productIdError = error.response.data.errors.product_id[0]
                    }
                }
            })
        }

    }
}
</script>

<style scoped>

</style>
