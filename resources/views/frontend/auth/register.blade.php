@extends('frontend.layouts.app')

@section('content')
<body class="home-bg">

@include('frontend.jewel.menu')

<main role="main" id="main-container">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center form-block">
            <div class="col-lg-5">
                <h1 class="mb-3">Sign in</h1>
                <div class="details-des">


                     {{ Form::open(['route' => 'frontend.auth.register', 'class' => 'form-horizontal']) }}

                    <div class="form-group">
                        {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('name', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'col-md-4 control-label']) }}
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
                            {{ Form::submit(trans('labels.frontend.auth.register_button'), ['class' => 'btn btn-primary']) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{ Form::close() }}

                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 mb-4">
                        <input type="text" placeholder="Eamil Address" class="form-control">
                    </div>
                    <div class="col-lg-12 mb-4">
                        <input type="text" placeholder="Password" class="form-control">
                    </div>
                    <div class="col-lg-12 mb-4 mt-4"><a href="#" class="btn-form">Log in</a> </div>
                    <div class="col-lg-12 mb-4 mt-2"><a href="#" class="forgot">Forgot Password?</a> </div>
                </div>

            </div>
            <div class="col-lg-1 h-100 d-flex align-items-center pd-sap">
                <div class="product-detail-box"></div></div>
            <div class="col-lg-6 pt-5 pt-lg-0">
                <img src="images/logo.png" alt="">
                <h1 class="mt-4 mb-3">Sign up</h1>
                <div class="details-des">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                <div class="row mt-4">
                    <div class="col col-auto my-2"><a href="#" class="btn-form">Sign up</a> </div>
                </div>
            </div>
        </div>
    </div>
</main>


@include('frontend.jewel.footer')

@endsection

@section('footer-js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"><\/script>')</script>

<script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/slick.min.js')}}"></script>

<script type="text/javascript">

    var slick = jQuery('.stack').slick(
        {
            centerPadding: '50px',
            centerMode: true,
            infinite: true,
            arrows: true,
            draggable: false,
            touchMove: true,
            variableWidth: true,
            dots: false,
            //swipeToSlide: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            focusOnSelect: true,
            mobileFirst: true
        });

</script>

@endsection