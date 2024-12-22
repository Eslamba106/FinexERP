@extends('layouts.back-end.app')
@section('title', __('property_master.edit_unit'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('public/assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="50" src="{{ asset('/public/assets/back-end/img/units.png') }}" alt="">
                {{ __('property_master.edit_unit') }}
            </h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                       
                        <div class="row">
                            <div class="col-md-12 unit_form  multiple-form" id="multiple-form">
                                <form action="{{ route('unit.unit_multiple_edit' , $main->id) }}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name"
                                            class="title-color">{{ __('property_master.unit_no_prefill_with_zero') }}
                                        </label>
                                        <input type="radio" name="fill_zero" id="active" value="yes"
                                            class="mr-3 ml-3 fill_zero_link" @if(isset($main->width)) checked @endif >
                                        <label class="title-color" for="status">
                                            {{ __('general.yes') }}
                                        </label>
                                        <input type="radio" name="fill_zero" id="inactive" value="no"
                                            class="mr-3 ml-3 fill_zero_link" @if(!isset($main->width)) checked @endif >
                                        <label class="title-color" for="status">
                                            {{ __('general.no') }}
                                        </label>

                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="name"
                                            class="title-color">{{ ($lang == 'ar') ? "رقم الطابق : " : "No. Floor" }}
                                        </label>
                                        <input type="number" value="{{ $main->unit_no }}" name="start_unit_no" class="form-control">
                                    </div>
                                    <div class="form-group fill_zero_link_input ">
                                        <label for="name"
                                            class="title-color">{{ __('property_master.no_of_digits_width') }}
                                        </label>
                                        <input type="number" name="width" value="{{ $main->width }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name"
                                            class="title-color">{{ __('property_master.unit_code_prefix') }}
                                        </label>
                                        <input type="radio" name="unit_code_prefix_status" id="active"
                                            class="mr-3 ml-3 prefix_link"  @if(isset($main->prefix)) checked @endif>
                                        <label class="title-color" for="status">
                                            {{ __('general.yes') }}
                                        </label>
                                        <input type="radio" name="unit_code_prefix_status" id="inactive"
                                            class="mr-3 ml-3 prefix_link" @if(!isset($main->prefix)) checked @endif>
                                        <label class="title-color" for="status">
                                            {{ __('general.no') }}
                                        </label>
                                        <input type="text" name="unit_code_prefix" id="prefix_input"
                                            class="prefix_input form-control " value="{{ $main->prefix }}">
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="status" class="mr-3 ml-3" checked value="active">
                                        <label class="title-color" for="status">
                                            {{ __('general.active') }}
                                        </label>
                                        <input type="radio" name="status" class="mr-3 ml-3" value="inactive">
                                        <label class="title-color" for="status">
                                            {{ __('general.inactive') }}
                                        </label>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-end">
                                        <button type="reset" id="reset"
                                            class="btn btn-secondary px-4">{{ __('general.reset') }}</button>
                                        <button type="submit"
                                            class="btn btn--primary px-4">{{ __('general.next') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(".type_link").click(function(e) {
            e.preventDefault();
            $(".type_link").removeClass('active');
            $(".unit_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            console.log(form_id)
            if (form_id === 'single-link') {
                $("#single-form").removeClass('d-none').addClass('active');
                $("#multiple-form").removeClass('active').addClass('d-none');
            } else if (form_id === 'multiple-link') {
                $("#multiple-form").removeClass('d-none').addClass('active');
                $("#single-form").removeClass('active').addClass('d-none');
            }

        });
        $(".prefix_link").click(function() {
            $(".prefix_input").addClass('d-none');
            if ($(this).attr('id') === "active") {
                $(".prefix_input").removeClass('d-none');
            }
        });
        $(".fill_zero_link").click(function() {
            $(".fill_zero_link_input").addClass('d-none');
            if ($(this).attr('id') === "active") {
                $(".fill_zero_link_input").removeClass('d-none');
            }
        });

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="{{ asset('public/assets/back-end') }}/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });


        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
   
    </script>
@endpush
