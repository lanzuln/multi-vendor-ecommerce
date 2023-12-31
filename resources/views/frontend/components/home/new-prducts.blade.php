<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                        type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @php
                    $category = App\Models\Category::latest()
                        ->limit(6)
                        ->get();
                @endphp

                @foreach ($category as $item)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category{{ $item->id }}"
                            type="button" role="tab" aria-selected="false">{{ $item->category_name }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($product as $item)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="javascript:;">
                                            <img class="default-img" src="{{ asset($item->product_thambnail) }}"
                                                alt="" />
                                            <img class="hover-img" src="{{ asset($item->product_thambnail) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}"
                                            onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                        <a aria-label="Compare" class="action-btn" id="{{ $item->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $item->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
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
                                        <a href="shop-grid-right.html">{{ $item->category->category_name }}</a>
                                    </div>
                                    <h2><a
                                            href="{{ url('/produt/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                    </h2>
                                    <div class="product-rate-cover">
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $item->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();

                                            $avarage = App\Models\Review::where('product_id', $item->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp

                                        <div class="product-rate d-inline-block">
                                            @if ($avarage == 0)
                                            @elseif($avarage == 1 || $avarage < 2)
                                                <div class="product-rating" style="width: 20%"></div>
                                            @elseif($avarage == 2 || $avarage < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                            @elseif($avarage == 3 || $avarage < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                            @elseif($avarage == 4 || $avarage < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                            @elseif($avarage == 5 || $avarage < 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                            @endif
                                        </div>
                                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
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
                                                <span>${{ $item->discount_price }}</span>
                                                <span class="old-price">${{ $item->selling_price }}</span>
                                            </div>
                                        @endif

                                        <div class="add-cart">
                                            <a class="add"
                                                href="{{ url('/produt/details/' . $item->id . '/' . $item->product_slug) }}"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->

            @foreach ($category as $item)
                <div class="tab-pane fade" id="category{{ $item->id }}" role="tabpanel">
                    <div class="row product-grid-4">
                        @php
                            $category_product = App\Models\Product::where('category_id', $item->id)
                                ->latest()
                                ->get();

                        @endphp
                        @forelse ($category_product as $c_t_product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="javascript:;">
                                                <img class="default-img"
                                                    src="{{ asset($c_t_product->product_thambnail) }}"
                                                    alt="" />
                                                <img class="hover-img"
                                                    src="{{ asset($c_t_product->product_thambnail) }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn"
                                                id="{{ $c_t_product->id }}" onclick="addToWishList(this.id)"><i
                                                    class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" id="{{ $c_t_product->id }}"
                                                onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal" id="{{ $c_t_product->id }}"
                                                onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @php
                                                $amount = $c_t_product->selling_price - $c_t_product->discount_price;
                                                $discount = ($amount / $c_t_product->selling_price) * 100;
                                            @endphp

                                            @if ($c_t_product->discount_price == null)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot">{{ round($discount) }}%</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a
                                                href="shop-grid-right.html">{{ $c_t_product->category->category_name }}</a>
                                        </div>
                                        <h2><a
                                                href="{{ url('/produt/details/' . $c_t_product->id . '/' . $c_t_product->product_slug) }}">{{ $c_t_product->product_name }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            @php
                                            $reviewcount = App\Models\Review::where('product_id', $c_t_product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();

                                            $avarage = App\Models\Review::where('product_id', $c_t_product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp

                                        <div class="product-rate d-inline-block">
                                            @if ($avarage == 0)
                                            @elseif($avarage == 1 || $avarage < 2)
                                                <div class="product-rating" style="width: 20%"></div>
                                            @elseif($avarage == 2 || $avarage < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                            @elseif($avarage == 3 || $avarage < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                            @elseif($avarage == 4 || $avarage < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                            @elseif($avarage == 5 || $avarage < 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                            @endif
                                        </div>
                                            <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                                        </div>
                                        <div>
                                            @if ($c_t_product->vendor_id == null)
                                                <span class="font-small text-muted">By <a
                                                        href="vendor-details-1.html">Owner</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a
                                                        href="vendor-details-1.html">{{ $c_t_product->vendor->name }}</a></span>
                                            @endif

                                        </div>
                                        <div class="product-card-bottom">

                                            @if ($c_t_product->discount_price == null)
                                                <div class="product-price">
                                                    <span>${{ $c_t_product->selling_price }}</span>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <div class="product-price">
                                                        <span>${{ $c_t_product->discount_price }}</span>
                                                        <span
                                                            class="old-price">${{ $c_t_product->selling_price }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="add-cart">
                                                <a class="add"
                                                    href="{{ url('/produt/details/' . $c_t_product->id . '/' . $c_t_product->product_slug) }}"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-center" style="color:red;padding:50px 0px">No product available</h5>
                        @endforelse
                    </div>
                    <!--End product-grid-4-->
                </div>
            @endforeach

            <!--En tab two-->

        </div>
        <!--End tab-content-->
    </div>
</section>
