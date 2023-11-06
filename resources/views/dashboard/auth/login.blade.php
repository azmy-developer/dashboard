@extends('dashboard.layout.guest')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">{{__('dash.Welcome Back !')}}</h5>
                                <p>{{__('dash.Sign in to continue to dashboard')}}</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">

                                <img src="{{asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">

                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="auth-logo">

                            <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                    <img src="{{asset('assets/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                                            </span>
                            </div>


                    </div>
                    <div class="p-2">
                        <form class="form-horizontal" method="post" action="{{route('dashboard.login')}}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{__('dash.email')}}</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{__('dash.password')}}</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                            </div>


                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">{{__('dash.login')}}</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
