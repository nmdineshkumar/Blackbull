@php
    $maker =  Request::get('maker') ;
    $model =  Request::get('model') ;
    $year =  Request::get('year') ;
    $size =  Request::get('size') ;
    
@endphp
@extends('website.mainLayout')

@section('css')
    <style>
        .page_content_wrap {
            background-color: #e3e3e3 !important;
        }

        .sc_item_title {
            margin: 2.75em 0 1.7em;
            text-align: center;
        }

        .content-wraper {
            padding: 0.75em 0 1.7em;
        }

        .content h3 {
            font-family: "Montserrat", sans-serif;
            font-size: 2.4em;
            line-height: 1.3em;
            font-weight: 700;
            margin-top: 2.5em;
            margin-bottom: 0.75em;
        }

        .filter-select {
            width: 23% !important;
            padding-left: 3.6em;
            background-color: #cecfd0;
            border-radius: 1.6em;
            position: relative;
            margin-left: 0.75%;
            margin-right: 0.75%;
            box-sizing: border-box;
        }

        .selectpicker {
            border: 0px;
            width: 100%;
        }

        .filter-select .select2-selection__arrow {
            top: 50%;
            transform: translateY(-50%);
            right: 0.7em;
        }

        .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }

        .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0;
        }

        .woof_container_inner,
        .woof_submit_search_form_container {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .woof_submit_search_form_container {
            text-align: center;
            padding-top: 1.9em;
            width: 100%;
            justify-content: center;
        }

        .woof_submit_search_form_container button {
            float: none !important;
            font-size: 0.933em;
            padding: 1em 2.85em 1.1em;
            margin: 0 0.5em 1px 0.5em;
            color: #e3e3e3;
        }

        input[type="button"],
        button,
        .sc_button {
            display: inline-block;
            text-align: center;
            padding: 0.75em 3.5em 0.9em;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 2em;
            border: 2px solid;
        }

        .select2-selection:before {
            content: counter(nums) '. ';
            counter-increment: nums;
            font-family: Montserrat, sans-serif;
            font-size: 0.933em;
            font-weight: 700;
            position: absolute;
            left: 2em;
            top: 50%;
            transform: translateY(-50%);
        }

        .add_to_cart {
            display: block;
            width: 60px;
            height: 60px;
            line-height: 60px;
            background: #fff;
            color: #2d2d2d;
            margin-bottom: 1px;
            -webkit-transition: -webkit-transform .3s, color .3s, background-color .3s;
            -ms-transition: -ms-transform .3s, color .3s, background-color .3s;
            transition: transform .3s, color .3s, background-color .3s;
        }

        .add_to_cart a>i {
            font-size: 20px;
        }

        .trx_demo_icon-shopping-cart:before {
            content: '\e876';
        }

        [class^="trx_demo_icon-"]:before,
        [class*=" trx_demo_icon-"]:before {
            font-family: "trx_demo_icons";
            font-style: normal;
            font-weight: normal;
            speak: never;
            display: inline-block;
            text-decoration: inherit;
            width: 1em;
            margin-right: .2em;
            text-align: center;
            /* opacity: .8; */
            font-variant: normal;
            text-transform: none;
            line-height: 1em;
            margin-left: .2em;
            /* font-size: 120%; */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            /* text-shadow: 1px 1px 1px rgba(127, 127, 127, 0.3); */
        }
    </style>
@endsection

@section('content')
    @include('layout.sencondBanner')
    <div class="page_content_wrap page_paddings_no">
        <div class="content_wrap">
            <div class="content-wraper">
                <div class="dv-full-width">
                    <div class="sc_section animated fadeInUp normal" data-animation="animated fadeInUp normal">
                        <h3 class="sc_section_title sc_item_title sc_item_title_without_descr text-uppercase">find the best
                            option for
                            your vehicle</h3>
                        <div class="sc_section_inner">
                            <div class="woof_container_inner woof_container_inner_makemodelyearsize">
                                <div class="filter-select select2-selection">
                                    <select data-filter="true" data-target="model"
                                        data-url="{{ route('frontend.filter.model', ':id') }}" id="make"
                                        class="selectpicker" data-live-search="true" data-container="body">
                                        <option value="">MAKE</option>
                                        @foreach ($make as $row)
                                            @if ($maker == $row->id)
                                                <option selected value="{{ $row->id }}">
                                                    {{ $row->name . '(' . $row->countNo . ')' }}
                                                </option>
                                            @else
                                                <option value="{{ $row->id }}">
                                                    {{ $row->name . '(' . $row->countNo . ')' }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="select2-selection__arrow" role="presentation"><b
                                            role="presentation"></b></span>
                                </div>
                            </div>
                            <div class="woof_submit_search_form_container">
                                <button class="button woof_submit_search_form">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content_wrap">
        <div class="row my-5">
            <div class="col-12">
                <div class="row p-0">
                    @foreach ($tyre as $row)
                        <div class="col-3">
                            <div class="card rounded-0">
                                <a class="hover_icon hover_icon_link mb-3"
                                    href="{{ route('frontend.tyre.product-detail', base64_encode($row->id)) }}"><img class="card-img-top"
                                        alt="Multiple Options"
                                        src="{{ asset('storage/products/tyre/' . $row->image) }}"></a>
                                <div class="card-body text-center">
                                    <div class="sc_services_item_content">
                                        <h4 class="item_title"><a
                                                href="{{ route('frontend.tyre.product-detail', base64_encode($row->id)) }}">{{ $row->name }}<br>{{ \App\Http\Controllers\HelperController::get_TyreSize($row->tyre_size) }}</a>
                                        </h4>
                                        <div class="item_price">
                                            <p>AED {{ $row->price }}</p>
                                        </div>
                                        <div class="product-link">
                                            {{-- <a class="sc_button sc_button_square sc_button_style_filled_dark sc_button_size_small"
                                                href="https://1.envato.market/4ey0Wr" target="_blank" aria-label="Buy theme"
                                                data-type="link" style="color:#ffffff;background-color:#bf2d0d;display:inline-block"><i
                                                    class="icon-wallet-light"></i></a> --}}
                                            <a href="{{ route('frontend.tyre.product-detail', base64_encode($row->id)) }}"
                                                class="sc_button sc_button_square sc_button_style_filled_dark sc_button_size_small">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 my-5 text-center">
                {!! $tyre->links() !!}
            </div>
        </div>
    </div>
@endsection


@section('add-js')
<script>
     $('select[data-filter=true]').on('change', function(e) {
            if (this.value != '') {
                LoadFilter(e);
            }
        });

        function LoadFilter(e) {
            var id = e.currentTarget.id;
            let targetElement = $(e.currentTarget).attr('data-target');
            let url = $(e.currentTarget).attr('data-url');
            url = url.replace(':id', e.currentTarget.value);
            if (id == 'year') {
                url = url + '?make=' + $('#make').val() + '&model=' + $('#model').val();
            }
            $.ajax({
                url: url,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    getCarModel(data, targetElement);
                },
                error: function(data) {

                }
            })
        }

        function getCarModel(data, id) {
            $('#' + id).parent().remove();
            let divElement = document.createElement('div');
            let selectElement = document.createElement('select');
            let selecterElement = document.getElementsByClassName('woof_container_inner');
            let spanElement = document.createElement('span');
            let bElement = document.createElement('b');
            bElement.setAttribute('role', 'presentation')
            spanElement.className = "select2-selection__arrow";
            spanElement.append(bElement);
            divElement.className = "filter-select select2-selection";
            selectElement.id = id;
            selectElement.name = 'car-' + id;
            if (data['url'] != '') {
                selectElement.setAttribute('data-target', data['target']);
                selectElement.setAttribute('data-url', data['url']);
                selectElement.setAttribute('data-filter', 'true');
            }
            selectElement.className = "selectpicker";
            selectElement.append(new Option(id.toUpperCase(), ''))
            data['model'].forEach(element => {
                if (data['url'] != '') {
                    selectElement.append(new Option(element.name + '(' + element.countNo + ')', element.id));
                } else {
                    selectElement.append(new Option(element.name, element.id));
                }
            });
            selectElement.addEventListener('change', function(e) {
                if (this.value != '') {
                    LoadFilter(e);
                }
            });
            divElement.append(selectElement);
            divElement.append(spanElement)
            $(selecterElement).append(divElement)
        }
        $('#btn_search').on('click', function(e) {
            let url = '';
            let maker = model = year = size = '';
            maker = $('#make').val();
            model = $('#model').val() == undefined ? '' : $('#model').val();
            year = $('#year').val() == undefined ? '' : $('#year').val();
            size = $('#size').val() == undefined ? '' : $('#size').val();
            url = '{{route('frontend.tyre.product-search')}}'
            url += '?maker=' + maker + '&size=' + size+'&model=' + model+'&year=' + year;
            if(maker == '' || maker == undefined) {
                alert('Please choose any one of the following options');
                return false;
            }
            window.location.href = url;
        })
</script>
@endsection
