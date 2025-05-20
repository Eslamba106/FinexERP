@extends('layouts.back-end.app')

@section('title', __('roles.create_floor_management'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .floor-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .floor-item {
            display: flex;
            align-items: center;
            background-color: #f5f5dc;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .floor-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .floor-item:hover {
            background-color: #e0e0d1;
        }

        .floor-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt="">
                {{ __('roles.create_floor_management') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('floor_management.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <img src="{{ asset(main_path() . 'back-end/img/shop-information.png') }}" class="mb-1"
                            alt="">
                        <h4 class="mb-0">{{ __('roles.create_floor_management') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_management.property') }}
                                </label>
                                <select class="js-select2-custom form-control" name="property" required>
                                    <option selected disabled>{{ __('general.select') }}
                                    </option>
                                    @foreach ($property as $property_item)
                                        <option value="{{ $property_item->id }}">
                                            {{ $property_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('property_master.blocks') }}
                                </label>
                                <select class="js-select2-custom form-control" name="block" required disabled>
                                    <option selected>{{ __('general.select') }}
                                    </option>
                                    @foreach ($blocks as $block_item)
                                        <option value="{{ $block_item->id }}">
                                            {{ $block_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="token" class="title-color">{{ __('Total No. Floor *') }}</label>
                                <input type="text" class="form-control" name="floor_count">
                            </div>
                        </div>


                        <div class="col-md-6 col-lg-4 col-xl-12 floors d-none">
                            <div class="floor-title">{{ __('property_master.floors') }}</div>
                            <div class="floor-container">
                                @foreach ($floors as $floor_item)
                                    <label class="floor-item">
                                        <input type="checkbox" name="floors[]" value="{{ $floor_item->id }}">
                                        {{ $floor_item->name }}
                                    </label>
                                @endforeach


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
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('select[name="property"]').on('change', function() {
                var property = $(this).val();
                if (property) {
                    $.ajax({
                        url: "{{ URL::to('floor_management/get_blocks_by_property_id') }}/" +
                            property,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="block"]').removeAttr('disabled');
                                console.log(data);
                                $('select[name="block"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="block"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .block.name + '</option>'
                                    )
                                })

                            } else {
                                // $('input[name="token"]').removeAttr('disabled')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                            // $('input[name="token"]').removeAttr('disabled')
                            // 
                        }
                    });
                }

            });

            // $('input[name="floor_count"]').on('keyup', function() {
            //     var count = $(this).val();
            //     var floors = $('.floors');
            //     $('.floors').removeClass('d-none');
            //     $('input[name="floors[]"]').each(floors, function());
            // })
            $('input[name="floor_count"]').on('keyup', function() {
                var count = parseInt($(this).val());
                $('.floors').removeClass('d-none');

                $('input[name="floors[]"]').each(function(index) {
                    if (index < count) {
                        $(this).prop('checked', true);  
                    } else {
                        $(this).prop('checked', false); 
                    }
                });
            });

        });
    </script>
@endpush
