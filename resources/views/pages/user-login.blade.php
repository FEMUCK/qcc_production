{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Login')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/animate-css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/login.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="login-page" class="row">
    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
        <form class="login-form" id="login-form" method="post" action="{{route('login-process')}}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <h5 class="ml-4">EGAT QCC Sign in</h5>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">person_outline</i>
                    <input id="username" name="username" type="text" required>
                    <label for="username" class="center-align">Username</label>
                </div>
            </div>
            <div class="row margin">
                    <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">lock_outline</i>
                    <input id="password" name="password" type="password" required>
                    <label for="password">Password</label>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col s12 m12 l12 ml-2 mt-1">
                <p>
                    <label>
                    <input type="checkbox" />
                    <span>Remember Me</span>
                    </label>
                </p>
                </div>
            </div> --}}

            <div class="row">
                <div class="input-field col s12">
                    {{-- <a href="{{asset('/')}}" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</a> --}}
                    <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" id="btn_login">Login</button>
                </div>
            </div>
            {{-- <div class="row">
                <div class="input-field col s6 m6 l6">
                <p class="margin medium-small"><a href="{{asset('user-register')}}">Register Now!</a></p>
                </div>
                <div class="input-field col s6 m6 l6">
                <p class="margin right-align medium-small"><a href="{{asset('user-forgot-password')}}">Forgot password ?</a>
                </p>
                </div>
            </div> --}}
        </form>
    </div>
</div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
<script src="{{asset('vendors/igorescobar/jquery-mask-plugin/dist/jquery.mask.js')}}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/extra-components-sweetalert.js')}}"></script>

<script>
    $('#login-page').addClass('animated fadeInDown');

    // START Form Mask to format user input to match a specified pattern.
    $('#username').mask('000000');
    // END Form Mask to format user input to match a specified pattern.

    // START Form Validation 'login-form'
    $("#btn_login").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        var usernamelenght = $('#username').val().length;

        var msg = "";
        var cnt = 0;

        if (username == '') {
            cnt = cnt + 1;
            msg = msg+"\n"+cnt+". กรุณาระบุรหัสพนักงาน"
        }

        if (usernamelenght != '' && usernamelenght < 6) {
            cnt = cnt + 1;
            msg = msg+"\n"+cnt+". กรุณาระบุรหัสพนักงานให้ถูกต้อง"
        }

        if (password == '') {
            cnt = cnt + 1;
            msg = msg+"\n"+cnt+". กรุณาระบุรหัสผ่าน"
        }

        if(cnt > 0){
        swal({
            title: "Warning!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
        });
            return false;
        }else{
            return true;
        }
    });
    // END Form Validation 'login-form'
</script>
@endsection


