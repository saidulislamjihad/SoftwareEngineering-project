<template>
    <div>
        <section class="product-page-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="product-page-leftside-wrapper">
                            <h4 class="leftside-heading">
                                Filter
                            </h4>
                            <div class="leftside categories">
                                <h4 class="leftside categories-title collapsed" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                    categories
                                    <i class="fas fa-chevron-down"></i>
                                </h4>
                                <form class="leftside categories-checkbox collapse show" id="collapseOne">
                                    <div class="checkbox" v-for="category in getCategories" :key="category.id">
                                        <label :for="category.id">
                                            <input type="checkbox" :value="category.id" :id="category.id" class="checkbox"
                                            v-model="categoryIds" @change="getFilterProduct()">
                                            {{ category.name }}
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="leftside sub-categories">
                                <h4 class="leftside sub-categories-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseOne">
                                    sub categories
                                    <i class="fas fa-chevron-down"></i>
                                </h4>
                                <form class="leftside sub-categories-checkbox collapse" id="collapseTwo">
                                    <div class="checkbox" v-for="subcategory in getSubategories" :key="subcategory.id">
                                        <label :for="subcategory.id">
                                            <input type="checkbox" :value="subcategory.id" :id="subcategory.id" @change="getFilterProduct()"
                                            v-model="subcategoryIds">
                                            {{ subcategory.name }}
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="leftside manufactures">
                                <h4 class="leftside manufactures-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseOne">
                                    Brands
                                    <i class="fas fa-chevron-down"></i>
                                </h4>
                                <form class="leftside manufactures-checkbox collapse" id="collapseThree">
                                    <div class="checkbox" v-for="brand in getBrands" :key="brand.id">
                                        <label :for="brand.id">
                                            <input type="checkbox" :value="brand.id" :id="brand.id" @change="getFilterProduct()"
                                            v-model="brandIds">
                                            {{ brand.name }}
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-page-header-wrapper">
                                    <div class="left-side-box">
                                        <h4 class="title">
                                            {{ this.subcategory.name }} Products
                                        </h4>
                                    </div>
                                    <div class="right-side-box">
                                        <h4 class="product-qty">
                                            Total Products
                                            <span class="number">{{ this.products.length }}</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6" v-for="product in products" :key="product.id">
                                <div class="product-section-item">
                                    <div class="product-item-image-outer">
                                        <a :href="'/product/details/' + product.id + '/' + product.slug" class="item-image-inner">
                                            <img :src="'/product/images/' + product.image">
                                        </a>
                                    </div>
                                    <div class="product-item-content">
                                        <a :href="'/product/details/' + product.id + '/' + product.slug" class="title">
                                            {{ product.name.substr(0,25) }}
                                        </a>
                                        <div class="price-cart-btn-wrapper-if">
                                            <div class="price if" v-if="product.discount_price == null">
                                                ৳ {{ product.regular_price.toFixed(2) }}
                                            </div>
                                            <div class="price-cart-btn-wrapper-else" v-else>
                                                <div class="price discount">
                                                    ৳ {{ product.discount_price }}
                                                </div>
                                                <div class="price regular">
                                                    <del>
                                                        ৳ {{ product.regular_price.toFixed(2) }}
                                                    </del> 
                                                </div>
                                            </div>                         
                <!--                            <div class="add-to-card" v-else>-->
                <!--                                <a :href="'/customer/login-form'" class="add-to-card-btn">-->
                <!--                                    <i class="fas fa-cart-plus"></i>-->
                <!--                                </a>-->
                <!--                            </div>-->
                                        </div>
                                        <div class="add-to-card order-btn-outer">
                                            <div class="cart-add-btn">
                                                <button @click="addToCart(product)" style="cursor: pointer" class="b-d-btn">
                                                    Add To Cart
                                                </button>
                                            </div>
                                            <div class="order-btn">
                                                <button class="add-to-card-btn" @click="directOrder(product)" style="cursor: pointer">    Order Now
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
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import axios from "axios"

   export default {
       props: ['subcategory'],
       data(){
           return {
                getCategories: [],
                getSubategories: [],
                getBrands: [],
                products: [],
                categoryIds: [],
                subcategoryIds: [],
                brandIds: []
           }
       },

       mounted(){
           this.subcategoryProducts(),
           this.getAllCategory(),
           this.getAllSubcategory(),
           this.getAllBrand()
       },

       methods: {
           subcategoryProducts(){
               axios.get('/api/subcategory-products/' + this.subcategory.id)
                .then(response => {
                    this.products = response.data
                }).catch(error => {
                    console.log(error)
                })
           },
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
                            //flash('Product has been successfully added to cart.', 'success');
                        }
                        //console.log(response)
                    }).catch(error => {
                        console.log(error)
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
    }
    /*.product-item-content {
        text-align: center;
    }*/
    /*.price-cart-btn-wrapper {
        display: block;
    }*/
    .price-cart-btn-wrapper-if .price.if {
        text-align: left;
    }
    .price-cart-btn-wrapper-if{
        padding: 10px 5px;
    }
    .price-cart-btn-wrapper-else{
        display: flex;
        align-items: center;
        justify-content: space-between;
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
        .price-cart-btn-wrapper-else {
            display: inline-block;
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
        .price-cart-btn-wrapper-if .price.if {
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
