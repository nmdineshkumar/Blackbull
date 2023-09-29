<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/front/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/rs6.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/themes-short-code.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/animation/core.animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front/fontello/css/fontello.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/front/select2.css')}}">
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

        a.sc_button,button {
            background-color: #393939 !important;
            color: #ffffff;
            border-color: #393939 !important;
        }

        a.sc_button.sc_button_style_filled,.woof_submit_search_form {
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

        .vc_column-inner .sc_section_title {
            font-family: "Montserrat", sans-serif;
            font-size: 2.4em;
            line-height: 1.3em;
            font-weight: 700;
        }

        .vc_parallax>* {
            position: relative;
            z-index: 1;
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
                                            src="{{ asset('imgs/logo.jpeg') }}" alt="" srcset=""></a>
                                </div>
                            </div>
                            <div class="menu_main_wrap">
                                <nav class="menu_main_nav_area menu_hover_fade">
                                    <ul id="main-menu" class="menu_main_nav inited sf-js-enabled sf-arrows">
                                        <li><a href=""><span>Home</span></a></li>
                                        <li><a href=""><span>FEATURE</span></a></li>
                                        <li><a href=""><span>WHEELS</span></a></li>
                                        <li><a href=""><span>TYRES</span></a></li>
                                        <li><a href=""><span>ABOUT</span></a></li>
                                        <li><a href=""><span>CONTACT</span></a></li>
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
            @include('website.banner_Layout')
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/css/front/js/rbtools.min.js') }}"></script>
    <script src="{{ asset('assets/css/front/js/rs6.min.js') }}"></script>

</body>

</html>
