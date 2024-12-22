@extends('layouts.back-end.app')
@section('title', __('property_master.add_new_floor'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('public/assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .custom-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /*
                .legend {
                    margin-bottom: 20px;
                }

                .legend-item {
                    display: inline-block;
                    padding: 5px 10px;
                    margin-right: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    font-size: 14px;
                }

                .floors {
                    background-color: #40E0D0;
                    color: #000;
                }

                .empty-units {
                    background-color: #fff;
                    color: #000;
                }

                .enquired-units {
                    background-color: #32CD32;
                    color: #fff;
                }

                .proposed-units {
                    background-color: #FFD700;
                    color: #000;
                }

                .booked-units {
                    background-color: #FF69B4;
                    color: #fff;
                }

                .agreement-units {
                    background-color: #B22222;
                    color: #fff;
                }

                .block-container {
                    border: 1px solid #ccc;
                    padding: 20px;
                    border-radius: 5px;
                }

                .block-layout {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 10px;
                }

                .floor {
                    grid-column: span 4;
                    background-color: #40E0D0;
                    padding: 10px;
                    text-align: center;
                    border: 1px solid #000;
                    font-weight: bold;
                }

                .unit {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 10px;
                    border: 1px solid #000;
                    font-weight: bold;
                }

                .unit.enquired {
                    background-color: #32CD32;
                    color: #fff;
                }

                .unit.agreement {
                    background-color: #B22222;
                  
                    color: #fff;
                } */
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('/public/assets/back-end/img/floors.png') }}" alt="">
                {{ __('property_master.add_new_floor') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('floor.floor_multiple_store') }}" method="post">
                            @csrf
                            <div class="container mt-3">
                                <div class="p-2 bg-primary text-white custom-shadow rounded">
                                    <div class="bg-success-subtle p-2 rounded">
                                        <span class="fw-bold">{{ __('property_master.floor_no_prefill_with_zero') }}
                                            :</span>
                                        <span class="text-danger">{{ __('general.' . $fill_zero) }} ####</span>
                                        <span class="fw-bold ms-3">{{ __('property_master.no_of_digits_width') }} :</span>
                                        <span class="text-danger">{{ $width }} ####</span>
                                        <span class="fw-bold ms-3">{{ __('property_master.start_floor_no') }} :</span>
                                        <span>{{ $start_floor_no }} ####</span>
                                        <span class="fw-bold ms-3">{{ __('property_master.floor_code_prefix') }} :</span>
                                        <span class="text-danger">{{ $floor_code_prefix }} ####</span>
                                        <span class="fw-bold ms-3">{{ __('general.status') }}</span>
                                        <span class="text-success">{{ __('general.' . $status) }}</span>
                                    </div>
                                </div>

                                <input type="hidden" name="fill_zero" value="{{ $fill_zero }}">
                                <input type="hidden" name="start_floor_no" value="{{ $start_floor_no }}">
                                <input type="hidden" name="floor_code_prefix" value="{{ $floor_code_prefix }}">
                                <input type="hidden" name="no_of_floors" value="{{ $no_of_floors }}">
                                <input type="hidden" name="width" value="{{ $width }}">
                                <input type="hidden" name="floor_code_prefix_status"
                                    value="{{ $floor_code_prefix_status }}">
                                {{-- <input type="hidden" name="floor_code_prefix" value="{{ $floor_code_prefix }}"> --}}
                                <input type="hidden" name="status" value="{{ $status }}">
                                <div class="p-3 bg-primary text-white custom-shadow rounded mt-4">
                                    <label class="fw-bold mb-2">{{ __('property_master.name') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        {{-- @if (isset($width))
                                            @for ($i = 0, $ii = $width; $i < $ii; $i++)
                                                <div class="col-md-4">
                                                    <input type="text" name="floors[]" class="form-control"
                                                        value="{{ (isset($floor_code_prefix) ? $floor_code_prefix : '') . (isset($width) ? str_pad('', $width - 1, '0') : '') . $i + $start_floor_no }}">
                                                </div>
                                            @endfor
                                        @elseif(isset($no_of_floors)) --}}
                                            @for ($i = 0, $ii = $no_of_floors; $i < $ii; $i++)
                                                <div class="col-md-4">
                                                    <input type="text" name="floors[]" class="form-control"
                                                        value="{{ (isset($floor_code_prefix) ? $floor_code_prefix : '') . (isset($width) ? str_pad('', $width - 1, '0') : '') . $i + $start_floor_no }}">
                                                </div>
                                            @endfor
                                        {{-- @endif --}}
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex gap-3 justify-content-end mt-3">
                                <button type="reset" id="reset"
                                    class="btn btn-secondary px-4">{{ __('general.reset') }}</button>
                                <button type="submit" class="btn btn--primary px-4">{{ __('general.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="legend">
        <span class="legend-item floors">Floors</span>
        <span class="legend-item empty-units">Empty Units</span>
        <span class="legend-item enquired-units">Enquired Units</span>
        <span class="legend-item proposed-units">Proposed Units</span>
        <span class="legend-item booked-units">Booked Units</span>
        <span class="legend-item agreement-units">Agreement Units</span>
    </div>

    <div class="block-container">
        <h2>Block: Block A</h2>
        <div class="block-layout">
            <div class="floor">Ground Floor</div>
            <div class="unit enquired">STORE001</div>
            <div class="unit agreement">STORE002</div>
            <div class="unit enquired">STORE003</div>
            <div class="unit enquired">STORE004</div>

            <div class="floor">FLR004</div>
            <div class="floor">FLR003</div>
            <div class="floor">FLR002</div>
            <div class="floor">FLR001</div>
            <div class="unit agreement">STORE005</div>
        </div>
    </div> --}}
@endsection
