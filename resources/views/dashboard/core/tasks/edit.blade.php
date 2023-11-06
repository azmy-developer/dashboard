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
                        <li class="breadcrumb-item"><a
                                href="{{route('dashboard.core.employee.index')}}">Employee</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('dash.edit')}}</li>
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
                           action="{{route('dashboard.core.task.update',$model->id)}}"
                           enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        <div class="form-row row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('dash.title')}}</label>
                                <input type="text" name="title" class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.title')}}"
                                       value="{{$model->title}}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">

                                <label for="inputEmail4">Empolyee</label>
                                <select id="inputState" class="select2 form-control"
                                        data-placeholder="Choose ..."
                                        name="employee_id">
                                    <option disabled>{{__('dash.choose')}}</option>
                                    @foreach($employees as $employee)
                                        <option
                                            {{$employee->id == $model->employee_id ? 'selected' : ''}} value="{{$employee->id}}">{{$employee->first_name}}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
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

