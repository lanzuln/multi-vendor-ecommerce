@extends('frontend.layout.main')
@section('body')

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Store <span></span> Nest Food
            </div>
        </div>
    </div>
    <div class="container mb-30" style="transform: none;">
        <div class="archive-header-2 text-center pt-80 pb-50">
            <h1 class="display-2 mb-50">{{$vendor->name}}</h1>

        </div>
        <div class="row flex-row-reverse" style="transform: none;">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{count($vproduct)}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @foreach ($vproduct as $item)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                            data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}">
                                        <img class="default-img" src="{{ asset($item->product_thambnail) }}"
                                            alt="" />
                                        <img class="hover-img" src="{{ asset($item->product_thambnail) }}"
                                            alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                            class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                            class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount / $item->selling_price) * 100;
                                    @endphp

                                    @if ($item->discount_price == null)
                                        <span class="new">New</span>
                                    @else
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $item->category->category_name}}</a>
                                </div>
                                <h2><a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    @if ($item->vendor_id == null)
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">Owner</a></span>
                                    @else
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">{{ $item->vendor->name }}</a></span>
                                    @endif

                                </div>
                                <div class="product-card-bottom">

                                    @if ($item->discount_price == null)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>
                                            <span class="old-price">${{ $item->discount_price }}</span>
                                        </div>
                                    @endif

                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">


                <!-- Fillter By Price -->


            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                    <div class="vendor-logo mb-30">
                        <img src="{{ asset($vendor->photo ?? 'default.jpg')}}" alt="">
                    </div>
                    <div class="vendor-info">
                        <div class="product-category">
                            <span class="text-muted">Since {{ \Carbon\Carbon::parse($vendor->join_date)->format('Y') }}</span>
                        </div>
                        <h4 class="mb-5"><a href="vendor-details-1.html" class="text-heading">{{$vendor->name}}</a></h4>
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                        </div>
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading">{{$vendor->short_desc ?? ""}}</p></div>
                        <div class="follow-social mb-20">
                            <h6 class="mb-15">Follow Us</h6>
                            <ul class="social-network">
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/social-tw.svg')}}" alt="">
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/social-fb.svg')}}" alt="">
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/social-insta.svg')}}" alt="">
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/social-pin.svg')}}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="vendor-info">
                            <ul class="font-sm mb-20">
                                @if ($vendor->address)
                                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg" alt=""><strong>Address: </strong> <span>{{$vendor->address}}</span></li>

                                @endif
                                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg" alt=""><strong>Call Us:</strong><span> {{$vendor->phone ?? ""}}</span></li>
                            </ul>
                            <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div><div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-1.svg" alt="">Milks &amp; Dairies</a><span class="count">30</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-2.svg" alt="">Clothing</a><span class="count">35</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-3.svg" alt="">Pet Foods </a><span class="count">42</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-4.svg" alt="">Baking material</a><span class="count">68</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-5.svg" alt="">Fresh Fruit</a><span class="count">87</span>
                        </li>
                    </ul>
                </div><div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="slider-range" class="mb-20 noUi-target noUi-ltr noUi-horizontal noUi-background"><div class="noUi-base"><div class="noUi-origin noUi-connect" style="left: 25%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin noUi-background" style="left: 50%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">From: <strong id="slider-range-value1" class="text-brand">$500</strong></div>
                                <div class="caption">To: <strong id="slider-range-value2" class="text-brand">$1,000</strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">
                            <label class="fw-900">Color</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                            </div>
                            <label class="fw-900 mt-15">Item Condition</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                            </div>
                        </div>
                    </div>
                    <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                </div><div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none" style="visibility: hidden; animation-name: none;">
                    <img src="assets/imgs/banner/banner-11.png" alt="">
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br>
                            on <span class="text-brand">Oganic</span><br>
                            Juice
                        </h4>
                    </div>
                </div></div></div>
        </div>
    </div>

@endsection
