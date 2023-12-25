<template>
    <div id="app">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6" v-for="product in newArrivalProducts" :key="product.id">
                <div class="product-item-wrapper">
                    <div class="product-image-outer">
                        <a :href="'/product/' + product.slug" class="product-imgae">
                            <img :src="'product/images/' + product.image" class="main-image" alt="product image">
                            <img :src="'product/images/' + product.image" class="hover-image" alt="product image">
                        </a>
                        <div class="product-badges hot">
                            <span style="text-transform: capitalize">{{ product.product_type }}</span>
                        </div>
                    </div>
                    <div class="product-content-outer">
                        <a :href="'/product/' + product.slug" class="product-name" style="height: 47px;">
                            {{ product.name }}
                        </a>
                        <div class="product-item-bottom">
                            <div class="product-price" v-if="product.discount_price == null">
                                <span>{{ product.regular_price }} Tk.</span>
                            </div>
                            <div class="product-price" v-else>
                                <span class="">{{ product.discount_price }} Tk.</span>
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
    </div>
</template>

<script>
import axios from "axios"

   export default {
       data(){
           return {
               newArrivalProducts: []
           }
       },

       mounted(){
           this.products()
       },

       methods: {
           products(){
               this.$loading(true)
               axios.get('/api/new-arrival/products')
                .then(response => {
                    this.newArrivalProducts = response.data.products
                    this.$loading(false)
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
        padding: 10px 6px 12px 15px;
        border-radius: 0px 0px 0px 30px;
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
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 5px;
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
