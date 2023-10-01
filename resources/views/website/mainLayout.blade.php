<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/front/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/rs6.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/themes-short-code.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/animation/core.animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/fontello/css/fontello.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/select2.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel='stylesheet' id='reisen-font-google-fonts-style-css'
        href='//fonts.googleapis.com/css?family=Montserrat:300,300italic,400,400italic,700,700italic|Hind:400,700&#038;subset=latin,latin-ext'
        type='text/css' media='all' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Black Bull Tyres</title>
    <style>
        .sc_section.padding_on {
            padding-top: 1em;
            padding-right: 1.3em;
            padding-bottom: 2.5em;
        }

        .sc_section_title {
            font-size: 1.6em;
            margin: 1.12em 0 0.37em;
            text-align: left;
            font-weight: 700;
            text-transform: none;
        }

        .sidebar_outer_logo .logo_main,
        .top_panel_wrap .logo_main,
        .top_panel_wrap .logo_fixed {
            height: 48px;
        }

        .top_panel_wrap .logo_main {
            max-height: 100px;
            width: auto;
        }

        a.sc_button,
        button {
            background-color: #393939 !important;
            color: #ffffff;
            border-color: #393939 !important;
        }

        a.sc_button.sc_button_style_filled,
        .woof_submit_search_form {
            background-color: #bf2d0d !important;
            border-color: #bf2d0d !important;
            color: inherit;
        }

        a:link,
        a:visited,
        a:hover,
        a:active {
            text-decoration: none;
        }

        .section_style_promo_section .sc_item_title {
            font-size: 1.6em;
        }

        .section_style_promo_section .sc_item_title {
            margin: 1.12em 0 0.37em;
            text-align: left;
            font-size: 2em;
            font-weight: 700;
            text-transform: none;
        }

        .sc_button_square {
            font-size: 0.8em !important;
            padding: 0.75em 3.5em 0.9em !important;
        }

        .sc_item_descr {
            line-height: normal;
            font-size: 0.9em;
        }

        .vc_column_container {
            padding-left: 0;
            padding-right: 0;
        }

        .vc_column_inner {
            padding-top: 35px
        }

        .vc_column_container .vc_column_inner {
            box-sizing: border-box;
            padding-left: 15px;
            padding-right: 15px;
            width: 100%;
        }

        .sc_section_subtitle::before {
            color: rgba(57, 57, 57, 0.1);
        }

        a {
            color: #bf2d0d;
        }

        .sc_section_subtitle {
            color: #bf2d0d;
            margin: 4.25em 0 0.05em;
            padding-top: 1.7em;
            font-family: Montserrat, sans-serif;
            font-size: 1.2em;
            font-weight: 400;
            line-height: 1.333em;
            text-transform: uppercase;
            text-align: center;
            position: relative;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            background-color: #f2f3f3;
        }

        input[type="text"]:hover,
        input[type="email"]:hover,
        textarea:hover {
            background-color: #ddd;
        }

        .vc_column-inner .sc_section_title,
        .sc_title {
            font-family: "Montserrat", sans-serif;
            font-size: 2.4em;
            line-height: 1.3em;
            font-weight: 700;
        }

        .sc_title {
            font-size: 1.2em;
        }

        .vc_parallax>* {
            position: relative;
            z-index: 1;
        }

        .top_section,
        .sc_call_to_action_title,
        .sc_call_to_action_descr,
        .sc_intro_content {
            color: #ddd !important;
        }

        .sc_testimonial_author {
            display: block;
            vertical-align: middle;
        }

        .sc_testimonial_content:before {
            font-size: 1em;
            content: '\e820\e820\e820\e820\e820';
            font-family: Fontello, sans-serif;
            position: absolute;
            letter-spacing: 3px;
            left: 50%;
            top: 10px;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        .sc_testimonial_content:before {
            color: #bf2d0d;
        }

        .item_title {
            margin-top: 0em;
            margin-bottom: 1.2em;
            padding: 0 1em;
            overflow: hidden;
            font-family: Montserrat, sans-serif;
            font-size: 1em;
            font-weight: 700;
            line-height: 1.15em;
        }

        .item_title a {
            color: #393939;
            text-transform: uppercase;
        }

        .item_price {
            color: #bf2d0d;
        }

        .price {
            margin-top: 0.6em;
            margin-bottom: 0;
            font-family: Montserrat, sans-serif;
            font-size: 1.6em;
            font-weight: 700;
            line-height: 1.333em;
        }

        .sc_call_to_action_descr {
            font-style: normal;
            font-size: 1.333em;
            font-weight: 400;
            line-height: 1.45em;
            margin-bottom: 0;
            max-width: 400px;
        }

        .vc_service {
            background-color: #f2f3f3 !important;
        }

        .sc_services_image {
            position: absolute;
            width: 30%;
            left: 50%;
            top: 50%;
            transform: translateY(-50%) translateX(-50%);
            text-align: center;
        }

        .service_item {
            margin-right: 33%;
        }

        .service_item .sc_icon {
            display: block;
            width: 3.87em;
            height: 3.87em;
            line-height: 3.87em;
            margin: 0 auto;
            text-align: center;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .service_item .sc_icon {
            margin-bottom: 2.2857em;
            margin-top: 1em;
            background: #ddd;
        }

        .sc_icon {
            border: 2px solid #ddd;
        }

        .service_item_right {
            margin-right: 0px !important;
            margin-left: 20%;
        }

        .service_item_right .sc_icon {
            float: right;
            margin-left: 1.6em;
            margin-right: 0;
        }

        .widget_area .footer_wrap_inner ul li:before {
            top: 3px;
        }
    </style>
    <script>
        function setREVStartSize(e) {
            //window.requestAnimationFrame(function() {
            window.RSIW = window.RSIW === undefined ? window.innerWidth : window.RSIW;
            window.RSIH = window.RSIH === undefined ? window.innerHeight : window.RSIH;
            try {
                var pw = document.getElementById(e.c).parentNode.offsetWidth,
                    newh;
                pw = pw === 0 || isNaN(pw) || (e.l == "fullwidth" || e.layout == "fullwidth") ? window.RSIW : pw;
                e.tabw = e.tabw === undefined ? 0 : parseInt(e.tabw);
                e.thumbw = e.thumbw === undefined ? 0 : parseInt(e.thumbw);
                e.tabh = e.tabh === undefined ? 0 : parseInt(e.tabh);
                e.thumbh = e.thumbh === undefined ? 0 : parseInt(e.thumbh);
                e.tabhide = e.tabhide === undefined ? 0 : parseInt(e.tabhide);
                e.thumbhide = e.thumbhide === undefined ? 0 : parseInt(e.thumbhide);
                e.mh = e.mh === undefined || e.mh == "" || e.mh === "auto" ? 0 : parseInt(e.mh, 0);
                if (e.layout === "fullscreen" || e.l === "fullscreen")
                    newh = Math.max(e.mh, window.RSIH);
                else {
                    e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
                    for (var i in e.rl)
                        if (e.gw[i] === undefined || e.gw[i] === 0) e.gw[i] = e.gw[i - 1];
                    e.gh = e.el === undefined || e.el === "" || (Array.isArray(e.el) && e.el.length == 0) ? e.gh : e.el;
                    e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
                    for (var i in e.rl)
                        if (e.gh[i] === undefined || e.gh[i] === 0) e.gh[i] = e.gh[i - 1];

                    var nl = new Array(e.rl.length),
                        ix = 0,
                        sl;
                    e.tabw = e.tabhide >= pw ? 0 : e.tabw;
                    e.thumbw = e.thumbhide >= pw ? 0 : e.thumbw;
                    e.tabh = e.tabhide >= pw ? 0 : e.tabh;
                    e.thumbh = e.thumbhide >= pw ? 0 : e.thumbh;
                    for (var i in e.rl) nl[i] = e.rl[i] < window.RSIW ? 0 : e.rl[i];
                    sl = nl[0];
                    for (var i in nl)
                        if (sl > nl[i] && nl[i] > 0) {
                            sl = nl[i];
                            ix = i;
                        }
                    var m = pw > (e.gw[ix] + e.tabw + e.thumbw) ? 1 : (pw - (e.tabw + e.thumbw)) / (e.gw[ix]);
                    newh = (e.gh[ix] * m) + (e.tabh + e.thumbh);
                }
                var el = document.getElementById(e.c);
                if (el !== null && el) el.style.height = newh + "px";
                el = document.getElementById(e.c + "_wrapper");
                if (el !== null && el) {
                    el.style.height = newh + "px";
                    el.style.display = "block";
                }
            } catch (e) {
                console.log("Failure at Presize of Slider:" + e)
            }
            //});
        };
    </script>
</head>

<body>
    <div class="body-wrap">
        <div class="page-wrap">
            <header class="top_panel_wrap top_panel_style scheme_original">
                <div class="top_panel_wrap_inner">
                    <div class="top_panel_middle">
                        <div class="content_wrap">
                            <div class="contact_logo">
                                <div class="logo">
                                    <a href="javascript:void()"><img class="logo_main"
                                            src="{{ asset('imgs/logo_with_text.png') }}" alt=""
                                            srcset=""></a>
                                </div>
                            </div>
                            <div class="menu_main_wrap">
                                <nav class="menu_main_nav_area menu_hover_fade">
                                    <ul id="main-menu" class="menu_main_nav inited sf-js-enabled sf-arrows">
                                        <li><a href="{{ route('home') }}"><span>Home</span></a></li>
                                        <li><a href="{{ route('battery') }}"><span>BATTERY</span></a></li>
                                        <li><a href="{{ route('tube') }}"><span>TUBE</span></a></li>
                                        <li><a href="{{ route('tyre') }}"><span>TYRES</span></a></li>
                                        <li><a href="{{ route('about-us') }}"><span>ABOUT</span></a></li>
                                        <li><a href="{{ route('contact-us') }}"><span>CONTACT</span></a></li>
                                    </ul>
                                </nav>
                                <div class="menu_main_cart top_panel_icon">
                                    <a href="#" class="top_panel_cart_button" data-items="0" data-summa="$0">
                                        <span class="contact_icon icon-basket"></span>
                                        <span class="contact_cart_totals">
                                            <span class="cart_items">0 Items</span><span class="cart_summa">$0</span>
                                        </span>
                                    </a>
                                    <ul class="widget_area sidebar_cart sidebar">
                                        <li>
                                            <div class="widget woocommerce widget_shopping_cart" style="display: none;">
                                                <div class="hide_cart_widget_if_empty">
                                                    <div class="widget_shopping_cart_content">

                                                        <p class="woocommerce-mini-cart__empty-message">No products in
                                                            the cart.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </header>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <footer class="footer_wrap widget_area scheme_original">
        <div class="footer_wrap_inner widget_area_inner">
            <div class="content_wrap">
                <div class="row ">
                    <div class="col-3">
                        <div class="widget_inner me-3">
                            <div class="logo">
                                <a href="/"><img src="{{ asset('imgs/bbt_text_logo.png') }}" alt=""
                                        srcset=""></a>
                            </div>
                            <div class="logo_descr">
                                You get to enjoy a super fast and hassle free delivery. Additionaly,
                                upon delivering the wheels & tires, we offer free installation.
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <h4 class="widget_title">
                            Links
                        </h4>
                        <div class="menu-footer-menu-container">
                            <ul id="menu-footer-menu" class="menu">
                                <li id="menu-item-744"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-744">
                                    <a href="https://reisen.themerex.net/">Home</a>
                                </li>
                                <li id="menu-item-349"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-349"><a
                                        href="https://reisen.themerex.net/tires/">Tires</a></li>
                                <li id="menu-item-353"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-353"><a
                                        href="https://reisen.themerex.net/our-services/">Features</a></li>
                                <li id="menu-item-350"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-350"><a
                                        href="https://reisen.themerex.net/shop/">Shop</a></li>
                                <li id="menu-item-352"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-352"><a
                                        href="https://reisen.themerex.net/wheels/">Wheels</a></li>
                                <li id="menu-item-351"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-351"><a
                                        href="https://reisen.themerex.net/contacts/">Contacts</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3">
                        <h4 class="widget_title">
                            Contact Us
                        </h4>
                        <div class="textwidget">Call Us On <a href="tel:2345678900">(234) 567 89 00</a><br>
                            775 Avenue, Brooklyn, NY<br>
                            <a href="mailto:info@site.com">info@site.com</a>
                        </div>
                    </div>
                    <div class="col-3">
                        <h4 class="widget_title">
                            Get Our Newsletter
                        </h4>
                        <div class="textwidget">
                            <script>
                                (function() {
                                    window.mc4wp = window.mc4wp || {
                                        listeners: [],
                                        forms: {
                                            on: function(evt, cb) {
                                                window.mc4wp.listeners.push({
                                                    event: evt,
                                                    callback: cb
                                                });
                                            }
                                        }
                                    }
                                })();
                            </script>
                            <!-- Mailchimp for WordPress v4.9.3 - https://wordpress.org/plugins/mailchimp-for-wp/ -->
                            <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-364" method="post" data-id="364"
                                data-name="">
                                <div class="mc4wp-form-fields">
                                    <div class="emailer">
                                        <input type="email" name="EMAIL" placeholder="email" required=""
                                            autocomplete="off">
                                        <button type="submit" class="icon-icon_5"></button>
                                    </div>
                                </div><label style="display: none !important;">Leave this field empty if you're human:
                                    <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1"
                                        autocomplete="off"></label><input type="hidden" name="_mc4wp_timestamp"
                                    value="1695980981"><input type="hidden" name="_mc4wp_form_id"
                                    value="364"><input type="hidden" name="_mc4wp_form_element_id"
                                    value="mc4wp-form-1">
                                <div class="mc4wp-response"></div>
                            </form><!-- / Mailchimp for WordPress Plugin -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="scroll_to_top icon-up show" title="Scroll to top"></a>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/css/front/js/rbtools.min.js') }}"></script>
    <script src="{{ asset('assets/css/front/js/rs6.min.js') }}"></script>
    @yield('css')
</body>
@yield('add-js')

</html>
