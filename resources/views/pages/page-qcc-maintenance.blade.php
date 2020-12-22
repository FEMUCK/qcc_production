@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Maintenance Page')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-maintenance.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section p-0 m-0 height-100vh section-maintenance">
    <div class="row">
        <!-- Maintenance -->
        <div id="maintenance" class="col s12 center-align white">
        <img src="{{asset('images/gallery/maintenance.png')}}" class="responsive-img maintenance-img" alt="">
        <h4 class="error-code">This site is under maintenance</h4>
        <h6 class="mb-2 mt-2">We are sorry for the inconvenience. <br> We will be back up and running as fast as possible <br> Please check back later.</h6>
        <a class="btn waves-effect waves-light" href="{{ route('user-login') }}" id="btn_back_to_login">Back TO Login</a>
        </div>
    </div>
</div>
@endsection
