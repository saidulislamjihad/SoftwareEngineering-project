<template>
    <div>
        <div class="row" v-if="this.subcategory.products.length > 0">
            <div class="col-lg-2 col-md-4 col-sm-6" v-for="product in this.subcategory.products" :key="product.id">
                <div class="product-item-wrapper">
                    <div class="product-image-outer">
                        <a :href="'/product/' + product.slug" class="product-imgae">
                            <img :src="'/product/images/' + product.image" class="main-image" alt="product image">
                            <img :src="'/product/images/' + product.image" class="hover-image" alt="product image">
                        </a>
<!--                        <div class="product-action">-->
<!--                            <a class="action-btn" href="#" @click="addToCart(product)">-->
<!--                                <i class="fas fa-shopping-cart"></i>-->
<!--                            </a>-->

<!--                            <a class="action-btn" href="#" data-bs-toggle="modal" data-bs-target="#quickView">-->
<!--                                <i class="fas fa-eye"></i>-->
<!--                            </a>-->
<!--                        </div>-->
                        <div class="product-badges hot">
                            <span style="text-transform: capitalize">{{ product.product_type }}</span>
                        </div>
                    </div>
                    <div class="product-content-outer">
                        <a :href="'/product/' + product.slug" class="product-name">
                            <!--{{ product.name.substr(0,22) }}-->
                            {{ product.name }}
                        </a>
                        <div class="product-item-bottom">
                            <div class="product-price" v-if="product.discount_price == null">
                                <span>{{ product.regular_price }} Tk.</span>
                                <!--<span class="old-price">{{ product.discount_price }} Tk.</span>-->
                            </div>
                            <div class="product-price" v-else>
                                <!--<span>{{ product.regular_price }} Tk.</span>-->
                                <span class="old-price">{{ product.discount_price }} Tk.</span>
                            </div>
                            <div class="add-cart">
                                <button class="add-cart-btn" @click="addToCart(product)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add
                                </button>
                            </div>
                        </div>
                        <a href="#" @click="directOrder(product)" class="quick-order-btn-inner">Quick Order</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-danger" v-else>
            <h2>
                <center>Sorry! Product not found</center>
            </h2>
        </div>
    </div>
</template>

<script>
import axios from "axios"

export default {
    props: ['subcategory'],
    data(){
        return {
            getCategories: [],
            getBrands: [],
            products: [],
            categoryIds: [],
            subcategoryIds: [],
            brandIds: []
        }
    },

    mounted(){
            this.getAllCategory(),
            this.getAllSubcategory(),
            this.getAllBrand()
    },

    methods: {
        getAllCategory(){
            axios.get('/api/get/categories')
                .then(response => {
                    this.getCategories = response.data.categories
                }).catch(error => {
                console.log(error)
            })
        },
        getAllSubcategory(){
            axios.get('/api/get/subcategories')
                .then(response => {
                    this.getSubategories = response.data.subcategories
                }).catch(error => {
                console.log(error)
            })
        },

        getAllBrand(){
            axios.get('/api/get/brands')
                .then(response => {
                    this.getBrands = response.data.brands
                }).catch(error => {
                console.log(error)
            })
        },
        //    addToCart(product){
        //        axios.post('/add/to/cart/' + product.id,{
        //            product_id: product.id,
        //            qty:1,
        //            user_id:1,
        //            price: product.regular_price,
        //        }).then(response => {
        //            if(response.status == 200){
        //                Reload.$emit('afterAddToCart');
        //                flash('Product has been successfully added to cart.', 'success');
        //            }
        //            console.log(response)
        //        }).catch(error => {
        //            console.log(error)
        //        })
        //    },


        addToCart(product){
            axios.post('/add/to/cart/' + product.id,{
                product_id: product.id,
                qty:1,
                user_id:this.$authUserId,
                price: product.discount_price != null ? product.discount_price : product.regular_price,
            }).then(response => {
                if(response.status == 200){
                    this.$swal({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Product added to cart',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    Reload.$emit('afterAddToCart');
                    //window.location.href = '/checkout'
                    //flash('Product has been successfully added to cart.', 'success');
                }
                //console.log(response)
            }).catch(error => {
                if(error.status === 500 || error.status === 422){
                    alert('Something is missing Please try again.')
                }
            })
        },

        directOrder(product){
            if(product.discount_price == null){
                axios.post('/add/to/cart/' + product.id,{
                    product_id: product.id,
                    qty:1,
                    user_id:this.$authUserId,
                    price: product.regular_price,
                }).then(response => {
                    if(response.status == 200){
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Product added to cart',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        Reload.$emit('afterAddToCart');
                        window.location.href = '/checkout'
                        //flash('Product has been successfully added to cart.', 'success');
                    }
                    //console.log(response)
                }).catch(error => {
                    console.log(error)
                })
            }else{
                axios.post('/add/to/cart/' + product.id,{
                    product_id: product.id,
                    qty:1,
                    user_id:this.$authUserId,
                    price: product.discount_price,
                }).then(response => {
                    if(response.status == 200){
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Product added to cart',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        Reload.$emit('afterAddToCart');
                        window.location.href = '/checkout'
                        //flash('Product has been successfully added to cart.', 'success');
                    }
                    //console.log(response)
                }).catch(error => {
                    console.log(error)
                })
            }
        },

        getFilterProduct(){
            axios.post('/api/getFilterProduct', {category_ids:this.categoryIds, subcategory_ids:this.subcategoryIds, brand_ids: this.brandIds} )
                .then(response => {
                    if(this.categoryIds.length > 0 || this.brandIds.length > 0 || this.subcategoryIds.length > 0){
                        this.products = response.data
                    }else{
                        this.subcategoryProducts()
                    }
                }).catch(error => {
                console.log(error)
            })
        },
    }
}
</script>

<style scoped>
.product-item-content .title{
    font-size: 14px;
}
.product-section-item img{
    width: 100%;
    height: 170px;
}
.price-cart-btn-wrapper {
    display: block;
}
.product-item-image-outer {
    margin-bottom: 5px!important;
}
.add-to-card-btn {
    margin: 0;
    padding: 5px 10px;
    background: #fff;
}
.single-product-rating {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 5px;
}
.rating-outer ul {
    padding-left: 0;
    display: flex;
    align-items: center;
    margin-bottom: 0;
}
.rating-outer ul li i {
    color: #154360;
    font-size: 14px;
}
.total-rating span {
    font-size: 14px;
    font-family: 'Poppins';
    font-weight: 500;
}
</style>
