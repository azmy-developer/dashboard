@php
    $name = 'site_name_'.app()->getLocale();
    $msgs = [];
    if (session('errors')){
        foreach(session('errors')->getmessages() as $message){
            foreach ($message as $m){
              $msgs[] = $m;
            }
        }
    }

@endphp
    <!doctype html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' :'ltr'}}">

<head>

    <meta charset="utf-8"/>
    <title>site name</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->

        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    @if(app()->getLocale() == 'ar')
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    @else
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    @endif

        <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/libs/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .custom-file-container__image-preview{
            width: 55px!important;
        }
    </style>

</head>

<body data-sidebar="dark" data-layout-mode="light">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


    @include('dashboard.layout.navbar')


    <!-- ========== Left Sidebar Start ========== -->
    @include('dashboard.layout.sidebar')
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div id="layout-wrapper">

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('content')


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script>
                            © Skote.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>
</div>
<!-- END layout-wrapper -->


<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>


<script src="{{asset('/assets/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{asset('assets/libs/file-upload/file-upload-with-preview.min.js')}}"></script>




<!-- App js -->
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function () {

        let session = "{{session('success')}}"
        if (session) {
            swal.fire({
                title: "{{__('dash.successful_operation')}}",
                text: "{{__('dash.request_executed_successfully')}}",
                type: 'success',
                padding: '2em'
            })
        }
        let arr = [];
        <?php foreach ($msgs as $key => $val){ ?>
        arr.push('<?php echo $val; ?>');
        <?php } ?>
        if (arr[0]) {
            let text = '';
            for (let i = 0; i < arr.length; i++) {
                text += arr[i]
            }
            swal.fire({
                title: "{{__('dash.error')}}",
                html: text,
                type: 'error',
                padding: '2em'
            })
        }
    })
    $(document).on('click', '.btn-delete', function () {
        let id = $(this).data('id');
        let url = $(this).data('href')
        let that = $(this);
        swal.fire({
            title: "{{__('dash.Are_you_sure?')}}",
            text: "{{__("dash.You_won't_be_able_to_restore_it_again")}}",
            showCancelButton: true,
            confirmButtonText: "{{__('dash.Yes,delete')}}",
            cancelButtonText: "{{__('dash.No,cancel')}}"
        }).then((isConfirm) => {
            if (isConfirm.value) {
                $.post(url, {_method: 'DELETE', _token: '{{csrf_token()}}'}).done(function (response) {
                    if (response.success === true) {
                        swal.fire(
                            "{{__('dash.Deleted!')}}",
                            "{{__('dash.Your_file_has_been_deleted.')}}",
                            'success'
                        )
                        $('.table').DataTable().ajax.reload();
                    } else {
                        swal.fire(
                            "فشل الحذف",
                            "" + response.msg + "",
                            'error'
                        )
                    }
                })
            }
        });
    });

    $(".select2").select2(
        {
            tags: true,
            dir: '{{app()->getLocale() == "ar"? "rtl" : "ltr"}}'
        }
    );

</script>

@stack('script')

</body>

</html>
