@extends('website.mainLayout')

@section('css')
    <style>
        div.quantity {
            margin: 0 1.25em 0 0;
            width: 7em;
            height: 2.85em;
            position: relative;
        }

        div.quantity span.q_inc {
            top: 2px;
            line-height: 1.8;
            border-radius: 0 1.7rem 0 0;
        }

        div.quantity span {
            background-color: #f2f3f3;
            color: #888888;
        }

        div.quantity input[type="number"] {
            width: 100%;
            height: 100%;
            padding-right: 2px;
            border: 0px;
            background: #f2f3f3;
        }

        div.quantity span {
            display: block;
            position: absolute;
            z-index: 1;
            right: 2px;
            width: 3em;
            height: 50%;
            text-align: center;
            line-height: 1.1em;
            cursor: pointer;
            -webkit-transition: all ease .3s;
            -moz-transition: all ease .3s;
            -ms-transition: all ease .3s;
            -o-transition: all ease .3s;
            transition: all ease .3s;
        }

        div.quantity span.q_inc:before {
            content: '\e835';
        }

        div.quantity span.q_dec:before {
            content: '\e828';
        }

        div.quantity span.q_dec {
            bottom: 2px;
            border-radius: 0 0 1.7rem 0;
        }

        div.quantity span:before {
            font-family: 'fontello';
        }

        .stretch-width {
            background-color: #f2f3f3;
        }
       
    </style>
@endsection

@section('content')
    @include('layout.sencondBanner')
    <div class="content_wrap">
        <div class="my-5">
            <div class="row py-5">
                <div class="col-md-6 col-sm-12">
                    <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                        data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;"><a href="#"
                            class="woocommerce-product-gallery__trigger">🔍</a>
                        <figure class="woocommerce-product-gallery__wrapper">
                            <div data-thumb="{{ asset('storage/products/tube/' . $product->image) }}" data-thumb-alt=""
                                class="woocommerce-product-gallery__image" style="position: relative; overflow: hidden;"><a
                                    href="{{ asset('storage/products/tube/' . $product->image) }}"
                                    rel="prettyPhoto[slideshow]" class="inited"><img width="600" height="600"
                                        src="{{ asset('storage/products/tube/' . $product->image) }}" class="wp-post-image"
                                        alt="" decoding="async" loading="lazy" title="i3" data-caption=""
                                        data-src="{{ asset('storage/products/tube/' . $product->image) }}"
                                        data-large_image="{{ asset('storage/products/tube/' . $product->image) }}"
                                        data-large_image_width="1200" data-large_image_height="1200"
                                        srcset="{{ asset('storage/products/tube/' . $product->image) }}"
                                        sizes="(max-width: 600px) 100vw, 600px"></a><img role="presentation" alt=""
                                    src="{{ asset('storage/products/tube/' . $product->image) }}" class="zoomImg"
                                    style="position: absolute; top: -192.315px; left: -269.478px; opacity: 0; width: 1200px; height: 1200px; border: none; max-width: none; max-height: none;">
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="summary entry-summary">
                        <h1 class="product_title entry-title">{{ $product->name }}</h1>
                        <p class="price"><span class="woocommerce-Price-amount amount" style="color: #bf2d0d"><bdi><span
                                        class="woocommerce-Price-currencySymbol">AED
                                    </span>{{ $product->price }}</bdi></span></p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-3 py-2"><label for="" class="fw-bold">Brand</label></div>
                        <div class="col-sm-12 col-md-9  py-2">
                            {{ \App\Http\Controllers\HelperController::get_BrandName($product->brand) }}</div>
                        <div class="col-sm-12 col-md-3 py-2"><label for="" class="fw-bold">Capacity</label></div>
                        <div class="col-sm-12 col-md-9 py-2">
                            {{ $product->capacity }}</div>
                        <div class="col-sm-12 col-md-3 py-2"><label for="" class="fw-bold">Model</label></div>
                        <div class="col-sm-12 col-md-9 py-2">
                            {{ $product->model_number }}</div>
                        <div class="col-sm-12 col-md-3 py-2"><label for="" class="fw-bold">Voltage</label></div>
                        <div class="col-sm-12 col-md-9 py-2">
                            {{ $product->voltage }}</div>
                        
                        <div class="col-sm-12 col-md-6 py-2 d-flex justify-content-between">
                            <div class="quantity position-relative">
                                <label class="screen-reader-text" for="quantity_6517ca072d511">VDRM 3PC 18/20/24 polished
                                    steel, matt quantity</label>
                                <input type="number" id="quantity" class="input-text qty text" name="quantity"
                                    value="1" title="Qty" +size="4" min="1" max=""
                                    step="1" placeholder="" inputmode="numeric" autocomplete="off">
                                <span class="q_inc"></span><span class="q_dec"></span>
                            </div>
                            <button type="submit"
                                class="single_add_to_cart_button button alt wp-element-button rounded-pill "
                                style="padding: 9px 25px">Add to cart</button>
                        </div>
                        <div class="col-sm-12 col-md-12 py-5">
                            <div class="product_meta">
                                <span class="sku_wrapper d-flex">SKU: <span
                                        class="sku ms-3">{{ $product->sku }}</span></span>
                                <span class="posted_in  d-flex">Categories: <a
                                        href="https://reisen.themerex.net/product-category/tires/" rel="tag" class="ms-3">Tube</a></span>
                                
                                <span class="product_id  d-flex">Product ID: <span class="ms-3">{{$product->id}}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="stretch-width py-5 mb-5">
        <div class="content_wrap">
            <h2 class="fw-bold">DESCRIPTION</h2>
            <div class="row">
                <div class="col-12 p-4">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
    </div>
    <div class="content_wrap">
        <section class="related products my-5">
            <h2 class="text-center fw-bold my-5">Related products</h2>
            <div class="row">
                @foreach ($battery as $row)
                <div class="col-md-3 col-sm-12">
                    <div class="card rounded-0">
                        <a class="hover_icon hover_icon_link mb-3"
                            href="{{ route('frontend.battery.product-detail', base64_encode($row->id)) }}"><img class="card-img-top"
                                alt="Multiple Options" src="{{ asset('storage/products/tube/' . $row->image) }}"></a>
                        <div class="card-body text-center">
                            <div class="sc_services_item_content">
                                <h4 class="item_title"><a
                                        href="{{ route('frontend.battery.product-detail', base64_encode($row->id)) }}">{{ $row->name }}<br>{{ $row->capacity }}</a>
                                </h4>
                                <div class="item_price">
                                    <p>AED {{ $row->price }}</p>
                                </div>
                                <div class="product-link">
                                    {{-- <a class="sc_button sc_button_square sc_button_style_filled_dark sc_button_size_small"
                                        href="https://1.envato.market/4ey0Wr" target="_blank" aria-label="Buy theme"
                                        data-type="link" style="color:#ffffff;background-color:#bf2d0d;display:inline-block"><i
                                            class="icon-wallet-light"></i></a> --}}
                                    <a href="{{ route('frontend.battery.product-detail', base64_encode($row->id)) }}"
                                        class="sc_button sc_button_square sc_button_style_filled_dark sc_button_size_small">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection


@section('add-js')
    <script>
        $('.q_inc').on('click', function(e) {
            var qty = $('#quantity').val();
            qty = Number((qty == null ? 0 : qty)) + 1
            $('#quantity').val(qty);
        })
        $('.q_dec').on('click', function(e) {
            var qty = $('#quantity').val();
            if (qty > 1) {
                qty = Number((qty == null ? 0 : qty)) - 1
                $('#quantity').val(qty);
            }
        })
        
    </script>
@endsection
