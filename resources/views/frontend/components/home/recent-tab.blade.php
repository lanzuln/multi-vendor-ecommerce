<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($hot_deals as $item)


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}"><img
                                    src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name }}</a>
                            </h6>
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
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_offer as $item)


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}"><img
                                    src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name }}</a>
                            </h6>
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
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">
                    @foreach ($recent_product as $item)


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}"><img
                                    src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name }}</a>
                            </h6>
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
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_deals as $item)


                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}"><img
                                    src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{url('/produt/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name }}</a>
                            </h6>
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
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
