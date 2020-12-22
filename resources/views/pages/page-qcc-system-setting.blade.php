{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','System Setting')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('fonts/fontawesome/css/all.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page content --}}
@section('content')

<?php
    // ประกาศตัวแปรไว้ก่อนใช้งานด้านบนนี้เลย สำหรับ checkbox module ต่างๆ ด้านล่าง พร้อมกับใช้ foreach จากด้านบนเลย (ไม่ต้องไปประกาศแทรกใน HTML)
    $announcement_module = '';
    $create_module = '';
    $edit_module = '';
    $delete_module = '';
    $presentation_round_module = '';
    $prize_results_module = '';

    $site_maintenance_module = '';

    foreach($data as $value){
        if(isset($data['systemsettingdata'])){
            $systemsettingdata = $data['systemsettingdata'];

            foreach($systemsettingdata as $systemsettingdata_item){
                $paramno = $systemsettingdata_item->paramno;
                $paramtype = $systemsettingdata_item->paramtype;
                $paramval = $systemsettingdata_item->paramval;

                if($paramno == 'S012' && $paramtype == 'ANNOUNCEMENT' && $paramval == 'Enable'){
                    $announcement_module = 'checked';
                }elseif($paramno == 'S012' && $paramtype == 'ADD' && $paramval == 'Enable'){
                    $create_module = 'checked';
                }elseif($paramno == 'S012' && $paramtype == 'EDIT' && $paramval == 'Enable'){
                    $edit_module = 'checked';
                }elseif($paramno == 'S012' && $paramtype == 'REMOVE' && $paramval == 'Enable'){
                    $delete_module = 'checked';
                }elseif($paramno == 'S012' && $paramtype == 'PRESENT' && $paramval == 'Enable'){
                    $presentation_round_module = 'checked';
                }elseif($paramno == 'S012' && $paramtype == 'PRIZE' && $paramval == 'Enable'){
                    $prize_results_module = 'checked';
                }elseif($paramno == 'S012' && $paramtype == 'MAINTENANCE' && $paramval == 'Enable'){
                    $site_maintenance_module = 'checked';
                }else{}
            }
            // echo $systemsettingdata;

            // สำหรับแสดงค่า SYSYEAR จาก Database
            if(isset($data['qccsystemyear'])){
                $qccsystemyear = $data['qccsystemyear'];
            }
            // สำหรับแสดงค่า SYS STRT DATE จาก Database
            if(isset($data['qccsystemstrtdate'])){
                $qccsystemstrtdate = $data['qccsystemstrtdate'];
            }
            // สำหรับแสดงค่า SYS END DATE จาก Database
            if(isset($data['qccsystemenddate'])){
                $qccsystemenddate = $data['qccsystemenddate'];
            }

        }
    }
?>

<!--Gradient Card-->
<div id="cards-extended">
    <div class="card">
        <div class="card-content">
            <h4 class="card-title">Enable or disable modules</h4>
            <p style="color:rgb(255, 153, 0)">
                CAUTION : This action might impact other users.
            </p>
            <div class="row">
                <div class="col s12 m3">
                    @if($announcement_module == 'checked')
                        <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3" id="announcement_module_div">
                    @else
                        <div class="card gradient-shadow gradient-45deg-blue-grey-blue-grey border-radius-3" id="announcement_module_div">
                    @endif
                        <div class="card-content center">
                            <img src="{{asset('images/icon/pr.svg')}}" alt="images" class="width-40" />
                            @if($announcement_module == 'checked')
                                <h5 class="white-text lighten-4" id="announcement_module_h5">Active</h5>
                            @else
                                <h5 class="white-text lighten-4" id="announcement_module_h5">Inactive</h5>
                            @endif
                            <p class="white-text lighten-4">Announcement Module</p>
                            <div class="switch">
                                <label style="color:white">
                                    Off
                                    <input type="checkbox" id="announcement_module" name="announcement_module" {{ $announcement_module }}>
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3">
                    @if($create_module == 'checked')
                        <div class="card gradient-shadow gradient-45deg-green-teal border-radius-3" id="create_module_div">
                    @else
                        <div class="card gradient-shadow gradient-45deg-blue-grey-blue-grey border-radius-3" id="create_module_div">
                    @endif
                        <div class="card-content center">
                            <img src="{{asset('images/icon/add.svg')}}" alt="images" class="width-40" />
                            @if($create_module == 'checked')
                                <h5 class="white-text lighten-4" id="create_module_h5">Active</h5>
                            @else
                                <h5 class="white-text lighten-4" id="create_module_h5">Inactive</h5>
                            @endif
                            <p class="white-text lighten-4">Create Module</p>
                            <div class="switch">
                                <label style="color:white">
                                    Off
                                    <input type="checkbox" id="create_module" name="create_module" {{ $create_module }}>
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3">
                    @if($edit_module == 'checked')
                        <div class="card gradient-shadow gradient-45deg-amber-amber border-radius-3" id="edit_module_div">
                    @else
                        <div class="card gradient-shadow gradient-45deg-blue-grey-blue-grey border-radius-3" id="edit_module_div">
                    @endif
                        <div class="card-content center">
                            <img src="{{asset('images/icon/edit.svg')}}" alt="images" class="width-40" />
                            @if($edit_module == 'checked')
                                <h5 class="white-text lighten-4" id="edit_module_h5">Active</h5>
                            @else
                                <h5 class="white-text lighten-4" id="edit_module_h5">Inactive</h5>
                            @endif
                            <p class="white-text lighten-4">Edit Module</p>
                            <div class="switch">
                                <label style="color:white">
                                    Off
                                    <input type="checkbox" id="edit_module" name="edit_module" {{ $edit_module }}>
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3">
                    @if($delete_module == 'checked')
                        <div class="card gradient-shadow gradient-45deg-red-pink border-radius-3" id="delete_module_div">
                    @else
                        <div class="card gradient-shadow gradient-45deg-blue-grey-blue-grey border-radius-3" id="delete_module_div">
                    @endif
                        <div class="card-content center">
                            <img src="{{asset('images/icon/delete.svg')}}" alt="images" class="width-40" />
                            @if($delete_module == 'checked')
                                <h5 class="white-text lighten-4" id="delete_module_h5">Active</h5>
                            @else
                                <h5 class="white-text lighten-4" id="delete_module_h5">Inactive</h5>
                            @endif
                            <p class="white-text lighten-4">Delete Module</p>
                            <div class="switch">
                                <label style="color:white">
                                    Off
                                    <input type="checkbox" id="delete_module" name="delete_module" {{ $delete_module }}>
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m3">
                    @if($presentation_round_module == 'checked')
                        <div class="card gradient-shadow gradient-45deg-blue-indigo border-radius-3" id="presentation_round_module_div">
                    @else
                        <div class="card gradient-shadow gradient-45deg-blue-grey-blue-grey border-radius-3" id="presentation_round_module_div">
                    @endif
                        <div class="card-content center">
                            <img src="{{asset('images/icon/presentation.svg')}}" alt="images" class="width-40" />
                            @if($presentation_round_module == 'checked')
                                <h5 class="white-text lighten-4" id="presentation_round_module_h5">Active</h5>
                            @else
                                <h5 class="white-text lighten-4" id="presentation_round_module_h5">Inactive</h5>
                            @endif
                            <p class="white-text lighten-4">Presentation Round Module</p>
                            <div class="switch">
                                <label style="color:white">
                                    Off
                                    <input type="checkbox" id="presentation_round_module" name="presentation_round_module" {{ $presentation_round_module }}>
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3">
                    @if($prize_results_module == 'checked')
                        <div class="card gradient-shadow gradient-45deg-purple-deep-purple border-radius-3" id="prize_results_module_div">
                    @else
                        <div class="card gradient-shadow gradient-45deg-blue-grey-blue-grey border-radius-3" id="prize_results_module_div">
                    @endif
                        <div class="card-content center">
                            <img src="{{asset('images/icon/prize.svg')}}" alt="images" class="width-40" />
                            @if($prize_results_module == 'checked')
                                <h5 class="white-text lighten-4" id="prize_results_module_h5">Active</h5>
                            @else
                                <h5 class="white-text lighten-4" id="prize_results_module_h5">Inactive</h5>
                            @endif
                            <p class="white-text lighten-4">Prize Results Module</p>
                            <div class="switch">
                                <label style="color:white">
                                    Off
                                    <input type="checkbox" id="prize_results_module" name="prize_results_module" {{ $prize_results_module }}>
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col s12 m3">
                    @if($site_maintenance_module == 'checked')
                        <div class="card gradient-shadow gradient-45deg-brown-brown border-radius-3" id="site_maintenance_module_div">
                    @else
                        <div class="card gradient-shadow gradient-45deg-blue-grey-blue-grey border-radius-3" id="site_maintenance_module_div">
                    @endif
                        <div class="card-content center">
                            <img src="{{asset('images/icon/maintenance.png')}}" alt="images" class="width-40" />
                            @if($site_maintenance_module == 'checked')
                                <h5 class="white-text lighten-4" id="site_maintenance_module_h5">Active</h5>
                            @else
                                <h5 class="white-text lighten-4" id="site_maintenance_module_h5">Inactive</h5>
                            @endif
                            <p class="white-text lighten-4">Site Maintenance Module</p>
                            <div class="switch">
                                <label style="color:white">
                                    Off
                                    @if(session()->get('superadmin_S012') == 'Y')
                                        <input type="checkbox" id="site_maintenance_module" name="site_maintenance_module" {{ $site_maintenance_module }}>
                                    @else
                                        <input type="checkbox" id="site_maintenance_module" name="site_maintenance_module" {{ $site_maintenance_module }} disabled>
                                    @endif
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            </div>
        </div>
    </div>
</div>

<div class="card-panel">
    <p style="color:rgb(255, 153, 0)">
        CAUTION : This action might impact other users.
    </p>
    <div class="row">
        <div class="input-field col s12 m2">
            <i class="mdi mdi mdi-calendar-star prefix"></i>
            <input id="v_sysyear" name="v_sysyear" type="text" data-length="4" class="validate" required value="{{ $qccsystemyear }}">
            <label for="v_sysyear">System Year : <font color="red">*</font></label>
        </div>
        <div class="input-field col s12 m2">
            <i class="mdi mdi-calendar-month-outline prefix"></i>
            <label for="v_sys_startdate">Sys Strt Date : <span class="red-text">*</span></label>
            <input type="text" id="v_sys_startdate" name="v_sys_startdate" class="datepicker" required value="{{ $qccsystemstrtdate }}">
        </div>
        <div class="input-field col s12 m2">
            <i class="mdi mdi-calendar-month-outline prefix"></i>
            <label for="v_sys_enddate">Sys End Date : <span class="red-text">*</span></label>
            <input type="text" id="v_sys_enddate" name="v_sys_enddate" class="datepicker" required value="{{ $qccsystemenddate }}">
        </div>
    </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('fonts/fontawesome/js/all.min.js')}}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('vendors/igorescobar/jquery-mask-plugin/dist/jquery.mask.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/cards-extended.js')}}"></script>
<script src="{{asset('js/scripts/extra-components-sweetalert.js')}}"></script>
<script src="{{asset('js/custom/custom-script.js')}}"></script>
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>

<script>
// START checkbox checked to change div background color & h5 text VIEW : page-qcc-system-setting SOURCE : https://stackoverflow.com/questions/2204250/check-if-checkbox-is-checked-with-jquery
// เรียก Route post (แบบไม่ใช้ Ajax) ด้วย jQuery สำหรับ Enable/Disable Module ใน VIEW : page-qcc-system-setting (S012) SOURCE : https://stackoverflow.com/questions/48181998/laravel-5-5-post-data-to-mysqli-database-via-jquery , https://laravel.io/forum/06-20-2015-save-the-change-of-the-checkbox-state-on-db , https://stackoverflow.com/questions/53909238/minimum-working-example-for-ajax-post-in-laravel-5-7
$('#announcement_module').change(function(){

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updateannouncementmodulestatus') }}";

    if($('#announcement_module:checkbox:checked').length>0) {
        var status = "Enable";
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it on'
            }
        }).then(function (willTurnon) {
            if (willTurnon) {
                $('#announcement_module_div').removeClass('gradient-45deg-blue-grey-blue-grey');
                $('#announcement_module_div').addClass('gradient-45deg-light-blue-cyan');
                $('#announcement_module_h5').text('Active');
                swal("Poof! Your ANNOUNCEMENT module has been turned on!", {
                    icon: "success",
                });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    // Start Jquery Post
                    $.post(url,{'announcement_module': status,'_token':csrf_token}, function (data) {  });
                    // End Jquery Post
                }, 350);
            } else {
                $("#announcement_module").prop("checked", false); // ถ้ากด cancel แล้ว checkbox จะกลับไปอยู่สภาพเดิม SOURCE : https://www.tutorialrepublic.com/faq/how-to-check-or-uncheck-a-checkbox-dynamically-using-jquery.php
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }else {
        var status = 'Disable';
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it off'
            }
        }).then(function (willTurnoff) {
            if (willTurnoff) {
                $('#announcement_module_div').removeClass('gradient-45deg-light-blue-cyan');
                $('#announcement_module_div').addClass('gradient-45deg-blue-grey-blue-grey');
                $('#announcement_module_h5').text('Inactive');
                swal("Poof! Your ANNOUNCEMENT module has been turned off!", {
                    icon: "success",
                });
                    setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                        // Start Jquery Post
                        $.post(url,{'announcement_module': status,'_token':csrf_token}, function (data) {  });
                        // End Jquery Post
                    }, 350);
            } else {
                $("#announcement_module").prop("checked", true);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }

});

$('#create_module').change(function(){

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updatecreatemodulestatus') }}";

    if($('#create_module:checkbox:checked').length>0) {
        var status = "Enable";
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it on'
            }
        }).then(function (willTurnon) {
            if (willTurnon) {
                $('#create_module_div').removeClass('gradient-45deg-blue-grey-blue-grey');
                $('#create_module_div').addClass('gradient-45deg-green-teal');
                $('#create_module_h5').text('Active');
                swal("Poof! Your CREATE module has been turned on!", {
                    icon: "success",
                });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    // Start Jquery Post
                    $.post(url,{'create_module': status,'_token':csrf_token}, function (data) {  });
                    // End Jquery Post
                }, 350);
            } else {
                $("#create_module").prop("checked", false);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }else {
        var status = 'Disable';
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it off'
            }
        }).then(function (willTurnoff) {
            if (willTurnoff) {
                $('#create_module_div').removeClass('gradient-45deg-green-teal');
                $('#create_module_div').addClass('gradient-45deg-blue-grey-blue-grey');
                $('#create_module_h5').text('Inactive');
                swal("Poof! Your CREATE module has been turned off!", {
                    icon: "success",
                });
                    setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                        // Start Jquery Post
                        $.post(url,{'create_module': status,'_token':csrf_token}, function (data) {  });
                        // End Jquery Post
                    }, 350);
            } else {
                $("#create_module").prop("checked", true);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }

});

$('#edit_module').change(function(){

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updateeditmodulestatus') }}";

    if($('#edit_module:checkbox:checked').length>0) {
        var status = "Enable";
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it on'
            }
        }).then(function (willTurnon) {
            if (willTurnon) {
                $('#edit_module_div').removeClass('gradient-45deg-blue-grey-blue-grey');
                $('#edit_module_div').addClass('gradient-45deg-amber-amber');
                $('#edit_module_h5').text('Active');
                swal("Poof! Your EDIT module has been turned on!", {
                    icon: "success",
                });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    // Start Jquery Post
                    $.post(url,{'edit_module': status,'_token':csrf_token}, function (data) {  });
                    // End Jquery Post
                }, 350);
            } else {
                $("#edit_module").prop("checked", false);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }else {
        var status = 'Disable';
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it off'
            }
        }).then(function (willTurnoff) {
            if (willTurnoff) {
                $('#edit_module_div').removeClass('gradient-45deg-amber-amber');
                $('#edit_module_div').addClass('gradient-45deg-blue-grey-blue-grey');
                $('#edit_module_h5').text('Inactive');
                swal("Poof! Your EDIT module has been turned off!", {
                    icon: "success",
                });
                    setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                        // Start Jquery Post
                        $.post(url,{'edit_module': status,'_token':csrf_token}, function (data) {  });
                        // End Jquery Post
                    }, 350);
            } else {
                $("#edit_module").prop("checked", true);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }

});

$('#delete_module').change(function(){

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updatedeletemodulestatus') }}";

    if($('#delete_module:checkbox:checked').length>0) {
        var status = "Enable";
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it on'
            }
        }).then(function (willTurnon) {
            if (willTurnon) {
                $('#delete_module_div').removeClass('gradient-45deg-blue-grey-blue-grey');
                $('#delete_module_div').addClass('gradient-45deg-red-pink');
                $('#delete_module_h5').text('Active');
                swal("Poof! Your DELETE module has been turned on!", {
                    icon: "success",
                });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    // Start Jquery Post
                    $.post(url,{'delete_module': status,'_token':csrf_token}, function (data) {  });
                    // End Jquery Post
                }, 350);
            } else {
                $("#delete_module").prop("checked", false);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }else {
        var status = 'Disable';
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it off'
            }
        }).then(function (willTurnoff) {
            if (willTurnoff) {
                $('#delete_module_div').removeClass('gradient-45deg-red-pink');
                $('#delete_module_div').addClass('gradient-45deg-blue-grey-blue-grey');
                $('#delete_module_h5').text('Inactive');
                swal("Poof! Your DELETE module has been turned off!", {
                    icon: "success",
                });
                    setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                        // Start Jquery Post
                        $.post(url,{'delete_module': status,'_token':csrf_token}, function (data) {  });
                        // End Jquery Post
                    }, 350);
            } else {
                $("#delete_module").prop("checked", true);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }

});

$('#presentation_round_module').change(function(){

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updatepresentationroundmodulestatus') }}";

    if($('#presentation_round_module:checkbox:checked').length>0) {
        var status = "Enable";
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it on'
            }
        }).then(function (willTurnon) {
            if (willTurnon) {
                $('#presentation_round_module_div').removeClass('gradient-45deg-blue-grey-blue-grey');
                $('#presentation_round_module_div').addClass('gradient-45deg-blue-indigo');
                $('#presentation_round_module_h5').text('Active');
                swal("Poof! Your PRESENTATION ROUND module has been turned on!", {
                    icon: "success",
                });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    // Start Jquery Post
                    $.post(url,{'presentation_round_module': status,'_token':csrf_token}, function (data) {  });
                    // End Jquery Post
                }, 350);
            } else {
                $("#presentation_round_module").prop("checked", false);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }else {
        var status = 'Disable';
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it off'
            }
        }).then(function (willTurnoff) {
            if (willTurnoff) {
                $('#presentation_round_module_div').removeClass('gradient-45deg-blue-indigo');
                $('#presentation_round_module_div').addClass('gradient-45deg-blue-grey-blue-grey');
                $('#presentation_round_module_h5').text('Inactive');
                swal("Poof! Your PRESENTATION ROUND module has been turned off!", {
                    icon: "success",
                });
                    setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                        // Start Jquery Post
                        $.post(url,{'presentation_round_module': status,'_token':csrf_token}, function (data) {  });
                        // End Jquery Post
                    }, 350);
            } else {
                $("#presentation_round_module").prop("checked", true);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }

});

$('#prize_results_module').change(function(){

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updateprizeresultsmodulestatus') }}";

    if($('#prize_results_module:checkbox:checked').length>0) {
        var status = "Enable";
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it on'
            }
        }).then(function (willTurnon) {
            if (willTurnon) {
                $('#prize_results_module_div').removeClass('gradient-45deg-blue-grey-blue-grey');
                $('#prize_results_module_div').addClass('gradient-45deg-purple-deep-purple');
                $('#prize_results_module_h5').text('Active');
                swal("Poof! Your PRIZE RESULTS module has been turned on!", {
                    icon: "success",
                });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    // Start Jquery Post
                    $.post(url,{'prize_results_module': status,'_token':csrf_token}, function (data) {  });
                    // End Jquery Post
                }, 350);
            } else {
                $("#prize_results_module").prop("checked", false);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }else {
        var status = 'Disable';
        swal({
            title: "Are you sure?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it off'
            }
        }).then(function (willTurnoff) {
            if (willTurnoff) {
                $('#prize_results_module_div').removeClass('gradient-45deg-purple-deep-purple');
                $('#prize_results_module_div').addClass('gradient-45deg-blue-grey-blue-grey');
                $('#prize_results_module_h5').text('Inactive');
                swal("Poof! Your PRIZE RESULTS module has been turned off!", {
                    icon: "success",
                });
                    setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                        // Start Jquery Post
                        $.post(url,{'prize_results_module': status,'_token':csrf_token}, function (data) {  });
                        // End Jquery Post
                    }, 350);
            } else {
                $("#prize_results_module").prop("checked", true);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }

});


$('#site_maintenance_module').change(function(){

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updatemaintenancemodulestatus') }}";

    if($('#site_maintenance_module:checkbox:checked').length>0) {
        var status = "Enable";
        swal({
            title: "Are you sure?",
            text: "Site Maintenance Module will cause all users except Admin and Superadmin unable to access this site",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it on'
            }
        }).then(function (willTurnon) {
            if (willTurnon) {
                $('#site_maintenance_module_div').removeClass('gradient-45deg-blue-grey-blue-grey');
                $('#site_maintenance_module_div').addClass('gradient-45deg-brown-brown');
                $('#site_maintenance_module_h5').text('Active');
                swal("Your SITE MAINTENANCE module has been turned on! all user can't access this site until this module turn off", {
                    icon: "success",
                });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    // Start Jquery Post
                    $.post(url,{'site_maintenance_module': status,'_token':csrf_token}, function (data) {  });
                    // End Jquery Post
                }, 350);
            } else {
                $("#site_maintenance_module").prop("checked", false);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }else {
        var status = 'Disable';
        swal({
            title: "Are you sure?",
            text: "This will grant all user access in this site",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Turn it off'
            }
        }).then(function (willTurnoff) {
            if (willTurnoff) {
                $('#site_maintenance_module_div').removeClass('gradient-45deg-brown-brown');
                $('#site_maintenance_module_div').addClass('gradient-45deg-blue-grey-blue-grey');
                $('#site_maintenance_module_h5').text('Inactive');
                swal("Your SITE MAINTENANCE module has been turned off! all user can access this site", {
                    icon: "success",
                });
                    setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                        // Start Jquery Post
                        $.post(url,{'site_maintenance_module': status,'_token':csrf_token}, function (data) {  });
                        // End Jquery Post
                    }, 350);
            } else {
                $("#site_maintenance_module").prop("checked", true);
                swal("Your module is on", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }

});
// END checkbox checked to change div background color & h5 text VIEW : page-qcc-system-setting SOURCE : https://stackoverflow.com/questions/2204250/check-if-checkbox-is-checked-with-jquery

// สำหรับแสดง datepicker
$(document).ready(function() {
    // $(".modal").modal();
    $(".datepicker").datepicker({
        yearRange: 15, // Number of years either side, or array of upper/lower range.
        format: "dd/mm/yyyy", // The date output format for the input field value.
        showDaysInNextAndPreviousMonths: "true", // Render days of the calendar grid that fall in the next or previous month.
        autoClose: true, // Automatically close picker when date is selected.
        showClearBtn: true, // Show the clear button in the datepicker.

        // Internationalization options.
        i18n: {
            clear: "Clear",
            months: [
                "มกราคม",
                "กุมภาพันธ์",
                "มีนาคม",
                "เมษายน",
                "พฤษภาคม",
                "มิถุนายน",
                "กรกฎาคม",
                "สิงหาคม",
                "กันยายน",
                "ตุลาคม",
                "พฤศจิกายน",
                "ธันวาคม"
            ],
            monthsShort: [
                "ม.ค.",
                "ก.พ.",
                "มี.ค.",
                "เม.ย.",
                "พ.ค.",
                "มิ.ย.",
                "ก.ค.",
                "ส.ค.",
                "ก.ย.",
                "ต.ค.",
                "พ.ย.",
                "ธ.ค."
            ],
            weekdays: [
                "อาทิตย์",
                "จันทร์",
                "อังคาร",
                "พุธ",
                "พฤหัสบดี",
                "ศุกร์",
                "เสาร์"
            ],
            weekdaysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
            weekdaysAbbrev: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."]
        }
    });
});
// END datepicker

// START Form Mask to format v_sysyear input to match a specified pattern.
$('#v_sysyear').mask('0000');
// END Form Mask to format v_sysyear input to match a specified pattern.

// Character Counter ใช้คู่กับ data-length="#" ใน tag input,textarea
$('input#v_sysyear').characterCounter();

// ไว้สำหรับ update system year โดยการ key เลขปีให้ตรงตามเงื่อนไขก็จะ post ค่าลงไปใน DB เลย
$('#v_sysyear').keyup(function() {
    var v_sysyear = $(this).val();
    var v_sysyear_lenght = $('#v_sysyear').val().length;
    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updateqccsystemyear') }}";
    if(v_sysyear_lenght >= 4 && v_sysyear >= 2019 && v_sysyear != '') {
        swal("Your system year has been updated", {
            title: 'Success',
            icon: "success",
        });
        setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
            // Start Jquery Post
            $.post(url,{'v_sysyear': v_sysyear,'_token':csrf_token}, function (data) {  });
            // End Jquery Post
        }, 350);
    }else if(v_sysyear_lenght >= 4 && v_sysyear <= 2019){
        swal("Your system year cannot be less than 2019", {
            title: 'Alert',
            icon: "warning",
        });
    }
});

// ไว้สำหรับ update system start date โดยการ onchange ให้ตรงตามเงื่อนไขก็จะ post ค่าลงไปใน DB เลย
$('#v_sys_startdate').change(function() {
    var v_sys_startdate = $(this).val();
    var v_sys_startdate_lenght = $('#v_sys_startdate').val().length;
    var v_sys_enddate = $('#v_sys_enddate').val();

    var split_v_sys_startdate = $('#v_sys_startdate').val().split("/"); // SOURCE : https://stackoverflow.com/questions/7151543/convert-dd-mm-yyyy-string-to-date
    var strtodate_v_sys_startdate = new Date(split_v_sys_startdate[2], split_v_sys_startdate[1] - 1, split_v_sys_startdate[0]);
    var split_v_sys_enddate = $('#v_sys_enddate').val().split("/");
    var strtodate_v_sys_enddate = new Date(split_v_sys_enddate[2], split_v_sys_enddate[1] - 1, split_v_sys_enddate[0]);

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updateqccsystemstrtdate') }}";

    if(strtodate_v_sys_startdate < strtodate_v_sys_enddate && v_sys_startdate != '') {
        swal("Your system start date has been updated", {
            title: 'Success',
            icon: "success",
        });
        setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
            // Start Jquery Post
            $.post(url,{'v_sys_startdate': v_sys_startdate,'_token':csrf_token}, function (data) {  });
            // End Jquery Post
        }, 350);
    }else if(strtodate_v_sys_startdate > strtodate_v_sys_enddate){
        swal("Your system start date cannot be more than system end date", {
            title: 'Alert',
            icon: "warning",
        });
    }else if(v_sys_startdate_lenght <= 0){
        swal("Your system start date cannot be empty", {
            title: 'Alert',
            icon: "error",
        });
    }
});

// ไว้สำหรับ update system end date โดยการ onchange ให้ตรงตามเงื่อนไขก็จะ post ค่าลงไปใน DB เลย
$('#v_sys_enddate').change(function() {
    var v_sys_enddate = $(this).val();
    var v_sys_enddate_lenght = $('#v_sys_enddate').val().length;
    var v_sys_startdate = $('#v_sys_startdate').val();

    var split_v_sys_startdate = $('#v_sys_startdate').val().split("/"); // SOURCE : https://stackoverflow.com/questions/7151543/convert-dd-mm-yyyy-string-to-date
    var strtodate_v_sys_startdate = new Date(split_v_sys_startdate[2], split_v_sys_startdate[1] - 1, split_v_sys_startdate[0]);
    var split_v_sys_enddate = $('#v_sys_enddate').val().split("/");
    var strtodate_v_sys_enddate = new Date(split_v_sys_enddate[2], split_v_sys_enddate[1] - 1, split_v_sys_enddate[0]);

    var csrf_token = '{{ csrf_token() }}';
    var url = "{{ route('updateqccsystemenddate') }}";

    if(strtodate_v_sys_enddate > strtodate_v_sys_startdate && v_sys_enddate != '') {
        swal("Your system end date has been updated", {
            title: 'Success',
            icon: "success",
        });
        setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
            // Start Jquery Post
            $.post(url,{'v_sys_enddate': v_sys_enddate,'_token':csrf_token}, function (data) {  });
            // End Jquery Post
        }, 350);
    }else if(strtodate_v_sys_enddate < strtodate_v_sys_startdate){
        swal("Your system end date cannot be less than system start date", {
            title: 'Alert',
            icon: "warning",
        });
    }else if(v_sys_enddate_lenght <= 0){
        swal("Your system end date cannot be empty", {
            title: 'Alert',
            icon: "error",
        });
    }
});
</script>
@endsection
