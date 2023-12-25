@extends('frontend.v-2.master')

@section('title')
  Shop | Products
@endsection

@section('content-v2')
    <section class="banner-section">
        <div class="banner-bg-image">
            <img src="{{ asset('/frontend/') }}/assets/images/category-banner.jpg" alt="shop product"/>
        </div>
        <h2 class="banner-title">All Products</h2>
    </section>
    <!-- <section class="product-section">
        <div class="container">
            <div id="app" style="margin-top: 20px;">
                <shop-products
                    :categories="{{ $categories }}"
                    :shop-products="{{ $products }}"
                    >
                </shop-products>
            </div>
        </div>
    </section> -->
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
                                <div class="checkbox mb-2">
                                    <label>
                                        <input type="checkbox" class="checkbox">
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
                                <div class="checkbox mt-2">
                                    <label>
                                        <input type="checkbox">
                                        {{ subcategory.name }}
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
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product-item-wrapper">
                                <div class="product-image-outer">
                                    <a href="'/product/' + product.slug" class="product-imgae">
                                        <img src="'/product/images/' + product.image">
                                    </a>
                                    <div class="product-badges hot">
                                        <span style="text-transform: capitalize">{{ product.product_type }}</span>
                                    </div>
                                </div>
                                <div class="product-content-outer">
                                    <a href="'/product/' + product.slug" class="product-name">
                                        {{ product.name}}
                                    </a>
                                    <div class="product-item-bottom">
                                        <div class="product-price">
                                            @if ($product->discount_price != null)
                                            <span>{{$product->discount_price}} Tk.</span>
                                            @else
                                            <span>{{$product->regular_price}} Tk.</span>
                                            @endif
                                        </div>
                                        <div class="add-cart">
                                            <a href="{{url('/add/to/cart/'.$product->id.'/add_cart')}}" class="add-cart-btn">
                                                <i class="fas fa-shopping-cart"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <a href="{{url('/add/to/cart/'.$product->id.'/quick_order')}}" class="quick-order-btn-inner">Quick Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
@endpush