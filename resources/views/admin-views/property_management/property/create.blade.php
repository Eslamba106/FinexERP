@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp

@section('title')
    {{ __('companies.companies') }}
@endsection
@push('css_or_js')
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #dedede;
            border: 1px solid #dedede;
            border-radius: 2px;
            color: #222;
            display: flex;
            gap: 4px;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img width="20px" src="{{ asset('/public/assets/back-end/img/property.jpg') }}" alt="">
                {{ __('property_management.add_new_property') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('property_management.store') }}" method="POST"
            enctype="multipart/form-data" id="product_form">
            @csrf


            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <img width="20px" src="{{ asset('/public/assets/back-end/img/property.jpg') }}" class="mb-1"
                            alt="">
                        <h4 class="mb-0">{{ __('general.general_info') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.property_name') }}</label>
                                <input type="text" class="form-control" name="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="code"
                                    class="title-color">{{ __('property_management.property_code') }}</label>
                                <input type="text" class="form-control" name="code">
                            </div>
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_master.ownership') }}
                                </label>
                                <select class="js-select2-custom form-control" name="ownership_id" required>
                                    <option selected>{{ __('general.select') }}</option>
                                    @foreach ($owner_ship as $ownership)
                                        <option value="{{ $ownership->id }}">{{ $ownership->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ownership_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_master.property_type') }}
                                </label>
                                <select class="js-select2-custom form-control" name="property_type_id" multiple required>
                                    {{-- <option selected>{{ __('general.select') }}</option> --}}
                                    @foreach ($property_type as $propertyType)
                                        <option value="{{ $propertyType->id }}">{{ $propertyType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_type_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.building_no') }}</label>
                                <input type="text" class="form-control" name="building_no">
                                @error('building_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.block_no') }}</label>
                                <input type="text" class="form-control" name="block_no">
                                @error('block_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_management.road') }}</label>
                                <input type="text" class="form-control" name="road">
                                @error('road')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_management.location') }}</label>
                                <input type="text" class="form-control" name="location">
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_management.city') }}</label>
                                <input type="text" class="form-control" name="city">
                                @error('city')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('country.country') }}
                                </label>
                                <select class="js-select2-custom form-control" name="country_master_id" required>
                                    <option selected>{{ __('general.select') }}</option>
                                    @foreach ($country_master as $country)
                                        <option value="{{ $country->country_id }}">{{ $country->country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_master_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <input type="hidden" name="status" value="approved">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                        <img src="{{ asset('/public/assets/back-end/img/seller-information.png') }}" class="mb-1"
                            alt="">
                        {{ __('companies.tax_info') }}
                    </h5>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.established_on') }}</label>
                                <input type="date" class="form-control" name="established_on">
                                @error('established_on')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.registration_on') }}</label>
                                <input type="date" class="form-control" name="registration_on">
                                @error('registration_on')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_management.tax_no') }}</label>
                                <input type="text" class="form-control" name="tax_no">
                                @error('tax_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.municipality_no') }}</label>
                                <input type="text" class="form-control" name="municipality_no">
                                @error('municipality_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.electricity_no') }}</label>
                                <input type="text" class="form-control" name="electricity_no">
                                @error('electricity_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.land_lord_name') }}</label>
                                <input type="text" class="form-control" name="land_lord_name">
                                @error('land_lord_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <input type="hidden" name="status" value="approved">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                        <img src="{{ asset('/public/assets/back-end/img/seller-information.png') }}" class="mb-1"
                            alt="">
                        {{ __('general.personal_info') }}
                    </h5>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.bank_name') }}</label>
                                <input type="text" class="form-control" name="bank_name">
                                @error('bank_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_management.bank_no') }}</label>
                                <input type="text" class="form-control" name="bank_no">
                                @error('bank_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.contact_person') }}</label>
                                <input type="text" class="form-control" name="contact_person">
                            </div>
                            @error('contact_person')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-1">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.dail_code') }}</label>
                                <input type="text" class="form-control" name="dail_code_telephone"
                                    placeholder="+845">
                            </div>
                            @error('dail_code_telephone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.telephone') }}</label>
                                <input type="text" class="form-control" name="telephone">
                            </div>
                            @error('telephone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-1">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.dail_code') }}</label>
                                <input type="text" class="form-control" name="dail_code_mobile" placeholder="+845">
                            </div>
                            @error('dail_code_mobile')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.mobile_no') }}</label>
                                <input type="text" class="form-control" name="mobile">
                            </div>
                            @error('mobile')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="email" class="title-color">{{ __('property_management.email') }}</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-1">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ __('property_management.dail_code') }}</label>
                                <input type="text" class="form-control" name="dail_code_fax" placeholder="+845">
                            </div>
                            @error('dail_code_fax')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="fax" class="title-color">{{ __('property_management.fax_no') }}</label>
                                <input type="text" class="form-control" name="fax">
                            </div>
                            @error('fax')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="total_area"
                                    class="title-color">{{ __('property_management.total_area') }}</label>
                                <input type="text" class="form-control" name="total_area">
                            </div>
                            @error('total_area')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="insurance_provider"
                                    class="title-color">{{ __('property_management.insurance_provider') }}</label>
                                <input type="text" class="form-control" name="insurance_provider">
                            </div>
                            @error('insurance_provider')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="insurance_period_from"
                                    class="title-color">{{ __('property_management.insurance_period_from') }}</label>
                                <input type="date" class="form-control" name="insurance_period_from">
                            </div>
                            @error('insurance_period_from')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="insurance_period_to"
                                    class="title-color">{{ __('property_management.insurance_period_to') }}</label>
                                <input type="date" class="form-control" name="insurance_period_to">
                            </div>
                            @error('insurance_period_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="insurance_type"
                                    class="title-color">{{ __('property_management.insurance_type') }}</label>
                                <input type="text" class="form-control" name="insurance_type">
                            </div>
                            @error('insurance_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="insurance_policy_no"
                                    class="title-color">{{ __('property_management.insurance_policy_no') }}</label>
                                <input type="text" class="form-control" name="insurance_policy_no">
                            </div>
                            @error('insurance_policy_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="insurance_holder"
                                    class="title-color">{{ __('property_management.insurance_holder') }}</label>
                                <input type="text" class="form-control" name="insurance_holder">
                            </div>
                            @error('insurance_holder')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="premium_amount"
                                    class="title-color">{{ __('property_management.premium_amount') }}</label>
                                <input type="text" class="form-control" name="premium_amount">
                            </div>
                            @error('premium_amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 ">
                            <label class="title-color" for="status">
                                {{ __('general.status') }}
                            </label>
                            <div class="input-group">
                                <input type="radio" name="status" class="mr-3 ml-3" checked value="active">
                                <label class="title-color" for="status">
                                    {{ __('general.active') }}
                                </label>
                                <input type="radio" name="status" class="mr-3 ml-3" value="inactive">
                                <label class="title-color" for="status">
                                    {{ __('general.inactive') }}
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset" class="btn btn-secondary px-5">{{ __('general.reset') }}</button>
                <button type="submit" class="btn btn--primary px-5">{{ __('general.submit') }}</button>
            </div>
        </form>
    </div>
    {{-- <div  class="content container-fluid">
        <div class="container my-4 p-3 bg-light rounded shadow-sm">
            <div class="row">
                <!-- القسم الأول -->
                <div class="col-md-3">
                    <p><strong>Code:</strong> abc</p>
                    <p><strong>Building No:</strong> 1</p>
                    <p><strong>City:</strong> Manama</p>
                    <p><strong>Municipality A/C No:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Bank A/C No:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Email:</strong> amit@example.com</p>
                    <p><strong>Insurance Period:</strong> 12th Jun 2024 - 12th May 2025</p>
                    <p><strong>Premium Amount:</strong> <span class="text-danger">0.00</span></p>
                </div>
                <!-- القسم الثاني -->
                <div class="col-md-3">
                    <p><strong>Name:</strong> ABC</p>
                    <p><strong>Block No:</strong> 1</p>
                    <p><strong>Established On:</strong> 06th Dec 2023</p>
                    <p><strong>Electricity A/C No:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Contact Person:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Fax No:</strong> 17691878</p>
                    <p><strong>Insurance Type:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                </div>
                <!-- القسم الثالث -->
                <div class="col-md-3">
                    <p><strong>Type of Ownership:</strong> Owned</p>
                    <p><strong>Road:</strong> 55</p>
                    <p><strong>Registration On:</strong> 06th Dec 2023</p>
                    <p><strong>Land Lord Name:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Telephone No:</strong> 17691878</p>
                    <p><strong>Total Area (Sq. Mts):</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Insurance Policy No:</strong> <span class="text-danger">Not Available</span></p>
                </div>
                <!-- القسم الرابع -->
                <div class="col-md-3">
                    <p><strong>Property Type:</strong> Residential, Commercial, Retail</p>
                    <p><strong>Location / Area:</strong> Manama</p>
                    <p><strong>Tax No:</strong> 1</p>
                    <p><strong>Bank Name:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Mobile No:</strong> 33324702</p>
                    <p><strong>Insurance Provider:</strong> <span class="text-danger">Not Available</span></p>
                    <p><strong>Insurance Holder:</strong> <span class="text-danger">Not Available</span></p>
                </div>
            </div>
            <!-- الصف الأخير -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <p><strong>Created At:</strong> 06th Dec 2024 14:27 PM</p>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Updated At:</strong> <span class="text-danger">Not Available</span></p>
                </div>
            </div>
            <!-- الأزرار -->
            <div class="mt-3 text-center">
                <button class="btn btn-info text-white"><i class="fas fa-eye"></i> Image View</button>
                <button class="btn btn-primary"><i class="fas fa-list"></i> List View</button>
            </div>
        </div>
        
    </div> --}}
@endsection

@push('script')
    <script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>

    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function() {
                new HSTogglePassword(this).init()
            });

            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this));
            });
        });
    </script>
    <script>





        $(document).ready(function() {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
                    .text;
            }
        });
    </script>




@endpush
