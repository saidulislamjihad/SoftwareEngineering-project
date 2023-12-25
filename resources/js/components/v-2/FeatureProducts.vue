<template>
    <div id="app">

        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6" v-for="product in featureProducts" :key="product.id">
                <div class="product-item-wrapper">
                    <div class="product-image-outer">
                        <a :href="'/product/' + product.slug" class="product-imgae">
                            <img :src="'product/images/' + product.image" class="main-image" alt="product image">
                            <img :src="'product/images/' + product.image" class="hover-image" alt="product image">
                        </a>
<!--                        <div class="product-action">-->
<!--                            <a class="action-btn" href="#" @click="addToCart(product)">-->
<!--                                <i class="fas fa-shopping-cart"></i>-->
<!--                            </a>-->
<!--                            <a class="action-btn" href="#">-->
<!--                                <i class="fas fa-eye"></i>-->
<!--                            </a>-->
<!--                        </div>-->
                        <div class="product-badges hot">
                            <span style="text-transform: capitalize">{{ product.product_type }}</span>
                        </div>
                    </div>
                    <div class="product-content-outer">
<!--                        <a :href="'/product/details/' + product.id + '/' + product.slug" class="product-category">-->
<!--                            Snack-->
<!--                        </a>-->
                        <a :href="'/product/' + product.slug" class="product-name" style="height: 47px;">
                            <!--{{ product.name.substr(0,22) }}-->
                            {{ product.name }}
                        </a>
<!--                        <ul class="product-item-ratting">-->
                        <!--                            <li>-->
                        <!--                                <i class="fas fa-star"></i>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <i class="fas fa-star"></i>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <i class="fas fa-star"></i>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <i class="fas fa-star"></i>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <i class="far fa-star"></i>-->
                        <!--                            </li>-->
                        <!--                        </ul><span class="font-small ml-5 text-muted"> (4.0)</span>-->
                        <div class="product-item-bottom">
                            <div class="product-price" v-if="product.discount_price == null">
                                <span>{{ product.regular_price }} Tk.</span>
<!--                                <span class="old-price">{{ product.discount_price }} Tk.</span>-->
                            </div>
                            <div class="product-price" v-else>
<!--                                <span>{{ product.regular_price }} Tk.</span>-->
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
   export default {
       data(){
           return {
               featureProducts: [],
               customerAuthId : this.$authUserId,
               next_page_url: null
           }
       },

       mounted(){
           this.products()
       },

       methods: {
           products(){
               this.$loading(true)
               axios.get('/api/feature/products')
                .then(response => {
                    console.log(response)
                    this.featureProducts = response.data
                    this.$loading(false)
                    //this.next_page_url = response.data.next_page_url
                })
                .catch(error => {
                    console.log(error);
                })
           },

           loadMore(url){
               //console.log(url)
               axios.get(url)
                   .then(response => {
                       //console.log(response.data.next_page_url)
                       let featureProducts = response.data.data
                       featureProducts.map(p => {
                           this.featureProducts.push(p)
                       })
                       this.next_page_url = response.data.next_page_url
                   })
                   .catch(error => {
                       console.log(error)
                   })
           },

           // productsHandle($state) {
           //     this.$http.get('/api/feature/products?page=' + this.page)
           //         .then(res => {
           //             return res.json();
           //         }).then(res => {
           //             //console.log(res.data)
           //         $.each(res.data, (key, value) => {
           //             this.featureProducts.push(value);
           //         });
           //         $state.loaded();
           //     });
           //     this.page = this.page + 1;
           // },

           addToCart(product){
               if(product.discount_price == null){
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
                            //window.location.href = '/checkout'
                            //flash('Product has been successfully added to cart.', 'success');
                        }
                        //console.log(response)
                    }).catch(error => {
                        if(error.status === 500 || error.status === 422){
                            alert('Something is missing Please try again.')
                        }
                    })
                }
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
    .product-item-content .title{
        font-size: 14px;
    }
    .product-section-item img{
        width: 100%;
    }
    .price-cart-btn-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 5px;
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
    .load-more-btn {
        text-align: center;
        margin-top: 20px;
    }
    .load-more-btn .load-more {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        text-transform: capitalize;
        border: 1px solid #154360;
        padding: 10px 20px;
        color: #212529;
        transition: all .3s ease;
        background: #FFF;
        font-size: 20px;
    }
    .load-more-btn .load-more:hover {
        border-color: transparent;
        background: #f16522;
        color: #fff;
    }
    .load-more-btn .load-more:focus-visible {
        outline: none;
    }
    @media screen and (max-width:1600px){
        .add-to-card.order-btn-outer {
            display: block;
            padding-top: 0;
        }
        .product-item-content .add-to-card {
            text-align: left;
        }
        .order-btn {
            margin-top: 10px;
        }
        .add-to-card-btn {
            padding: 5px 15px;
        }
    }

    @media screen and (max-width:1450px){
        .price-cart-btn-wrapper {
            display: block;
            padding-top: 0px;
        }
        .product-item-content {
            text-align: center!important;
        }
        .product-item-content .add-to-card{
            text-align: center;
        }
    }
    @media screen and (max-width:1150px){
        .add-to-card.order-btn-outer {
            display: block;
            padding-top: 0;
        }
        /* button.s-d-btn {
            display: inline-block;
            padding: 5px;
            margin-bottom: 10px;
        } */
        .price-cart-btn-wrapper {
            padding-bottom: 0;
        }
    }
</style>
