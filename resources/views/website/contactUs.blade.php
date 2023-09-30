@extends('website.mainLayout')
@section('content')
    @include('layout.sencondBanner')
    <div class="content_wrap">
        <div class="sc_section contact_form_section margin_bottom_huge aligncenter "style="max-width: 800px">
            <div class="row my-5">
                <div class="col-12">
                    <div class="sc_section_inner" >
                        <h6 class="sc_section_subtitle sc_item_subtitle">{{ $pageName }}</h6>
                        <h3
                            class="text-center fs-2 py-3 sc_section_title sc_item_title sc_item_title_without_descr text-uppercase ">
                            CONTACT INFORMATION</h3>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ps-5">
                    <div class="contact-left">
                        <h5 class="sc_title sc_title_regular sc_align_left margin_top_null" style="text-align:left;">Our
                            Location
                        </h5>
                        <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">
                                <p style="text-align: left;">775 Avenue<br>
                                    Brooklyn, NY 10014</p>

                            </div>
                        </div>
                        <h5 class="sc_title sc_title_regular sc_align_left margin_top_small" style="text-align:left;">Phone
                        </h5>
                        <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">
                                <p style="text-align: left;"><a href="tel:+1 (800) 123 4567">+1 (800) 123 4567</a><br>
                                    <a href="tel:+1 (800) 123 4568">+1 (800) 123 4568</a>
                                </p>

                            </div>
                        </div>
                        <h5 class="sc_title sc_title_regular sc_align_left margin_top_small" style="text-align:left;">E-mail
                        </h5>
                        <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">
                                <p style="text-align: left;"><a href="mailto:info@yoursite.com">info@yoursite.com</a></p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="contact-right" style="text-align:left;">
                        <div class="wpcf7 js alert_inited" id="wpcf7-f681-p253-o1" lang="en-US" dir="ltr">
                            <div class="screen-reader-response">
                                <p role="status" aria-live="polite" aria-atomic="true"></p>
                                <ul></ul>
                            </div>
                            <form action="/contacts/#wpcf7-f681-p253-o1" method="post" class="wpcf7-form init"
                                aria-label="Contact form" novalidate="novalidate" data-status="init">
                                <div style="display: none;">
                                    <input type="hidden" name="_wpcf7" value="681">
                                    <input type="hidden" name="_wpcf7_version" value="5.7.6">
                                    <input type="hidden" name="_wpcf7_locale" value="en_US">
                                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f681-p253-o1">
                                    <input type="hidden" name="_wpcf7_container_post" value="253">
                                    <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                                </div>
                                <div class="sc_contact_form_info">
                                    <span class="wpcf7-form-control-wrap" data-name="text-962"><input size="40"
                                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                            aria-required="true" aria-invalid="false" placeholder="Name" value=""
                                            type="text" name="text-962"></span><span class="wpcf7-form-control-wrap"
                                        data-name="email-910"><input size="40"
                                            class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                            aria-required="true" aria-invalid="false" placeholder="E-mail" value=""
                                            type="email" name="email-910"></span>
                                </div>

                                <span class="wpcf7-form-control-wrap" data-name="textarea-335">
                                    <textarea cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required"
                                        aria-required="true" aria-invalid="false" placeholder="Message" name="textarea-335"></textarea>
                                </span>

                                <span class="wpcf7-form-control-wrap" data-name="acceptance-985"><span
                                        class="wpcf7-form-control wpcf7-acceptance"><span
                                            class="wpcf7-list-item"><label><input type="checkbox" name="acceptance-985"
                                                    value="1" aria-invalid="false"><span
                                                    class="wpcf7-list-item-label">I agree that my
                                                    submitted data is being collected and
                                                    stored.</span></label></span></span></span>
                                <div class="form_button"><input class="wpcf7-form-control has-spinner wpcf7-submit"
                                        type="submit" value="Send message" disabled=""><span
                                        class="wpcf7-spinner"></span></div>
                                <div class="wpcf7-response-output" aria-hidden="true"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="sc_googlemap_147351663" class="sc_googlemap" style="width:100%;height:416px;" data-zoom="15"
                    data-style="greyscale"><iframe
                        src="https://maps.google.com/maps?t=m&amp;output=embed&amp;iwloc=near&amp;z=15&amp;q=Berlin"
                        scrolling="no" marginheight="0" marginwidth="0" frameborder="0" aria-label=""></iframe></div>
            </div>
        </div>
    </div>
@endsection


@push('js')
@endpush
