@extends('layouts.admin.app')

@section('title',translate('messages.landing_page_settings'))

@push('css_or_js')
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header pb-0">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('public/assets/admin/img/landing.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.landing_page_settings') }}
            </span>
        </h1>
    </div>
    <!-- Nav Scroller -->
    <div class="mb-5">
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active"
                        href="{{ route('admin.business-settings.landing-page-settings', 'index') }}">{{ translate('messages.text') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.business-settings.landing-page-settings', 'links') }}"
                        aria-disabled="true">{{ translate('messages.button_links') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.business-settings.landing-page-settings', 'speciality') }}"
                        aria-disabled="true">{{ translate('messages.speciality') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.business-settings.landing-page-settings', 'testimonial') }}"
                        aria-disabled="true">{{ translate('messages.testimonial') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.business-settings.landing-page-settings', 'feature') }}"
                        aria-disabled="true">{{ translate('messages.feature') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.business-settings.landing-page-settings', 'image') }}"
                        aria-disabled="true">{{ translate('messages.image') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.business-settings.landing-page-settings', 'background-change') }}"
                        aria-disabled="true">{{ translate('messages.background_color') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.business-settings.landing-page-settings', 'web-app') }}"
                        aria-disabled="true">{{ translate('messages.web_app') }}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
    </div>
    <!-- End Nav Scroller -->

    <!-- End Page Header -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.business-settings.landing-page-settings', 'text') }}" method="POST">
                @php($landing_page_text = \App\Models\BusinessSetting::where(['key' => 'landing_page_text'])->first())
                @php($landing_page_text = isset($landing_page_text->value) ? json_decode($landing_page_text->value, true) : null)
                @csrf
                <div class="form-group">
                    <label for="header_title_1">{{ translate('messages.header_title_1') }}</label>
                    <input type="text" id="header_title_1" name="header_title_1" class="form-control"
                        value="{{ isset($landing_page_text) ? $landing_page_text['header_title_1'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="header_title_2">{{ translate('messages.header_title_2') }}</label>
                    <input type="text" id="header_title_2" name="header_title_2" class="form-control"
                        value="{{ isset($landing_page_text) ? $landing_page_text['header_title_2'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="header_title_3">{{ translate('messages.header_title_3') }}</label>
                    <input type="text" id="header_title_3" name="header_title_3" class="form-control"
                        value="{{ isset($landing_page_text) ? $landing_page_text['header_title_3'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="about_title">{{ translate('messages.about_title') }}</label>
                    <input type="text" id="about_title" name="about_title" class="form-control"
                        value="{{ isset($landing_page_text) ? $landing_page_text['about_title'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="why_choose_us">{{ translate('messages.why_choose_us') }}</label>
                    <input type="text" id="why_choose_us" name="why_choose_us" class="form-control"
                        value="{{ isset($landing_page_text) ? $landing_page_text['why_choose_us'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="mobile_app_section_heading">{{ translate('messages.mobile_app_section_heading') }}</label>
                    <input type="text" id="mobile_app_section_heading" name="mobile_app_section_heading" class="form-control"
                    value="{{ isset($landing_page_text['mobile_app_section_heading']) ? $landing_page_text['mobile_app_section_heading'] : '' }}">

                </div>
                <div class="form-group">
                    <label for="mobile_app_section_text">{{ translate('messages.mobile_app_section_text') }}</label>
                    <input type="text" id="mobile_app_section_text" name="mobile_app_section_text" class="form-control"
                    value="{{ isset($landing_page_text['mobile_app_section_text']) ? $landing_page_text['mobile_app_section_text'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="why_choose_us_title">{{ translate('messages.why_choose_us_title') }}</label>
                    <input type="text" id="why_choose_us_title" name="why_choose_us_title" class="form-control"
                        value="{{ isset($landing_page_text) ? $landing_page_text['why_choose_us_title'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="testimonial_title">{{ translate('messages.testimonial_title') }}</label>
                    <input type="text" id="testimonial_title" name="testimonial_title" class="form-control"
                        value="{{ isset($landing_page_text) ? $landing_page_text['testimonial_title'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="feature_section_title">{{ translate('messages.feature_section_title') }}</label>
                    <input type="text" id="feature_section_title" name="feature_section_title" class="form-control"
                        value="{{ isset($landing_page_text['feature_section_title']) ? $landing_page_text['feature_section_title'] : '' }}">
                </div>
                <div class="form-group">
                    <label for="feature_section_description">{{ translate('messages.feature_section_description') }}</label>
                    <textarea id="feature_section_description" name="feature_section_description" class="form-control" cols="30" rows="5">
                        {{ isset($landing_page_text['feature_section_description']) ? $landing_page_text['feature_section_description'] : '' }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="footer_article">{{ translate('messages.footer_article') }}</label>
                    <textarea type="text" id="footer_article" name="footer_article"
                        class="form-control">{{ isset($landing_page_text) ? $landing_page_text['footer_article'] : '' }}</textarea>
                </div>
                <div class="btn--container justify-content-end">
                    <button type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                    <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script_2')
<script>
    $('document').ready(function() {
        $('textarea').each(function() {
            $(this).val($(this).val().trim());
        });
    });
</script>
@endpush
