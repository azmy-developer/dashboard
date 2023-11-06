@extends('dashboard.layout.layout')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Department</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{route('dashboard.home')}}">{{__('dash.home')}}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route('dashboard.department.index')}}">Department</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('dash.create')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <form  method="post"
                           action="{{route('dashboard.department.store')}}"
                           enctype="multipart/form-data">
                        @csrf

                        <div class="form-row row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('dash.title')}}</label>
                                <input type="text" name="title" class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.title')}}"
                                       >
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group col-md-6">
                            <button type="submit"
                                    class="btn btn-primary col-md-3">{{__('dash.submit')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

