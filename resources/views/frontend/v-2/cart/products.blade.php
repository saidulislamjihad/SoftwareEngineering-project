@extends('frontend.v-2.master')

@section('title')
    Cart products
@endsection

@section('content-v2')
    <div id="app">
        @if(isset($auth_user))
            <cart-products :auth_user="{{ $auth_user }}"></cart-products>
        @else
            <cart-products></cart-products>
        @endif
    </div>

@endsection

@push('script')
@endpush
