@extends('frontend.layouts.login')

@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel" style="background: url(images/Hospital.jpg);background-size: cover;background-position: center center;">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-3 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="images/logo.png">
                </div>
                <h6 class="font-weight-light">Sign in to start your session</h6>

                {{ Form::open(['route' => 'frontend.auth.login', 'class' => 'form-horizontal']) }}

                <div class="form-group">
                    <div class="form-group">
                    <label for="emailid">Email Id</label>
                        <input type="text" name="email" placeholder="" id="email" class="form-control" required="required">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="" id="password" class="form-control" required="required"> 
                    </div>                  
                </div>

                <div class="mt-3">
                        {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn']) }}
                </div>

                {{ Form::close() }}


                {{-- <form action="#" method="post" accept-charset="utf-8">
                  <div class="form-group">
                    <div class="form-group">
                    <label for="password">Username</label><input type="text" name="username" placeholder="" id="username" class="form-control"></div>
                    </div>
                  <div class="form-group">
                  <div class="form-group"><label for="password">Password</label><input type="password" name="password" placeholder="" id="password" class="form-control">
</div>                  
<div class="form-group"><label for="password">Select Department</label><select class="form-control">
    <option></option>
    <option>Eye</option>
    <option>Dentist </option>
</select>
</div></div>
                  <div class="mt-3">
                  <a href="add_new.html" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a>
                  </div>
                  
                  </form> --}}
                 
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>

{{-- @include('frontend.jewel.menu') --}}

{{-- <main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center form-block">
            <div class="col-lg-5">
                <h1 class="mb-3">Sign in</h1>
                <div class="details-des">


                   

                </div>
               

            </div>
            <div class="col-lg-1 h-100 d-flex align-items-center pd-sap">
                <div class="product-detail-box"></div></div>
            <div class="col-lg-6 pt-5 pt-lg-0">
                <img src="images/logo.png" alt="">
                <h1 class="mt-4 mb-3">Sign up</h1>
                <div class="details-des">
                    
                    {{ Form::open(['route' => 'frontend.auth.register', 'class' => 'form-horizontal']) }}

                    <div class="form-group">
                        <div class="col-md-6">
                            {{ Form::input('name', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-6">
                            {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-6">
                            {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-6">
                            {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    @if (config('access.captcha.registration'))
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::captcha() !!}
                                {{ Form::hidden('captcha_status', 'true') }}
                            </div><!--col-md-6-->
                        </div><!--form-group-->
                    @endif

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit('Sign up', ['class' => 'btn-form']) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</main> --}}


{{-- @include('frontend.jewel.footer') --}}

@endsection

@section('footer-js')

<script type="text/javascript">


</script>

@endsection