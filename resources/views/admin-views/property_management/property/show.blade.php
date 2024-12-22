@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', __('property_management.property'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">
                <img width="60" src="{{ asset('/public/assets/back-end/img/property.jpg') }}" alt="">
                {{ __('property_management.property') }}
            </h2>
            {{-- <a href="{{ route('property_management.create') }}"
                class="btn btn--primary">{{ __('property_management.add_new_property') }}</a> --}}
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row  @if ($lang == 'ar') rtl text-start @else ltr @endif">

            <div class="col-md-12">
                <div class="card">
                    <div class="property-management">
                        <div class="content m-2 @if ($lang == 'ar') rtl @else ltr @endif">
                            <div class="row ">
                                <div class="col-md-3 ">
                                    <p><strong>{{ __('property_master.code') }} :</strong> {{ $property->code }}</p>
                                    <p><strong>{{ __('property_management.building_no') }} :</strong> {{ $property->building_no }}</p>
                                    <p><strong>{{ __('companies.city') }}:</strong> {{ $property->city }}</p>
                                    <p><strong>{{ __('property_management.municipality_no') }} : </strong>@if($property->municipality_no != null)   {{ $property->municipality_no }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif</p>
                                    <p><strong>{{ __('property_management.bank_no') }} : </strong> @if($property->bank_no != null)   {{ $property->bank_no }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('login.email') }}:</strong> @if($property->email != null)   {{ $property->email }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.insurance_period_from') }} : </strong> @if($property->insurance_period_from != null )   {{ $property->insurance_period_from }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __("property_management.insurance_period_to") }} : </strong> @if($property->insurance_period_to != null )   {{ $property->insurance_period_to   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __("property_management.premium_amount") }} : </strong> @if($property->premium_amount != null )   {{ $property->premium_amount   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                </div>
                                <div class="col-md-3 ">
                                    <p><strong>{{ __('property_master.name') }} : </strong> @if($property->name != null )   {{ $property->name   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.block_no') }} : </strong> @if($property->block_no != null )   {{ $property->block_no   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.established_on') }} : </strong> @if($property->established_on != null )   {{ $property->established_on   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.electricity_no') }} : </strong> @if($property->electricity_no != null )   {{ $property->electricity_no   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.contact_person') }} : </strong> @if($property->contact_person != null )   {{ $property->contact_person   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('companies.fax') }} : </strong> @if($property->fax != null )   {{ "(".$property->dail_code_fax .")" . $property->fax   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.insurance_type') }} : </strong> @if($property->insurance_type != null )   {{ $property->insurance_type   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('general.status') }} : </strong> @if($property->status != null )   {{ __('general.'. $property->status)   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                </div>
                                <div class="col-md-3 ">
                                    <p><strong>{{ __('property_management.type_of_ownership') }} : </strong> @if($property->ownership_id != null )   {{ $property->ownership->name   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.road') }} : </strong> @if($property->road != null )   {{ $property->road   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.registration_on') }} : </strong> @if($property->registration_on != null )   {{ $property->registration_on   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.land_lord_name') }} : </strong> @if($property->land_lord_name != null )   {{ $property->land_lord_name   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.telephone') }} : </strong> @if($property->telephone != null )   {{ "(".$property->dail_code_telephone .")" . $property->telephone   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.total_area') }} : </strong> @if($property->total_area != null )   {{ $property->total_area   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.insurance_policy_no') }} : </strong> @if($property->insurance_policy_no != null )   {{ $property->insurance_policy_no   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('roles.Created_At') }} : </strong> @if($property->created_at != null )   {{ $property->created_at->shortAbsoluteDiffForHumans()   }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                </div>
                                <div class="col-md-3 ">
                                    <p><strong>{{ __('property_master.property_type') }} : </strong> @if($property->property_type != null )   {{ $property->property_type }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.location') }} : </strong> @if($property->location != null )   {{ $property->location }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.tax_no') }} : </strong> @if($property->tax_no != null )   {{ $property->tax_no }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.bank_name') }} : </strong> @if($property->bank_name != null )   {{ $property->bank_name }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.mobile_no') }} : </strong> @if($property->mobile != null )   {{  "(".$property->dail_code_mobile .")" . $property->mobile }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.insurance_provider') }} : </strong> @if($property->insurance_provider != null )   {{ $property->insurance_provider }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                    <p><strong>{{ __('property_management.insurance_holder') }} : </strong> @if($property->insurance_holder != null )   {{ $property->insurance_holder }} @else <span class="not-available"> {{ __('general.not_available') }}</span> @endif </p>
                                </div>
                            </div>
                            
                        </div>
                        
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
