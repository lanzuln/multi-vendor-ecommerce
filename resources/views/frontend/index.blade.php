@extends('frontend.layout.main')
@section('body')
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

    <!-- TV Category -->
    @include('frontend.components.home.tab-products')
    <!--End TV Category -->

    <!-- Tshirt Category -->
    @include('frontend.components.home.tshirt')
    <!--End Tshirt Category -->

    <!-- Computer Category -->
    @include('frontend.components.home.computer')
    <!--End Computer Category -->

    @include('frontend.components.home.recent-tab')
    <!--End 4 columns-->

    <!--Vendor List -->
    @include('frontend.components.home.vendor')
    <!--End Vendor List -->
@endsection
