@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', __('property_master.' . $route))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img width="60" src="{{ asset('/public/assets/back-end/img/' . $route . '.jpg') }}" alt="">
                {{ __('property_master.' . $route) }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('property_master.edit_' . $route) }}
                    </div>
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route($route . '.update', $main->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <input type="hidden" id="id">
                                <label class="title-color" for="name">{{ __('property_master.name') }}<span
                                        class="text-danger">*</span> </label>
                                <input type="text" name="name" class="form-control" value="{{ $main->name }}"
                                    placeholder="{{ __('property_master.enter_' . $route . '_name') }}">
                            </div>
                            @if ($code_status == 'yes')
                                <div class="form-group">
                                    <label class="title-color" for="code">
                                        {{ __('property_master.code') }}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="code" class="form-control"
                                            value="{{ $main->code }}"
                                            placeholder="{{ __('property_master.enter_' . $route . '_code') }}">

                                    </div>
                                </div>
                            @endif
                            @if ($description == 'yes')
                                <div class="form-group">
                                    <label class="title-color" for="description">
                                        {{ __('property_master.description') }}
                                    </label>
                                    <div class="input-group">
                                        <textarea name="description" class="form-control" cols="30" rows="3">{{ $main->description }}</textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="title-color" for="status">
                                    {{ __('general.status') }}
                                </label>
                                <div class="input-group">
                                    <input type="radio" name="status" class="mr-3 ml-3"
                                        @if ($main->status == 'active') checked @endif value="active">
                                    <label class="title-color" for="status">
                                        {{ __('general.active') }}
                                    </label>
                                    <input type="radio" name="status" class="mr-3 ml-3"
                                        @if ($main->status == 'inactive') checked @endif value="inactive">
                                    <label class="title-color" for="status">
                                        {{ __('general.inactive') }}
                                    </label>

                                </div>
                            </div>



                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ __('general.reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ __('general.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    {{-- <input type="hidden" id="route_name" name="route_name" value="{{ $route }}" > --}}
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            // var route_name = document.getElementById('route_name').value;
            Swal.fire({
                title: "{{ __('general.are_you_sure_delete_this') }}",
                text: "{{ __('general.you_will_not_be_able_to_revert_this') }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('general.yes_delete_it') }}!',
                cancelButtonText: '{{ __('general.cancel') }}',
                type: 'warning',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route($route . '.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ __('department.deleted_successfully') }}');
                            location.reload();
                        }
                    });
                }
            })
        });



        // Call the dataTables jQuery plugin
    </script>
@endpush
