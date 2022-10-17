@extends('layouts.admin.app')
@section('title', translate('messages.landing_page_settings'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/admin/css/croppie.css') }}" rel="stylesheet">
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
        <div class="mb-5">
            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.business-settings.landing-page-settings', 'index') }}">{{ translate('messages.text') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.business-settings.landing-page-settings', 'links') }}"
                            aria-disabled="true">{{ translate('messages.button_links') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
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
                        <a class="nav-link active"
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
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->
        <div class="card my-2">
            <div class="card-body">
                <form action="{{ route('admin.business-settings.landing-page-settings', 'background-change') }}"
                    method="POST">
                    @php($backgroundChange = \App\Models\BusinessSetting::where(['key' => 'backgroundChange'])->first())
                    @php($backgroundChange = isset($backgroundChange->value) ? json_decode($backgroundChange->value, true) : null)
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="form-label d-block text-center">{{ translate('messages.change_header_bg') }}</label>
                            <input name="header-bg" type="color" class="form-control form-control-color" value="{{ isset($backgroundChange['header-bg']) ? $backgroundChange['header-bg'] : '#EF7822' }}">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label d-block text-center">{{ translate('messages.change_footer_bg') }}</label>
                            <input name="footer-bg" type="color" class="form-control form-control-color" value="{{ isset($backgroundChange['footer-bg']) ? $backgroundChange['footer-bg'] :'#333E4F'}}">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label d-block text-center">{{ translate('messages.landing_page_bg') }}</label>
                            <input name="landing-page-bg" type="color" class="form-control form-control-color"
                            value="{{ isset($backgroundChange['landing-page-bg']) ? $backgroundChange['landing-page-bg'] : '#ffffff' }}">
                        </div>

                    </div>
                    <div class="form-group text-right mt-3 mb-0">
                        <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script_2')
@endpush
