<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="product-details-wrapper">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                    <!-- <div class="product-item-outer" v-for="(gallery, index) in galleryImages" :key="index">
                                        <img @click="currentThumnail(gallery.gallery_image, index)" :src="'/galleryImage/' + gallery.gallery_image" alt="slider images">
                                    </div> -->
									<!-- <div class="slider slider-single">
                                        <div>
                                            <img v-show="!thumnailImage" :src = "'/product/images/' + details.image" alt="slider image">
                                            <img v-show="thumnailImage" :src = "'/galleryImage/' + thumnailImage" alt="slider image">
                                        </div>
                                    </div>
                                    <div class="slider slider-nav">
                                        <div v-for="(gallery, index) in galleryImages" :key="index">
                                            <img @click="currentThumnail(gallery.gallery_image, index)" :src="'/galleryImage/' + gallery.gallery_image" alt="slider images">
                                        </div>
                                    </div> -->
                                <div class="product-images-slider-outer">
                                    <div class="slider slider-content">
                                        <div v-for="(gallery, index) in galleryImages" :key="index">
                                            <img @click="currentThumnail(gallery.gallery_image, index)"
                                                :src="'/galleryImage/' + gallery.gallery_image" alt="slider images">
                                        </div>
                                    </div>
                                    <div class="slider slider-thumb">
                                        <div v-for="(gallery, index) in galleryImages" :key="index">
                                            <img @click="currentThumnail(gallery.gallery_image, index)"
                                                :src="'/galleryImage/' + gallery.gallery_image" alt="slider images">
                                        </div>
                                    </div>
                                </div>
							</div>
                            <div class="col-lg-5 col-md-5">
                                <div class="product-details-content">
                                    <h3 class="product-name">
                                        {{ details.name }}
                                    </h3>
                                    <div class="product-price" v-if="details.discount_price == null">
                                        <span>{{ details.regular_price }} Tk.</span>
                                        <span class="" style="color: #f74b81;">{{ details.discount_price }}</span>
                                    </div>
                                    <div class="product-price" v-else>
                                        <span>{{ details.discount_price }} Tk.</span>
                                        <span class="" style="color: #f74b81;">
                                            <del>{{ details.regular_price + 'Tk.' }}</del>
                                        </span>
                                    </div>
                                    <p class="shor-description">
                                        {{ details.short_description }}
                                    </p>
                                    <div class="product-details-select-items-wrap" v-if="details.colors.length > 0">
                                        <div class="product-details-select-item-outer" v-for="(colorName,index) in details.colors" v-if="colorName.color != null">
                                            <input type="radio" name="color" id="color" :value="colorName.color" v-model="color" class="category-item-radio">
                                            <label for="color" class="category-item-label">{{ colorName.color }}</label>
                                        </div>
                                    </div>
                                    <div class="product-details-select-items-wrap" v-if="details.sizes.length > 0">
                                        <div class="product-details-select-item-outer" v-for="(sizeName,index) in details.sizes" v-if="sizeName.size != null">
                                            <input type="radio" name="size" :value="sizeName.size" v-model="size" class="category-item-radio">
                                            <label for="size" class="category-item-label">{{ sizeName.size }}</label>
                                        </div>
                                    </div>

                                    <div class="purchase-info-outer" v-if="details.qty > 0">
                                        <div style="display:block">
                                            <button v-if="this.qty < details.qty" @click.prevent="qty++" title="Increment" class="increment-btn" style="margin-top: -10px;">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button v-else disabled title="Increment" class="btn btn-sm btn-success" style="margin-top: -10px;">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                            <input type="number" readonly name="qty" placeholder="Qty" min="1" :max="details.qty" v-model="qty" id="qty" style="height: 35px;">
                                            <button v-if="this.qty >= 1" @click.prevent="qty--" title="Decrement" class="decrement-btn" style="margin-top: -10px;">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button v-else disabled title="Decrement" class="btn btn-sm btn-danger" style="margin-top: -10px;">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button v-if="this.qty > 0" type="button" class="cart-btn-inner" @click="addToCartDetailsPage(details)">
                                                <i class="fas fa-shopping-cart"></i>
                                                Add to Cart
                                            </button>
                                            <button v-else disabled type="button" class="cart-btn-inner">
                                                <i class="fas fa-shopping-cart"></i>
                                                Add to Cart
                                            </button>
                                            <button type="button" class="cart-btn-inner" v-if="this.qty > 0" @click="buyNow(details)">
                                                <i class="fas fa-truck"></i>
                                                Quick Order
                                            </button>
                                            <button type="button" class="cart-btn-inner" v-else disabled>
                                                <i class="fas fa-truck"></i>
                                                Quick Order
                                            </button>
                                        </div>
                                    </div>

                                    <div class="purchase-info-outer" v-else>
                                        <button type="button" class="out-stock" disabled>
                                            <i class="fas fa-lock"></i>
                                            Stock Out
                                        </button>
                                    </div>
                                    <button type="button" class="product-details-hot-line">
                                        <i class="fas fa-phone-alt"></i>
                                        For Call : +8801648177071
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product-details-info">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                                        Description
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="true">
                                        Review
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-policy-tab" data-bs-toggle="pill" data-bs-target="#pills-policy" type="button" role="tab" aria-controls="pills-policy" aria-selected="true">
                                        Product Policy
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" v-html="details.long_description"></div>
                                <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                    <div class="review-item-wrapper" v-for="review in details.reviews" :key="review.id">
                                        <div class="review-item-left">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="review-item-right">
                                            <h4 class="review-author-name">
                                                {{ review.name }}
                                                <span class=" d-inline bg-danger badge-sm badge text-white">Verified</span>
                                            </h4>
                                            <p class="review-item-message">
                                                {{ review.message }}
                                            </p>
                                            <!--<span class="review-item-rating-stars" v-if="review.rating === 5">-->
                                            <span class="review-item-rating-stars">
                                                <i class="fa-star fas"></i>
                                                <i class="fa-star fas"></i>
                                                <i class="fa-star fas"></i>
                                                <i class="fa-star fas"></i>
                                                <i class="fa-star fas"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-policy" role="tabpanel" aria-labelledby="pills-policy-tab" v-html="details.policy"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="product-details-sidebar">
                        <div class="product-details-categoris">
                            <h3 class="product-details-title">
                                Category
                            </h3>
                            <a v-for="(category,index) in categories" :key="category.id" :href="'/products/' + category.slug" class="category-item-outer">
                                <img :src="'/category/' + category.image" alt="category image">
                                {{ category.name }}
                            </a>
                        </div>
                        <div class="banner-item-outer side-banner" v-if="details.category">
                            <img :src="'/category/' + details.category.image" alt="banner image">
                            <div class="banner-content">
                                <h4>
                                    {{ details.category.name }}
                                </h4>
                                <a :href="'/products/' + details.category.slug " class="shop-now-btn">
                                    Shop Now <i class="fas fa-long-arrow-alt-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    // import review from './Review.vue'
    // import reviewForm from './ReviewForm.vue'
    export default {
        props:['details'],
        data(){
            return {
                galleryImages: this.details.product_images,
                qty: 1,
                color: '',
                size: '',
                activeClass: 0,
                thumnailImage: '',
                avgRating: '',
                avgReview: '',
                categories: [],
            }
        },
        mounted() {
            this.productAvgratingCount();
            this.productAvgRating()
            this.getAllCategories()
            Reload.$on('productReview', () => {
               this.productAvgratingCount()
           })
        },

        // components: {
		// 	review,
        //     reviewForm
		// },

        methods: {
            cartIncrement(){

            },

            cartDecrement(){

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
                       window.location.href = '/checkout'
                   }
                   //console.log(response)
               }).catch(error => {
                   console.log(error)
               })
           },
           addToCartDetailsPage(item){
               if (this.qty > item.qty){
                   this.$swal({
                       position: 'center',
                       icon: 'error',
                       title: 'Product quantity exceeded',
                       showConfirmButton: true,
                       //timer: 1500
                   })

               }else {
                   axios.post('/add/to/cart/details/page/' + item.id,{
                       product_id: item.id,
                       qty:this.qty,
                       color:this.color,
                       size:this.size,
                       user_id:this.$authUserId,
                       price: item.discount_price != null ? item.discount_price : item.regular_price,
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
                       //console.log(error.status)
                       if(error.status === 500){
                           alert('Something is missing Please try again.')
                       }
                   })
               }
           },
            buyNow(item){
               axios.post('/add/to/cart/details/page/' + item.id,{
                   product_id: item.id,
                   qty:this.qty,
                   color:this.color,
                   size:this.size,
                   user_id:this.$authUserId,
                   price: item.discount_price != null ? item.discount_price : item.regular_price,
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
                   //console.log(error.status)
                   if(error.status === 500 || error.status === 422){
                       alert('Something is missing Please try again.')
                   }
               })
           },
           currentThumnail(image, index){
               //console.log(index);
               this.thumnailImage = image
               this.activeClass = index
           },

           productAvgratingCount(){
               axios.get('/product/review/count/' + this.details.id)
                .then(response => {
                    this.avgRating = response.data
                }).catch(error => {
                    console.log(error)
                })
           },
           productAvgRating(){
               axios.get('/product/avg/review/' + this.details.id)
                .then(response => {
                    this.avgReview = response.data
                }).catch(error => {
                    console.log(error)
                })
           },
            getAllCategories(){
               axios.get('/get/categories')
                   .then(response => {
                       this.categories = response.data.categories
                   }).catch(error => {
                       console.log(error)
               })
            }
       }
    }
</script>

<style scoped>
.product-images-slider-outer .slider-content img {
    width: 100%;
    height: 400px;
    object-fit: contain;
}

.product-images-slider-outer .slider-thumb img {
    max-width: 100px;
    height: 100px;
    transition: all .3s ease;
    cursor: pointer;
}

.product-images-slider-outer .slider-content i.fas.fa-chevron-left {
    position: absolute;
    background: #3bb77e;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    left: 20px;
    z-index: 9;
}

.product-images-slider-outer .slider-content {
    position: relative;
    margin-bottom: 20px;
}

.product-images-slider-outer .slider-content i.fas.fa-chevron-right {
    position: absolute;
    background: #3bb77e;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    right: 20px;
    z-index: 9;
}
.product-details-hot-line {
    margin-top: 20px;
    background: #3bb77e;
    border: 1px solid #3bb77e;
    padding: 8px 20px;
    border-radius: 5px;
    color: #fff;
    font-weight: 700;
}
.product-details-hot-line i {
    font-size: 16px;
    margin-right: 6px;
}
    .out-stock{
        background-color: red;
        padding: 8px;
        outline: none;
        width: 210px;
        border-radius: 5px;
        border: none;
        color: white;
        font-weight: 800;
    }
    .container-space {
            background: #fff;
            padding: 5px;
    }
    .product-thumbnails {
        display: flex;
        margin-top: 2rem;
    }
    .product-thumbnails > ul {
        display: flex;
        list-style: none;
        padding-left: 0;
    }
    .product-thumbnails > li {
        margin-right: 10px;
    }
    .product-thumbnails > ul > li > img {
        width: 100px;
        cursor: pointer;
    }
    .thumbnail-active {
        border: 2px solid #000;
    }
    .nav-link > img {
        width: 40px;
        border-radius: 8px;
        margin-right: 10px;
    }
    .btn-custom-color {
        border: 2px solid #4fc08d;
        color: #4fc08d;
    }
    .btn-custom-color:hover {
        border: 2px solid #4fc08d;
        background-color: #4fc08d;
        color: #ffffff;
    }
    .product-details-main-img {
            border: 1px solid #154360;
            width: 100%;
            height: 400px;
    }
    .details-product-name {
            font-size: 30px;
            font-weight: 500;
            font-family: 'Poppins';
            text-transform: capitalize;
            color: #4d5154;
            margin-bottom: 0;
    }
    .details-product-price {
            font-size: 16px;
            font-weight: 400;
            font-family: 'Poppins';
            color: #000;
    }
    .details-product-price span {
            font-size: 23px;
        }
    .details-product-stock {
            font-size: 16px;
            font-weight: 400;
            font-family: 'Poppins';
            color: #000;
    }
    .details-product-out-stock {
        font-size: 20px;
        font-weight: 400;
        font-family: 'Poppins';
        color: #4d5154;
    }
    .product-details {
        font-size: 20px;
        font-family: 'Poppins';
        font-weight: 400;
    }
    .details-product-stock span {
        font-size: 20px;
    }
    .product-short-details {
        font-size: 15px;
        font-weight: 400;
        font-family: 'Poppins';
        margin-bottom: 0;
    }
    .increment-btn {
        background: transparent;
        border: 2px solid #3bb77e;
        font-size: 14px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        line-height: 28px;
        color: #3bb77e;
    }
    .decrement-btn {
        background: transparent;
        border: 2px solid #3bb77e;
        font-size: 14px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        line-height: 28px;
        color: #3bb77e;
    }
    .increment-btn:hover,.decrement-btn:hover {
        background: #3bb77e;
        color: #fff;
    }
    .product-quantity input.quantity {
        width: 130px;
        height: 37px;
        border: 1px solid #154360;
        border-radius: 4px;
    }
    .product-quantity input.quantity:focus {
        border-color: #154360;
        box-shadow: 0 0 10px #154360;
    }
    .seller-delivary-service-wrapper {
        background: #fafafa;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
        padding: 10px;
        border-radius: 5px;
    }
    .delivary-header-title {
        background: #ddd;
        padding: 5px;
        font-size: 14px;
        font-family: 'Poppins';
        font-weight: 400;
    }
    .product-details-section {
        background: #eff0f5;
    }
    .delivary-location-outer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 5px 10px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ccc;
    }
    .delivary-option-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .location-body {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-right: 15px;
    }

    .location-body address {
        margin-bottom: 0;
        line-height: initial;
        margin-left: 7px;
    }

    .location-body i {
        font-size: 18px;
    }

    .delivary-option-outer {
        padding: 0 5px 10px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ccc;
    }
    .shipping-free-form {
        margin-bottom: 10px;
    }
    .shipping-free-form select {
        width: 100%;
        height: 35px;
        border: 1px solid #000;
    }
    .shipping-free-form select:focus-visible {
        outline: none;
    }
    .delivary-option-title {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
    }
    .location-link-change a {
        font-size: 15px;
        font-family: 'Poppins';
        font-weight: 400;
        color: #000;
    }

    .delivary-option-title i {
        font-size: 18px;
    }

    .delivary-option-info {
        font-family: 'Poppins';
        font-size: 15px;
        font-weight: 400;
        margin-left: 7px;
    }

    .delivary-option-info p {
        margin-bottom: 0;
    }

    .delivary-option-shipping-free {
        font-size: 16px;
        font-weight: 800;
    }

    .delivary-cashon-outer i {
        font-size: 18px;
    }

    .delivary-cashon-outer span {
        margin-left: 7px;
        font-size: 15px;
        font-weight: 400;
    }

    .delivary-cashon-outer {
        padding: 0px 5px 10px;
        border-bottom: 1px solid #ccc;
        margin-bottom: 10px;
    }

    .service-header-title {
        background: #ddd;
        padding: 5px;
        font-size: 14px;
        font-family: 'Poppins';
        font-weight: 400;
    }
    .banner-item-outer.side-banner {
        background: #b9b7b2;
        border-radius: 10px;
    }
    .banner-item-outer .banner-content h4 {
        color: #fff;
    }
    .service-return-policy-outer i {
        font-size: 20px;
    }
    .service-return-policy-outer {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .service-return-policy-title {
        margin-left: 10px;
    }

    .service-return-policy-title p {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 0;
    }

    .service-return-policy-title span {
        font-size: 15px;
        font-family: 'Poppins';
        font-weight: 400;
    }

    .service-warranty-outer {
        padding-bottom: 10px;
    }

    .service-warranty-outer i {
        font-size: 20px;
    }
    .service-warranty-outer span {
        font-size: 15px;
        font-weight: 400;
        font-family: 'Poppins';
        margin-left: 10px;
    }
    .single-product-details-rating {
        display: flex;
        align-items: center;
        margin-bottom: 4px;
    }
    .product-details-rating-outer {
        margin-right: 10px;
    }
    .product-details-rating-outer ul {
        padding-left: 0;
        display: flex;
        align-items: center;
        margin-bottom: 0;
    }
    .product-details-rating-outer ul li i {
        color: #154360;
        font-size: 14px;
    }
    .total-rating span {
        font-size: 14px;
        font-family: 'Poppins';
        font-weight: 500;
    }
    .product-video-outer a {
        display: block;
        color: #000;
    }
    .product-video-outer a i {
        font-size: 18px;
        color: #000;
    }
    .product-video-outer a span {
        font-size: 15px;
        font-weight: 400;
        font-family: 'Poppins';
        margin-left: 10px;
        color: #000;
    }
    .purchase-info.outer {
        margin: 20px 0;
    }

    .purchase-info-inner {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .product-images-slider-outer .slider.slider-thumb {
    text-align: center;
}

    .buy-now-btn-innner button.btn.buy-now {
        width: 100%;
        background: #f16522;
    }
    /*.product-short-details {
        height: 130px;
    }*/

    @media screen and (max-width:991px){
       .purchase-info-inner {
            display: block;
        }

        .purchase-info .btn {
            width: 100%;
        }

        .product-quantity input.quantity {
            width: 100%!important;
        }
    }
    @media screen and (max-width: 767px){
        .purchase-info.outer {
            display: block;
        }

        .product-quantity {
            margin-bottom: 10px;
        }
    }
</style>
