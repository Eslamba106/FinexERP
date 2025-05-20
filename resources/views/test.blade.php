@extends('layouts.back-end.app')

@section('title', __('facility_transactions.complaint_registration_list'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-subscription-list.png') }}" alt=""> --}}
                {{ __('facility_transactions.complaint_registration_list') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $complaints->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->


        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ __('general.search_by_name') }}" aria-label="Search orders"
                                            value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit" class="btn btn--primary">{{ __('general.search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>


                        </div>
                    </div>

                </div>

                    @php
                        $rent_mode_months = [1 => 'Daily' , 2 => 'Monthly' , 3 => 'Bi-Monthly' , 4 => 'Quartarly' , 5 => 'Half-Yearly'  , 6 => 'Yearly']
                    @endphp
                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                        {{ __('general.sl') }}</th>
                                        <th>Complaint No.</th>
                                        <th>Tenant Name</th>
                                        <th>Mobil Number</th>
                                        <th>Unit Details</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Created At Time</th>
                                        <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($complaints as $complaint)
                                <tr>
                                    <td>
                                        <label>
                                            <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                value="{{ $complaint->id }}" />
                                            <span class="text-muted">#{{ $complaint->id }}</span>
                                        </label>
                                    </td>                                <td>
                                    {{ $complaint->complaint_no }}
                                </td>
                                <td>
                                    {{ $complaint->tenant->name }}
                                </td>
                                <td>
                                    {{ $complaint->phone_number ?? $complaint->tenant->ContactNumber }}
                                </td>
                                <td>
                                    {{-- {{ $complaint->unit_management->unit_management_main->name }} --}}
                                    {{-- {{ $complaint->property->code . '-' . $complaint->block->block->code . '-'
                                    . $complaint->floor->FloorCode .
                                    '-' . $complaint->unit->UnitCode }} --}}
                                </td>

                                <td>
                                    @if($complaint->status == 'open') <span class="@if($complaint->notification_sent != 1) text-green @else text-red @endif " >{{ $complaint->status }}</span> @endif
                                    @if($complaint->status == 'freezed') <span class="text-gray" >{{ $complaint->status }}</span> @endif
                                    @if($complaint->status == 'closed') <span class="text-primary" >{{ $complaint->status }}</span> @endif
                                </td>

                                <td>{{ $complaint->created_at->format('Y-m-d') }}</td>
                                <td>{{ $complaint->created_at->format('h:i A') }}</td>
                                <td>

                                    <a href="{{ route('complaint_registration.showComplaint', $complaint->id) }}"
                                        class="btn btn-outline-info btn-sm" title="@lang('Show')">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('complaint_registration.editComplaint', $complaint->id) }}"
                                        class="btn btn-outline-secondary btn-sm" title="@lang('Edit')">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" value="{{ $complaint->id }}"
                                        class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                        data-delete_item="{{ $complaint->id }}"
                                        data-target="#delete_freezing"><i class="fa fa-trash"></i></a>




                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $complaints->links() }}
                        </div>
                    </div>

                    @if (count($complaints) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        flatpickr("#invoice_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.subscription_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('agreement.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ __('general.updated_successfully') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ __('Status_updated_failed.') }} {{ __('Product_must_be_approved') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ __('general.are_you_sure_delete_this') }}",
                text: "{{ __('general.you_will_not_be_able_to_revert_this') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('general.yes_delete_it') }}!",
                cancelButtonText: "{{ __('general.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('agreement.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success("{{ __('general.deleted_successfully') }}");
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
@extends('layouts.back-end.app')

@section('title', __('roles.all_enquiries'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-subscription-list.png') }}" alt="">
                {{ __('roles.all_enquiries') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $enquiries->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->


        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ __('general.search_by_name') }}" aria-label="Search orders"
                                            value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit" class="btn btn--primary">{{ __('general.search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">

                                {{-- @can('create_enquiry') --}}
                                <a href="{{ route('enquiry.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ __('roles.create_enquiry') }}</span>
                                </a>
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                        {{ __('general.sl') }}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Unit Details</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Created At Time</th>
                                        <th>Actions</th>
                                    <th class="text-center">Complaint No.</th>
                                    <th class="text-center">Tenant Name</th>
                                    <th class="text-center">Mobil Numberko</th>
                                    <th class="text-center">{{ __('property_transactions.tenant_type') }}</th>
                                    <th class="text-center">{{ __('property_transactions.booking_status') }}</th>
                                    <th class="text-center">{{ __('roles.status') }}</th>
                                    <th class="text-center">{{ __('roles.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enquiries as $k => $enquiry_item)
                                    <tr>
                                        <th scope="row"><input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                value="{{ $enquiry_item->id }}" />
                                            {{ $enquiries->firstItem() + $k }}</th>

                                        <td class="text-center">
                                            {{ $enquiry_item->enquiry_no ?? __('general.not_available') }}
                                        </td>

                                        <td class="text-center">
                                            @php
                                                $formatted_date = date(
                                                    'j S M Y',
                                                    strtotime($enquiry_item->enquiry_date),
                                                );
                                            @endphp
                                            {{ $formatted_date ?? __('general.not_available') }}
                                        </td>

                                        <td class="text-center">
                                            {{ $enquiry_item->tenant->type == 'individual' ? $enquiry_item->name ?? __('general.not_available') : $enquiry_item->company_name ?? __('general.not_available') }}
                                        </td>
                                        <td class="text-center">
                                            {{ ucfirst($enquiry_item->tenant->type) ?? __('general.not_available') }}
                                        </td>


                                        <td class="text-center">
                                            <span  >
                                                {{ ucfirst($enquiry_item->booking_status) ?? __('general.not_available') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="{{
                                                strtolower($enquiry_item->enquiry_details->enquiry_request_status->name) == 'pending'
                                                    ? 'bg-warning text-dark border border-warning rounded'
                                                    : (strtolower($enquiry_item->enquiry_details->enquiry_request_status->name) == 'completed'
                                                        ? 'bg-success text-white border border-success rounded'
                                                        : (strtolower($enquiry_item->enquiry_details->enquiry_request_status->name) == 'canceled'
                                                            ? 'bg-danger text-white border border-danger rounded'
                                                            : '')) }}">
                                                {{ ucfirst($enquiry_item->enquiry_details->enquiry_request_status->name) ?? __('general.not_available') }}
                                            </span>
                                        </td>



                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- <a class="btn btn-outline-info btn-sm square-btn" title="{{ __('barcode') }}"
                                            href="{{ route('enquiry.barcode', [$subscription['id']]) }}">
                                            <i class="tio-barcode"></i>
                                        </a> --}}
                                                {{-- <a class="btn btn-outline-info btn-sm square-btn" title="View"
                                                    href="{{ route('enquiry.show', [$subscription->id]) }}">
                                                    <i class="tio-invisible"></i>
                                                </a> --}}
                                                @if($enquiry_item->booking_status == 'enquiry')
                                                <a class="btn btn-outline--primary "
                                                    href="{{ route('enquiry.add_to_proposal', [$enquiry_item->id]) }}">
                                                    Proposal
                                                </a>
                                                @endif
                                                {{-- @can('edit_enquiry') --}}
                                                <a class="btn btn-outline--primary btn-sm square-btn"
                                                    title="{{ __('edit') }}"
                                                    href="{{ route('enquiry.edit', [$enquiry_item->id]) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                {{-- @endcan
                                                @can('delete_enquiry') --}}
                                                <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                    title="{{ __('general.delete') }}" id="{{ $enquiry_item->id }}">
                                                    <i class="tio-delete"></i>
                                                </a>
                                                {{-- @endcan --}}

                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $enquiries->links() }}
                        </div>
                    </div>

                    @if (count($enquiries) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.subscription_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('enquiry.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ __('general.updated_successfully') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ __('Status_updated_failed.') }} {{ __('Product_must_be_approved') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ __('general.are_you_sure_delete_this') }}",
                text: "{{ __('general.you_will_not_be_able_to_revert_this') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('general.yes_delete_it') }}!",
                cancelButtonText: "{{ __('general.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('enquiry.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success("{{ __('general.deleted_successfully') }}");
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
