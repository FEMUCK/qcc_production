{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','QCC Users list')

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
@endsection

{{-- page content --}}
@section('content')
<?php
    foreach($data as $value){
        if(isset($data['userslistdata'])){
            $userslistdata = $data['userslistdata'];
        }
        if(isset($userslistdata)){
        foreach($userslistdata as $userslistdata_item){
            $userid = $userslistdata_item->userid;
            $users_fullname = $userslistdata_item->users_fullname;
            $pabbr = $userslistdata_item->pabbr;
            $users_pic = $userslistdata_item->users_pic;
            $telname = $userslistdata_item->telname;
            $email = $userslistdata_item->email;
            $longno = $userslistdata_item->longno;
            $fay = $userslistdata_item->fay;
            $gong = $userslistdata_item->gong;
            $pnang = $userslistdata_item->pnang;
            $sysno = $userslistdata_item->sysno;
            $usertype = $userslistdata_item->usertype;
            $adminflag = $userslistdata_item->adminflag;
            $superadmin = $userslistdata_item->superadmin;
            $crby = $userslistdata_item->crby;
            $crdate = $userslistdata_item->crdate;
            $updby = $userslistdata_item->updby;
            $upddate = $userslistdata_item->upddate;
            $empstatus = $userslistdata_item->empstatus;
            }
        }
    }
?>

<!-- users add start -->
<div class="card-panel">
    <!-- form -->
    <form name='addQccAuthForm' method='POST' action="addqccauth">
        {{-- <input type="hidden" id="longid" name="longid" class="validate">
        <input type="hidden" id="orgid" name="orgid" class="validate">
        <input type="hidden" id="divno" name="divno" class="validate" value="">
        <input type="hidden" id="sectno" name="sectno" class="validate" value=""> --}}
        {{-- ใช้สำหรับนับว่ามีสิทธ์ใน S012 แล้วรึยังเพื่อใช้ป้องกันการเพิ่มสิทธิ์ซ้ำแล้ว SQL error --}}
        <input type="hidden" id="cnt_S012_privs" name="cnt_S012_privs" class="validate">
        @csrf

        <div class="row">
            <!-- Start Form Content -->
            <div class="input-field col s2 m2 l2">
                <i class="mdi mdi-account prefix"></i>
                <input id="idinput" name="idinput" type="text" data-length="6" class="validate" required>
                <label for="idinput">พนักงาน<font color="red">*</font></label>
                {{-- <span class="helper-text" id="cnt_S012_privs"></span> --}}
            </div>
            <div class="input-field col s3 m3 l3">
                <input disabled id="emp_name"  name="emp_name" type="text" class="validate" >
                <label for="emp_name">ชื่อ - สกุล</label>
            </div>
            <div class="input-field col s2 m2 l2">
                <input disabled id="pabbr" name="pabbr" type="text" class="validate">
                <label for="pabbr">ตำแหน่ง</label>
            </div>
            <div class="input-field col s3 m3 l3">
                <input disabled id="user_subject" name="user_subject" type="text" class="validate">
                <label for="user_subject">สังกัด</label>
            </div>

            {{-- <div class="input-field col s2 m2 l2">
                <select id="longno" name="longno" class="select2 browser-default">
                    <option value="" disabled selected>สายรอง</option>
                    @foreach($data['longno'] as $longno)
                        <option value='{{ $longno->longno }}'>{{ $longno->orgabbr }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-field col s2 m2 l2">
                <select id="fay" name="fay" class="select2 browser-default">
                    <option value="" selected>หน่วยงาน</option>
                </select>
            </div> --}}

            <div class="input-field col s2 m2 l2">
                <select id="usertype" name="usertype" class="select2 browser-default">
                    <option value="" disabled selected>สิทธิ์</option>
                    @if(session()->get('superadmin_S012') == 'Y')
                        <option value="Superadmin">Superadmin</option>
                    @endif
                    <option value="A">Admin</option>
                    <option value="R">User</option>
                </select>
            </div>
            {{-- <div class="input-field col s1.5">
                <textarea id="add_auth_remark" name="add_auth_remark" type="text" class="materialize-textarea"></textarea>
                <label for="add_auth_remark">หมายเหตุ</label>
            </div> --}}
        </div><!-- CLOSE ROW -->

        <div class="row">
            <!-- End Form Content -->
            <div class="input-field col s12 center">
                <button class="gradient-45deg-cyan-light-green btn waves-effect waves-light" id="btn_save_qcc_auth" name="btn_save_qcc_auth">Add
                    <i class="mdi mdi-account-plus right"></i>
                </button>
                &nbsp;
                <button class="gradient-45deg-red-pink btn waves-effect waves-light" id="btn_clearusersid" type="button">Clear
                    <i class="mdi mdi-close right"></i>
                </button>
            </div>
        </div><!-- CLOSE ROW -->

    </form><!-- CLOSE FORM -->
</div>

<!-- users list start -->
<section class="users-list-wrapper section">
    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">
                {{-- <form> --}}
                    <div class="col s12 m6 l3">
                        <label for="users-list-role">Role</label>
                        <div class="input-field">
                            <select class="form-control select2 browser-default" id="users-list-role">
                                <option value="">Any</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <label for="users-list-longno">สายรอง</label>
                        <div class="input-field">
                            <select class="form-control select2 browser-default" id="users-list-longno" name="users-list-longno">
                                <option value="">Any</option>
                                @foreach($data['longno'] as $longno)
                                    <option value='{{ $longno->orgabbr }}'>{{ $longno->orgabbr }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="hiddenlongno" name="hiddenlongno" class="validate">
                    </div>
                    <div class="col s12 m6 l3">
                        <label for="users-list-fay">หน่วยงาน</label>
                        <div class="input-field">
                            <select class="form-control select2 browser-default" id="users-list-fay" name="users-list-fay">
                                <option value="">Any</option>

                            </select>
                        </div>
                    </div>
                    <div class="col s6 m3 l1.5 display-flex align-items-center show-btn">
                        <button class="btn btn-block indigo waves-effect waves-light" type="button" id="btn_show_all_qcc_users" name="btn_show_all_qcc_users">Show All</button>
                        &nbsp;
                        <button class="btn btn-block gradient-45deg-green-teal btn waves-effect waves-light " id="btn_downloadexcel" onclick="window.location='{{ url('page-qcc-users-list/export') }}'">Excel<i class="mdi mdi-file-excel right"></i></button>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

    {{-- <div class="users-list-table"> --}}
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table users-list-table">
                    <table id="users-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th class="center-align">#</th>
                                <th class="center-align"><i class="mdi mdi-account-circle"></i></th>
                                <th class="center-align">ID</th>
                                <th class="center-align">ชื่อ-สกุล</th>
                                <th class="center-align">ตำแหน่ง</th>
                                <th class="center-align">แผนก</th>
                                <th class="center-align">กอง</th>
                                <th class="center-align">หน่วยงาน</th>
                                <th class="center-align">สายรอง</th>
                                <th class="center-align">Role</th>
                                <th class="center-align"><i class="mdi mdi-deskphone" style="margin-top: -7px;"></th>
                                <th class="center-align"><i class="mdi mdi-email" style="margin-top: -7px;"></th>
                                <th class="center-align">Status</th>
                                {{-- <th class="center-align">crby</th>
                                <th class="center-align">crdate</th> --}}
                                <th class="center-align">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($userslistdata))
                            @foreach ($userslistdata as $userslistdata_item)
                                <tr>
                                    <td class="center-align">{{ $loop->iteration }}</td>
                                    @if($userslistdata_item->empstatus == 'Active')
                                        <td class="center-align"><img class="responsive-img" width="38" style="border-radius: 50%;" src="{{ $userslistdata_item->users_pic }}" alt="avatar"></td>
                                    @else
                                    <td class="center-align"><img class="responsive-img" width="38" style="border-radius: 50%;" src="{{asset('images/avatar/blank-profile.jpg')}}" alt="avatar"></td>
                                    @endif
                                    <td class="center-align">{{ $userslistdata_item->userid }}</td>
                                    <td class="center-align">{{ $userslistdata_item->users_fullname }}</td>
                                    <td class="center-align">{{ $userslistdata_item->pabbr }}</td>
                                    <td class="center-align">{{ $userslistdata_item->pnang }}</td>
                                    <td class="center-align">{{ $userslistdata_item->gong }}</td>
                                    <td class="center-align">{{ $userslistdata_item->fay }}</td>
                                    <td class="center-align">{{ $userslistdata_item->longno }}</td>
                                    @if($userslistdata_item->superadmin == 'Y')
                                        <td class="center-align"><span class="chip green lighten-5"><span class="green-text">Superadmin</span></span></td>
                                    @elseif($userslistdata_item->usertype == 'A')
                                        <td class="center-align"><span class="chip green lighten-5"><span class="green-text">Admin</span></span></td>
                                    @else
                                        <td class="center-align"><span class="chip blue lighten-5"><span class="blue-text">User</span></span></td>
                                    @endif
                                    <td class="center-align">{{ $userslistdata_item->telname }}</td>
                                    <td class="center-align">{{ $userslistdata_item->email }}</td>
                                    @if($userslistdata_item->empstatus == 'Active')
                                        <td class="center-align"><span class="chip green lighten-5"><span class="green-text">{{ $userslistdata_item->empstatus }}</span></span></td>
                                    @else
                                        <td class="center-align"><span class="chip red lighten-5"><span class="red-text">{{ $userslistdata_item->empstatus }}</span></span></td>
                                    @endif
                                    {{-- <td class="center-align">{{ $userslistdata_item->crby }}</td>
                                    <td class="center-align">{{ $userslistdata_item->crdate }}</td> --}}
                                    {{-- <td><a href="{{asset('page-users-edit')}}"><button class="gradient-45deg-amber-amber btn waves-effect waves-light btn-floating btn-small" id="btn"><i class="mdi mdi-pencil"></i></button></a>
                                        <a href="{{asset('page-users-view')}}"><button class="gradient-45deg-red-pink btn waves-effect waves-light btn-floating btn-small" id="btn"><i class="mdi mdi-trash-can"></i></button></a></td> --}}
                                    @if($userslistdata_item->superadmin == 'Y')
                                        <td><a onclick="deleteDisableFunction();"><button class="gradient-45deg-blue-grey-blue-grey btn waves-effect waves-light btn-floating btn-small" id="delete-qcc-user-btn-disable"><i class="mdi mdi-trash-can"></i></button></a></td>
                                    @else
                                        <td><a onclick="deleteQccAuthFunction('{{ $userslistdata_item->userid }}');"><button class="gradient-45deg-red-pink btn waves-effect waves-light btn-floating btn-small" id="btn"><i class="mdi mdi-trash-can"></i></button></a></td>
                                    @endif
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    {{-- </div> --}}
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('vendors/igorescobar/jquery-mask-plugin/dist/jquery.mask.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/page-users.js')}}"></script>
<script src="{{asset('js/scripts/form-select2.js')}}"></script>
<script src="{{asset('js/scripts/extra-components-sweetalert.js')}}"></script>
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>

<script>
// START Form Mask to format user input to match a specified pattern.
$('#idinput').mask('000000');
// END Form Mask to format user input to match a specified pattern.

// Character Counter ใช้คู่กับ data-length="#" ใน tag input,textarea
$('input#idinput').characterCounter();

// START dependent dropdown VIEW : page-qcc-user-list
$('#longno').change(function() {
    var longno = $("#longno").val();
    var url = '{{ url('faylist') }}/' + longno;
    $.get(url, function (data) {
        // console.log(data);
        var fayname = $('#fay');
        fayname.empty();
        fayname.append("<option value='' disabled selected>หน่วยงาน</option>");
        $.each(data, function(key, value) {
            fayname.append("<option value='"+value.ORGNO +"'>" + value.ORGABBR + "</option>");
        });
    });
});

$('#users-list-longno').change(function() {
    var orgabbr = $("#users-list-longno").val();
    if (orgabbr == 'ผวก.') {
        var hiddenlongno = 'S000000';
    } else if (orgabbr == 'รวช.') {
        var hiddenlongno = 'S500000';
    } else if (orgabbr == 'รวธ.') {
        var hiddenlongno = 'S700000';
    } else if (orgabbr == 'รวบ.') {
        var hiddenlongno = 'S300000';
    } else if (orgabbr == 'รวพ.') {
        var hiddenlongno = 'S800000';
    } else if (orgabbr == 'รวฟ.') {
        var hiddenlongno = 'S400000';
    } else if (orgabbr == 'รวย.') {
        var hiddenlongno = 'S200000';
    } else if (orgabbr == 'รวส.') {
        var hiddenlongno = 'S600000';
    } else if (orgabbr == 'รวห.') {
        var hiddenlongno = 'S100000';
    }
    $('#hiddenlongno').val(hiddenlongno);
    M.updateTextFields();
    var longno = $("#hiddenlongno").val();
    var url = '{{ url('faylist') }}/' + longno;
    $.get(url, function (data) {
        // console.log(data);
        var fayname = $('#users-list-fay');
        fayname.empty();
        fayname.append("<option value='' selected>Any</option>");
        $.each(data, function(key, value) {
            fayname.append("<option value='"+value.ORGABBR +"'>" + value.ORGABBR + "</option>");
        });
    });
});
// END dependent dropdown VIEW : page-qcc-user-list

// START Clear Button for 'addQccAuthForm' input field VIEW : page-qcc-users-list
$('#btn_clearusersid').on('click', function(e) {
    $('#idinput').val('');
    $('#emp_name').val('');
    $('#pabbr').val('');
    $('#user_subject').val('');
    $('#longno').val('').trigger('change');
    $('#fay').val('').trigger('change');
    $('#usertype').val('').trigger('change');
    $('#add_auth_remark').val('');
    $('#cnt_S012_privs').val('');
    M.updateTextFields();
});
// END Clear Button for 'addQccAuthForm' input field VIEW : page-qcc-users-list

// START สำหรับแสดง onkeyup ใน View : page-qcc-user-list จะทำงานก็ต่อเมื่อความยาวตัวอักษร = 6 Source:https://stackoverflow.com/questions/33285622/jquery-trigger-event-based-on-form-input-length
$('#idinput').keyup(function() {
    // alert('AAA');
    var idinput = $(this).val();
    var idinputlenght = $('#idinput').val().length;
    var url = '{{ url('usersdata') }}/' + idinput;
    if(idinputlenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#emp_name').val(value.users_fullname);
                $('#pabbr').val(value.pabbr);
                $('#telname').val(value.telname);
                $('#divno').val(value.divno);
                $('#sectno').val(value.sectno);
                $('#u_remark').val(value.u_remark);
                $('#orgid').val(value.orgno);
                $('#longid').val(value.long);
                $('#user_subject').val(value.user_subject);
                $('#cnt_S012_privs').val(value.cnt_S012_privs);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});
// END สำหรับแสดง onkeyup ใน View : page-qcc-user-list จะทำงานก็ต่อเมื่อความยาวตัวอักษร = 6 Source:https://stackoverflow.com/questions/33285622/jquery-trigger-event-based-on-form-input-length

// START สำหรับ clear ค่าถ้าความยาวตัวอักษร idinput < 6 Event onkeyup ใน View : page-qcc-user-list
$('#idinput').keyup(function() {
    var idinput = $(this).val();
    var idinputlenght = $('#idinput').val().length;
    if(idinputlenght < 6) {
        $('#emp_name').val('');
        $('#pabbr').val('');
        $('#telname').val('');
        $('#divno').val('');
        $('#sectno').val('');
        $('#u_remark').val('');
        $('#orgid').val('');
        $('#longid').val('');
        $('#user_subject').val('');
        $('#cnt_S012_privs').val('');
        M.updateTextFields();
    }
});
// END สำหรับ clear ค่าถ้าความยาวตัวอักษร idinput < 6 Event  onkeyup ใน View : page-qcc-user-list

// START Show All Button for VIEW : page-qcc-page-qcc-user-list
$('#btn_show_all_qcc_users').on('click', function(e) {
    $('#users-list-role').val('').trigger('change');
    $('#users-list-longno').val('').trigger('change');
    $('#users-list-fay').val('').trigger('change');
    M.updateTextFields();
});
// END Show All Button for VIEW : page-qcc-user-list

// START Form Validation 'addQccAuthForm' for addqccauth VIEW : page-qcc-users-list
$("#btn_save_qcc_auth").click(function(){
	var idinput = $("#idinput").val();
    var usertype = $("#usertype").val();
    var cnt_S012_privs = $("#cnt_S012_privs").val();

    var msg = "";
    var cnt = 0;

    if (idinput == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุรหัสพนักงาน"
    }

    if (usertype == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุสิทธิ์ในระบบ"
    }

    if (cnt_S012_privs == 1) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+"."+idinput+" มีสิทธิ์ในระบบแล้ว"
    }

    if(cnt > 0){
    swal({
        title: "Warning!!",
        // text: "Please check the missing field!"+msg,
        text: msg,
        icon: 'warning',
        buttons: "OK",
        // timer: 1500
    });
        return false;
    }else{
        // swal("Your record has been saved", {
        //         icon: "success",
        //     })
        swal({
            text: "Your record has been saved",
            icon: 'success',
            // buttons: "OK",
        })
        .then(() => {
            setTimeout(function() {
                returnFunction; // ใช้การเรียก returnFunction ที่ return true แทน SOURCE : https://stackoverflow.com/questions/13642885/return-true-and-setimout/13642946#:~:text=It%20does%20not%20return%20true,callback%20to%20the%20asynchronous%20function.
            }, 350);
        })
    }
});

function returnFunction() {
    return true;
}
// END Form Validation 'addQccAuthForm' for addqccauth VIEW : page-qcc-users-list

// START SweetAlert2 Delete Confirmation VIEW : page-qcc-users-list
function deleteQccAuthFunction(userid){
    // alert('delete click');
        swal({
        title: "Are you sure?",
        text: "You will not be able to revert this!",
        icon: 'warning',
        dangerMode: true,
        buttons: {
            cancel: 'No, Please!',
            delete: 'Yes, Delete It'
        }
        }).then(function (willDelete) {
            if (willDelete) {
            swal("Poof! Your record has been deleted!", {
                icon: "success",
            });
                setTimeout(function() { // เพื่อ delay ให้ animation แสดงครบก่อน refresh ผล : https://stackoverflow.com/questions/5990725/how-to-delay-execution-in-between-the-following-in-my-javascript
                    window.location.href = '{{ URL::to('deleteqccauth/') }}/'+userid;
                }, 350);
            } else {
            swal("Your record is safe", {
                title: 'Cancelled',
                icon: "error",
            });
            }
        });
    }
// END SweetAlert2 Delete Confirmation VIEW : page-qcc-users-list

function deleteDisableFunction() {
    swal({
        title: 'You don’t have permission to delete Superadmin',
        icon: 'warning'
    })
};
</script>
@endsection
