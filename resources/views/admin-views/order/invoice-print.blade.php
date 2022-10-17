@extends('layouts.admin.print')

@section('title','')

@push('css_or_js')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap');
        @media print {
            .non-printable {
                display: none;
            }

            .printable {
                display: block;
                font-family: 'Roboto Mono', monospace !important;
            }

            body {
                -webkit-print-color-adjust: exact !important; /* Chrome, Safari */
                color-adjust: exact !important;
                font-family: 'Roboto Mono', monospace !important;
            }
        }
    </style>

    <style type="text/css" media="print">
        @page {
            size: auto;   /* auto is the initial value */
            margin: 2px;  /* this affects the margin in the printer settings */
            font-family: 'Roboto Mono', monospace !important;
        }

    </style>
@endpush

@section('content')

@include('admin-views.order.partials._invoice')

@endsection

