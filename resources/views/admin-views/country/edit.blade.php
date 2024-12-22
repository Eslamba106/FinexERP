@extends('layouts.back-end.app')
@section('title', __('country.countries'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Title -->
    <div class="mb-3">
        <h2 class="h1 mb-0 d-flex gap-2">
            <img width="60" src="{{asset('/public/assets/back-end/img/countries.jpg')}}" alt="">
            {{__('country.edit_country')}}
        </h2>
    </div>
    <!-- End Page Title -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    {{ __('country.edit_country')}}
                </div> 
                <div class="card-body" style="text-align: {{ Session::get('locale') === "ar" ? 'right' : 'left'}};">
                    <form action="{{route('country.update' , $country->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('country.country') }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="country_id" id="country"
                                        required>
                                        <option value="0">{{ __('general.select') }}</option>
                                        @forelse ($countries as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ __('country.international_currency_code') }}
                                    </label>
                                    <input type="text" name="international_currency_code" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('country.country_code') }}
                                    </label>
                                    <input type="text" value="" name="country_code" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="currency_symbol"
                                        class="title-color">{{ __('country.currency_symbol') }}
                                    </label>
                                    <input type="text" name="currency_symbol" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('country.countries') }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="country_id" >
                                        @forelse ($regions as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="denomination_name"
                                        class="title-color">{{ __('country.denomination_name') }}
                                    </label>
                                    <input type="text" name="denomination_name" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="currency_name" class="title-color">{{ __('country.currency_name') }}
                                    </label>
                                    <input type="text" name="currency_name" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="currency_name"
                                        class="title-color">{{ __('country.nationality_of_owner') }}
                                    </label>
                                    <input type="text" name="nationality_of_owner" value="" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <button type="reset" class="btn btn-secondary">{{__('general.reset')}}</button>
                            <button type="submit" class="btn btn--primary">{{__('general.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

    
@endsection