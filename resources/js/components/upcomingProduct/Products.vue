<template>
    <div id="app">
        <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2 class="title">
                        feature	product
                        <div class="title-bottom-animarion">
                            <img :src="'frontend/assets/logo/Trustshoper-Icon.png'">
                        </div>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12" v-for="product in featureProducts" :key="product.id">
                <div class="product-section-item">
                    <div class="product-item-image-outer">
                        <a :href="'/product/details/' + product.id + '/' + product.slug" class="item-image-inner">
                            <img :src="'/product/images/240x240-' + product.image">
                        </a>
                    </div>
                    <div class="product-item-content">
                        <a :href="'/product/details/' + product.id + '/' + product.slug" class="title">
                            {{ product.name.substr(0,25) }}
                        </a>
                        <div class="price-cart-btn-wrapper">
                            <div class="price">
                                ৳ {{ product.regular_price.toFixed(2) }}
                            </div>
                            <div class="add-to-card">
                                <button class="add-to-card-btn" @click="addToCart(product)" style="cursor: pointer">
                                    <!-- <i class="fas fa-cart-plus"></i> -->
                                    Order Now
                                </button>
                            </div>
<!--                            <div class="add-to-card" v-else>-->
<!--                                <a :href="'/customer/login-form'" class="add-to-card-btn">-->
<!--                                    <i class="fas fa-cart-plus"></i>-->
<!--                                </a>-->
<!--                            </div>-->
                        </div>
                        <!-- <div class="single-product-rating">
                            <div class="rating-outer">
                                <ul v-if="product.reviews.length == 0">
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                </ul>
                                <ul v-else>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="far fa-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="total-rating">
                                <span>{{ product.reviews.length }} Review</span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col view-all-btn-outer">
                <a :href="'feature/products'" class="view-all-btn">
                    View All
                </a>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import axios from "axios"

   export default {
       data(){
           return {
               featureProducts: []
           }
       },

       mounted(){
           this.products()
       },

       methods: {
           products(){
               axios.get('/api/feature/products')
                .then(response => {
                    this.featureProducts = response.data.products
                })
                .catch(error => {
                    console.log(error);
                })
           },

           addToCart(product){
               axios.post('/add/to/cart/' + product.id,{
                   product_id: product.id,
                   qty:1,
                   user_id:1,
                   price: product.regular_price,
               }).then(response => {
                   if(response.status == 200){
                       Reload.$emit('afterAddToCart');
                       flash('Product has been successfully added to cart.', 'success');
                   }
                   console.log(response)
               }).catch(error => {
                   console.log(error)
               })
           }
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
