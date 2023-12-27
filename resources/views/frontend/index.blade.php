@extends('frontend.layout.main')
@section('body')

@section('title')
    Home Easy Multi Vendor Shop
@endsection
    @include('frontend.components.home.home-slider')
    <!--End hero slider-->

    @include('frontend.components.home.popular-categories')
    <!--End category slider-->

    @include('frontend.components.home.banner')
    <!--End banners-->


    @include('frontend.components.home.new-prducts')
    <!--Products Tabs-->

    <!--start Best Sales-->
    @include('frontend.components.home.features-products')
    <!--End Best Sales-->

    <!-- gadget Category -->
    @include('frontend.components.home.gadget')
    <!--End TV Category -->

    <!-- food Category -->
    @include('frontend.components.home.food')
    <!--End Tshirt Category -->

    <!-- fashion Category -->
    @include('frontend.components.home.fashion')
    <!--End Computer Category -->

    @include('frontend.components.home.recent-tab')
    <!--End 4 columns-->

    <!--Vendor List -->
    @include('frontend.components.home.vendor')
    <!--End Vendor List -->
@endsection
