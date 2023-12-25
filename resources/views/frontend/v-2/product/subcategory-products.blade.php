@extends('frontend.v-2.master')

@section('title')
{{ $subcategoryProducts->name }}
@endsection

@section('content-v2')
    {{-- <section class="product-page-banner-section">
        <div class="banner-bg-image">
            <img src="{{ asset('/frontend/') }}/assets/images/category-banner1.jpg">
        </div>
    </section> --}}
    <section class="product-section">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2>{{ $subcategoryProducts->name }} Products</h2>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <!-- <subcategory-products-list :subcategory="{{  $subcategoryProducts  }}"></subcategory-products-list> -->
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="product-item-wrapper">
                            <div class="product-image-outer">
                                <a href="#" class="product-imgae">
                                    <img src="" class="main-image" alt="product image">
                                </a>
                                <div class="product-badges hot">
                                    <span style="text-transform: capitalize">{{ product.product_type }}</span>
                                </div>
                            </div>
                            <div class="product-content-outer">
                                <a href="" class="product-name">
                                    {{ product.name.substr(0,22) }}
                                </a>
                                <div class="product-item-bottom">
                                    <div class="product-price">
                                        <span>{{ product.regular_price }} Tk.</span>
                                    </div>
                                    <div class="add-cart">
                                        <button class="add-cart-btn">
                                            <i class="fas fa-shopping-cart"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <a href="#" class="quick-order-btn-inner">Quick Order</a>
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
