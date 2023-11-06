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
                                href="{{route('dashboard.employee.index')}}">Employees</a>
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
                           action="{{route('dashboard.employee.store')}}"
                           enctype="multipart/form-data">
                        @csrf

                        <div class="form-row row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('dash.first name')}}</label>
                                <input type="text" name="first_name" class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.first name')}}"
                                       >
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('dash.last name')}}</label>
                                <input type="text" name="last_name" class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.last name')}}"
                                       >
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="form-row row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('dash.phone')}}</label>
                                <input type="text" name="phone" class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.phone')}}"
                                       >
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('dash.email')}}</label>
                                <input type="email" name="email" class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.email')}}"
                                       >
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-row row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('dash.password')}}</label>
                                <input type="password" name="password" class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.password')}}"
                                >
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    for="inputEmail4">{{__('dash.password_confirmation')}}</label>
                                <input type="password" name="password_confirmation"
                                       class="form-control"
                                       id="inputEmail4"
                                       placeholder="{{__('dash.password_confirmation')}}"
                                >
                                @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row row mb-3">

                            <div class="form-group col-md-6">

                                <label for="inputEmail4">Department</label>
                                <select id="inputState" class="select2 form-control"
                                        data-placeholder="Choose ..."
                                        name="department_id">
                                    <option disabled>{{__('dash.choose')}}</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->title}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group col-md-6">

                                <label for="inputEmail4">salary</label>
                                <input type="number" name="salary" class="form-control"
                                       id="inputEmail4"
                                       placeholder="salary"
                                >
                                @error('salary')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="form-row row mb-3">

                            <div class="form-group col-md-6">

                                <label for="inputEmail4">{{__('dash.roles')}}</label>
                                <select id="inputState" class="select2 form-control"
                                        data-placeholder="Choose ..."
                                        name="role">
                                    <option disabled>{{__('dash.choose')}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-6 custom-file-container form-group"
                                 data-upload-id="mySecondImage">
                                <label>{{__('dash.upload')}}<a href="javascript:void(0)"
                                                               class="custom-file-container__image-clear"
                                                               title="Clear Image">x</a></label>
                                <div style="display: flex">
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                               class="custom-file-container__custom-file__custom-file-input"
                                               name="avatar"
                                        >
                                        {{--<input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>--}}
                                        <span
                                            class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>

                                    <div class=" col-md-2 custom-file-container__image-preview"></div>
                                </div>
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

@push('script')
    <script>
        let secondUpload = new FileUploadWithPreview('mySecondImage')
    </script>
@endpush
