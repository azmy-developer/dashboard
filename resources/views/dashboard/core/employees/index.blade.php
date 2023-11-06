@extends('dashboard.layout.layout')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Employees</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{route('dashboard.home')}}">{{__('dash.home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Employees</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="m-4 text-end">
                    <a href="{{route('dashboard.employee.create')}}" class="btn btn-primary">{{__('dash.add_new')}}</a>
                </div>

                <div class="card-body">

                    <table class="table table-bordered dt-responsive  nowrap w-100" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('dash.image')}}</th>
                            <th>{{__('dash.name')}}</th>
                            <th>{{__('dash.email')}}</th>
                            <th>salary</th>
                            <th>{{__('dash.status')}}</th>
                            <th class="no-content">{{__('dash.actions')}}</th>
                        </tr>
                        </thead>

                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- container-fluid -->
@endsection

@push('script')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                order: [[0, 'desc']],
                "language": {
                    "url": "{{app()->getLocale() == 'ar'? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                },
                buttons: {
                    buttons: [
                        {extend: 'copy', className: 'btn btn-sm'},
                        {extend: 'csv', className: 'btn btn-sm'},
                        {extend: 'excel', className: 'btn btn-sm'},
                        {extend: 'print', className: 'btn btn-sm'}
                    ]
                },
                charset: 'UTF-8',
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard.employee.index') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'salary', name: 'salary'},
                    {data: 'status', name: 'status'},
                    {data: 'controll', name: 'controll', orderable: false, searchable: false},

                ]
            });
        });

        $("body").on('change', '#switch3', function () {
            let active = $(this).is(':checked');
            let id = $(this).attr('data-id');

            $.ajax({
                url: '{{route('dashboard.employee.change_status')}}',
                type: 'get',
                data: {id: id, active: active},
                success: function (data) {
                    swal.fire({
                        title: "{{__('dash.successful_operation')}}",
                        text: "{{__('dash.request_executed_successfully')}}",
                        type: 'success',
                        padding: '2em'
                    })
                }
            });
        })


    </script>

@endpush
