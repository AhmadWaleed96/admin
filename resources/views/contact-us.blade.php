@extends('layouts.landing.app')

@section('title', 'Contact Us')

@section('content')
    <main>
        <div class="main-body-div">
            <!-- Top Start -->
            <section class="top-start min-height-100px">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-2 text-center">
                            {{-- <h1>{{translate('messages.contact_us')}}</h1> --}}
                        </div>
                        <div class="col-12">
                            <center>
                                <img class="img-fluid w-20" src="{{ asset('public/assets/landing/image/contact.png') }}">
                                <h6 class="mt-4">
                                    Phone : {{ \App\CentralLogics\Helpers::get_settings('phone') }},
                                    Email : {{ \App\CentralLogics\Helpers::get_settings('email_address') }}
                                </h6><br>
                                <h6>
                                    Address : {{ \App\CentralLogics\Helpers::get_settings('address') }}
                                </h6>
                            </center>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Top End -->
        </div>
    </main>
@endsection
