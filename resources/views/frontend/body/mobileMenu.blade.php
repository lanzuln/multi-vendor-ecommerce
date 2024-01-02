@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->

                <form action="{{ route('product.search') }}" method="post">
                    @csrf
                    <input  name="search" placeholder="Search for items..." />
                </form>
                <nav>
                    @php
                        $menucategory = App\Models\Category::orderBy('category_name', 'asc')
                            ->limit(5)
                            ->get();
                    @endphp
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="{{ route('homePage') }}">Home</a>

                        </li>
                        @foreach ($menucategory as $item)
                            <li class="menu-item-has-children">
                                <a href="{{ url('product/category/' . $item->id) }}">{{ $item->category_name }}</a>
                                <ul class="dropdown">
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
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href={{ route('login') }}><i class="fi-rs-user"></i>Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>{{ $setting->support_phone }}</a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                        alt="" /></a>
            </div>
            <div class="site-copyright">{{ $setting->copyright }}</div>
        </div>
    </div>
</div>
