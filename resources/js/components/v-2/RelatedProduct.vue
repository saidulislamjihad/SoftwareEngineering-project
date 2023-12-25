<template>
    <div>
        <div class="row">
            <div class="related-product-items-wrap owl-carousel">
                <div class="product-item-wrapper" v-for="relatedProduct in relatedProducts" :key="relatedProduct.id">
                    <div class="product-image-outer">
                        <a :href="'/product/' + relatedProduct.slug" class="product-imgae">
                            <img :src="'/product/images/' + relatedProduct.image" class="main-image" alt="product image">
                            <img :src="'/product/images/' + relatedProduct.image" class="hover-image" alt="product image">
                        </a>
                        <div class="product-action">
<!--                            <a class="action-btn" href="#">-->
<!--                                <i class="far fa-heart"></i>-->
<!--                            </a>-->
<!--                            <button type="button" class="action-btn" @click="addToCart(relatedProduct)">-->
<!--                                <i class="fas fa-shopping-cart"></i>-->
<!--                            </button>-->
<!--                            <a class="action-btn" href="#" @click="addToCart(relatedProduct)">-->
<!--                                <i class="fas fa-shopping-cart"></i>-->
<!--                            </a>-->
                        </div>
                        <div class="product-badges hot">
                            <span style="text-transform: capitalize">
                                {{ relatedProduct.product_type }}
                            </span>
                        </div>
                    </div>
                    <div class="product-content-outer">
                        <a :href="'/product/' + relatedProduct.slug" class="product-category">
                            {{ relatedProduct.category.name }}
                        </a>
                        <a :href="'/product/' + relatedProduct.slug" class="product-name" style="height: 47px;">
                            {{ relatedProduct.name }}
                        </a>
                        <div class="product-item-bottom">
                            <div class="product-price" v-if="relatedProduct.discount_price == null">
                                <span class="">{{ relatedProduct.regular_price }} Tk.</span>
                            </div>
                            <div class="product-price" v-else>
                                <span class="">{{ relatedProduct.discount_price }} Tk.</span>
                            </div>
                            <div class="add-cart">
                                <button class="add-cart-btn" @click="addToCart(relatedProduct)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['related'],
        data(){
            return {
                relatedProducts: this.related
            }
        },
        mounted() {

        },

        methods: {
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
                       window.location.href = '/checkout'
                   }
                   //console.log(response)
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
    }
    .price-cart-btn-wrapper {
        display: block;
        margin-bottom: 10px;
        padding-top: 0;
    }
    .product-item-content .title {
        margin-bottom: 0;
    }
    .product-item-content {
        text-align: center;
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
