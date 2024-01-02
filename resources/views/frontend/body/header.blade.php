<header class="header-area header-style-1 header-height-2">
    @php
        $allcategory = App\Models\Category::get();

    @endphp

    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('homePage') }}"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        {{-- form serac style and js  --}}
                        <style>
                            #searchProducts {
                                position: absolute;
                                top: 100%;
                                left: 0;
                                width: 100%;
                                background: #ffffff;
                                z-index: 999;
                                border-radius: 8px;
                                margin-top: 5px;
                            }
                        </style>

                        <script>
                            function search_result_show() {
                                $("#searchProducts").slideDown();

                            }

                            function search_result_hide() {
                                $("#searchProducts").slideUp();
                            }
                        </script>


                        <form action="{{ route('product.search') }}" method="post">
                            @csrf
                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                id="search" placeholder="Search for items..." />
                            <div id="searchProducts"></div>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">

                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg') }}" />
                                    @auth
                                        <span class="pro-count blue" id="compareQty">0</span>
                                    @endauth
                                </a>
                                <a href="{{ route('compare') }}"><span class="lable ml-0">Compare</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    @auth
                                        <span class="pro-count blue" id="wishQty">0</span>

                                    @endauth
                                </a>
                                <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="shop-cart.html">
                                    <img alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />

                                    <span class="pro-count blue" id="cartQty"> </span>


                                </a>
                                <a href="{{ route('mycart') }}"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <div class="miniCart">

                                        </div>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">

                                            <h4>Total <span class="cartSubTotal"> </span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="page-account.html">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                </a>
                                @auth
                                    <a href="#"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My
                                                    Account</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i
                                                        class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-label mr-10"></i>My
                                                    Voucher</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-heart mr-10"></i>My
                                                    Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i
                                                        class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.logout') }}"><i
                                                        class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                                    <span style="margin: 0px 2px"> | </span>
                                    <a href="{{ route('register') }}"><span class="lable ml-0">Registration</span></a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('homePage') }}">
                        <img src="{{ asset($setting->logo) }}" alt="logo" />
                    </a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach ($allcategory as $item)
                                        @if ($loop->index < 5)
                                            <li>
                                                <a
                                                    href="{{ url('product/category/' . $item->id . '/' . $item->category_slug) }}">
                                                    <img src="{{ asset($item->category_image) }}" alt="" />
                                                    {{ $item->category_name }} </a>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                                <ul class="end">
                                    @foreach ($allcategory as $item)
                                        @if ($loop->index > 4)
                                            <li>
                                                <a
                                                    href="{{ url('product/category/' . $item->id . '/' . $item->category_slug) }}">
                                                    <img src="{{ asset($item->category_image) }}" alt="" />
                                                    {{ $item->category_name }} </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                {{-- home  --}}
                                <li>
                                    <a class="active" href="{{ route('homePage') }}">Home </a>

                                </li>
                                {{-- about  --}}
                                <li>
                                    <a href="page-about.html">About</a>
                                </li>
                                {{-- category --}}
                                @php
                                    $menucategory = App\Models\Category::orderBy('category_name', 'asc')
                                        ->limit(5)
                                        ->get();
                                @endphp
                                @foreach ($menucategory as $item)
                                    <li>

                                        <a href="{{ url('product/category/' . $item->id) }}">{{ $item->category_name }}<i
                                                class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            @php
                                                $sub_category = App\Models\SubCategory::where('category_id', $item->id)
                                                    ->orderBy('name', 'asc')
                                                    ->get();
                                            @endphp

                                            @foreach ($sub_category as $item)
                                                <li><a
                                                        href="{{ url('/product/sub-category/' . $item->id . '/' . $item->slug) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach


                                {{-- contact --}}
                                <li>
                                    <a href="{{ route('home.blog') }}">Blog</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                    <p>{{ $setting->support_phone }}</p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img alt="Nest"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                @auth
                                    <span class="pro-count white" id="MwishQty">0</span>
                                @endauth
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="Nest"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg')}}" />

                                    <span class="pro-count white" id="McartQty">0</span>

                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">

                                <div class="miniCart">
                                {{-- mini card show here  --}}
                                </div>



                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">

                                        <h4>Total <span class="cartSubTotal"> </span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                        <a href="shop-checkout.html">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
