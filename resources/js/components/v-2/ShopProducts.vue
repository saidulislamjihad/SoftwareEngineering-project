<template>
    <div id="app">

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
                                <div class="checkbox mb-2" v-for="categories in getCategories" :key="categories.id">
                                    <label :for="'cat' + categories.id">
                                        <input type="checkbox" :value="categories.id" :id="'cat' + categories.id" class="checkbox"
                                        v-model="categoryIds" @change="getFilterProduct()">
                                        {{ categories.name }}
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="leftside sub-categories">
                            <h4 class="leftside sub-categories-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseOne">
                                sub categories
                                <i class="fas fa-chevron-down"></i>
                            </h4>
                            <form class="leftside sub-categories-checkbox collapse show" id="collapseTwo">
                                <div class="checkbox mt-2" v-for="subcategory in getSubcategories" :key="subcategory.id">
                                    <label :for="'sub' + subcategory.id">
                                        <input type="checkbox" :value="subcategory.id" :id="'sub' + subcategory.id" @change="getFilterProduct()"
                                        v-model="subcategoryIds">
                                        {{ subcategory.name }}
                                    </label>
                                </div>
                            </form>
                        </div>
<!--                        <div class="leftside manufactures">-->
<!--                            <h4 class="leftside manufactures-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseOne">-->
<!--                                Brands-->
<!--                                <i class="fas fa-chevron-down"></i>-->
<!--                            </h4>-->
<!--                            <form class="leftside manufactures-checkbox collapse" id="collapseThree">-->
<!--                                <div class="checkbox" v-for="brand in getBrands" :key="brand.id">-->
<!--                                    <label :for="brand.id">-->
<!--                                        <input type="checkbox" :value="brand.id" :id="brand.id" @change="getFilterProduct()"-->
<!--                                        v-model="brandIds">-->
<!--                                        {{ brand.name }}-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-page-header-wrapper">
                                <div class="left-side-box">
                                    <h4 class="title">
                                        Shop Products
                                    </h4>
                                </div>
                                <div class="right-side-box">
                                    <h4 class="product-qty">
                                        Total Products
                                        <span class="number">{{ products.length }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6" v-for="product in products" :key="product.id">
                            <div class="product-item-wrapper">
                                <div class="product-image-outer">
                                    <a :href="'/product/' + product.slug" class="product-imgae">
                                        <img :src="'/product/images/' + product.image">
                                    </a>
<!--                                    <div class="product-action">-->
<!--                                        <a class="action-btn" href="#" @click="addToCart(product)">-->
<!--                                            <i class="fas fa-shopping-cart"></i>-->
<!--                                        </a>-->
<!--                                        <a class="action-btn" href="#" data-bs-toggle="modal" data-bs-target="#quickView">-->
<!--                                            <i class="fas fa-eye"></i>-->
<!--                                        </a>-->
<!--                                    </div>-->
                                    <div class="product-badges hot">
                                        <span style="text-transform: capitalize">{{ product.product_type }}</span>
                                    </div>
                                </div>
                                <div class="product-content-outer">
                                    <a :href="'/product/' + product.slug" class="product-name" style="height: 47px;">
                                        {{ product.name}}
                                    </a>
                                    <div class="product-item-bottom">
                                        <div class="product-price" v-if="product.discount_price == null">
                                            <span>{{ product.regular_price }} Tk.</span>
            <!--                                <span class="old-price">{{ product.discount_price }} Tk.</span>-->
                                        </div>
                                        <div class="product-price" v-else>
            <!--                                <span>{{ product.regular_price }} Tk.</span>-->
                                            <span class="old-price">{{ product.discount_price }} Tk.</span>
                                        </div>
                                        <!-- <div class="add-cart">
                                            <button class="add-cart-btn" @click="addToCart(product)">
                                                <i class="fas fa-shopping-cart"></i>
                                                Add
                                            </button>
                                        </div> -->
                                    </div>
                                    <!-- <a href="#" @click="directOrder(product)" class="quick-order-btn-inner">Quick Order</a> -->
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
       props: ['categories', 'shopProducts'],
       data(){
           return {
               subcategoryIds: [],
               categoryIds: [],
               products: [],
           }
       },

       mounted(){
           this.$store.dispatch('getAllCategoryFromDatabase')
           this.$store.dispatch('getAllSubcategoryFromDatabase')
           // this.$store.dispatch('shopAllProductsFromDatabase')
           // this.$store.dispatch('getFilterProductFromDatabase')
           this.shopAllProductsFromDatabase()
       },

       computed:{
           // products(){
           //     return this.$store.getters.getProductFormGetters
           // },

           getCategories(){
               return this.$store.getters.getCategoryFormGetters;
           },

           getSubcategories(){
               return this.$store.getters.getSubcategoryFormGetters
           },
       },

       methods: {
           shopAllProductsFromDatabase(){
               this.$loading(true)
               axios.get('/api/shop-products')
                   .then(response => {
                       this.products = response.data
                       this.$loading(false)
                   }).catch(error => {
                   console.log(error)
               })
           },
           getFilterProduct(){
               axios.post('/api/getFilterProduct', {category_ids:this.categoryIds, subcategory_ids:this.subcategoryIds} )
                   .then(response => {
                       if(this.categoryIds.length > 0 || this.subcategoryIds.length > 0){
                           this.products = response.data
                       }else{
                           this.shopAllProductsFromDatabase()
                       }
                   }).catch(error => {
                   console.log(error)
               })
           },
           addToCart(product){
               axios.post('/add/to/cart/' + product.id,{
                   product_id: product.id,
                   qty:1,
                   user_id:1,
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
                       //flash('Product has been successfully added to cart.', 'success');
                   }
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
