<template>
    <div id="app">
        <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2 class="title">
                        discount product
                        <div class="title-bottom-animarion">
                            <img :src="'frontend/assets/logo/Trustshoper-Icon.png'">
                        </div>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6" v-for="product in discountProducts" :key="product.id">
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
                            <div class="price discount">
                                ৳ {{ product.regular_price.toFixed(2) }}
                            </div>
                            <div class="price regular">
                               <del>
                                   ৳ {{ product.regular_price.toFixed(2) }}
                               </del> 
                            </div>                           
<!--                            <div class="add-to-card" v-else>-->
<!--                                <a :href="'/customer/login-form'" class="add-to-card-btn">-->
<!--                                    <i class="fas fa-cart-plus"></i>-->
<!--                                </a>-->
<!--                            </div>-->
                        </div>
                        <div class="add-to-card order-btn-outer">
                            <div class="cart-add-btn">
                                <button @click="addToCart(product)" style="cursor: pointer" class="s-d-btn">
                                    Add to Cart
                                </button>
                                <button @click="addToCart(product)" style="cursor: pointer" class="b-d-btn">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                            <div class="order-btn">
                                <button class="add-to-card-btn" @click="addToCart(product)" style="cursor: pointer">    Order Now
                                </button>
                            </div>
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
                <a :href="'/discount/products'" class="view-all-btn">
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
               discountProducts: []
           }
       },

       mounted(){
           this.products()
       },

       methods: {
           products(){
               axios.get('/api/discount/products')
                .then(response => {
                    this.discountProducts = response.data.products
                })
                .catch(error => {
                    console.log(error);
                })
           },

           addToCart(product){
               axios.post('/add/to/cart/' + product.id,{
                   product_id: product.id,
                   qty:1,
                   user_id:this.$authUserId,
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
    .item-image-inner {
        position: relative;
    }
    .reybond-outer {
        position: absolute;
        top: 0;
        right: 16px;
        background: #154360;
        padding: 10px 6px 20px 15px;
        border-radius: 0px 0px 0px 50px;
    }
    .reybond-outer span {
        font-size: 16px;
        font-family: 'Poppins';
        font-weight: 500;
        color: #fff;
    }
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
    .price.regular {
        color: #4d4d4d;
        font-weight: 400;
    }
    button.s-d-btn {
        display: none;
    }
    .add-to-card.order-btn-outer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 5px;
    }
    .cart-add-btn button{
        color: #154360;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        border: 1px solid #154360;
        background: transparent;
        padding: 5px 10px;
        border-radius: 5px;
        transition: all .3s ease;
    }
    .product-section-item:hover .cart-add-btn button {
        background: #f16522;
        color: #ffffff;
        border-color: transparent;
    }
    @media screen and (max-width:1150px){
        .add-to-card.order-btn-outer {
            display: block;
            padding-top: 0;
        }

        button.b-d-btn {
            display: none;
        }

        button.s-d-btn {
            display: inline-block;
            padding: 5px;
            margin-bottom: 10px;
        }
        .price-cart-btn-wrapper {
            padding-bottom: 0;
        }
    }
</style>
