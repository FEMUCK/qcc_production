{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','QCC Data Table')

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
        if(isset($data['qcclist'])){
            $qcclist = $data['qcclist'];
        }
        if(isset($qcclist)){
        foreach($qcclist as $qcclist_item){
            $group_id = $qcclist_item->group_id;
            $group_yr = $qcclist_item->group_yr;
            $act_name = $qcclist_item->act_name;
            $telname = $qcclist_item->fay;
            $email = $qcclist_item->longno;
            $respondant_id = $qcclist_item->respondant_id;
            $respondant_fullname = $qcclist_item->respondant_fullname;
            $longno = $qcclist_item->telname;
            $fay = $qcclist_item->email;
            }
        }

        // ประกาศตัวแปรไว้ก่อนใช้งานด้านบนนี้เลย สำหรับ checkbox module ต่างๆ ด้านล่าง พร้อมกับใช้ foreach จากด้านบนเลย (ไม่ต้องไปประกาศแทรกใน HTML)
        $create_module = '';
        $edit_module = '';
        $delete_module = '';
        if(isset($data['systemsettingdata'])){
            $systemsettingdata = $data['systemsettingdata'];
            foreach($systemsettingdata as $systemsettingdata_item){
                $paramno = $systemsettingdata_item->paramno;
                $paramtype = $systemsettingdata_item->paramtype;
                $paramval = $systemsettingdata_item->paramval;

				if($paramno == 'S012' && $paramtype == 'ADD' && $paramval == 'Enable'){
                    $create_module = 'Enable';
                }elseif($paramno == 'S012' && $paramtype == 'EDIT' && $paramval == 'Enable'){
                    $edit_module = 'Enable';
                }elseif($paramno == 'S012' && $paramtype == 'REMOVE' && $paramval == 'Enable'){
                    $delete_module = 'Enable';
                }else{}
            }
        }
    }
?>

<!-- QCC add start -->
<div class="row">
    <div class="col s1.5">
        @if($create_module == 'Enable' || session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
            <a href="{{ route('page-qcc-register') }}">
                <button type="button" class="btn gradient-45deg-red-pink waves-effect waves-light border-round z-depth-4">Create
                    <i class="mdi mdi-plus left" style="margin-right: 5px;"></i>
                </button>
            </a>
        @else
            <a onclick="createDisableFunction();">
                <button type="button" class="btn gradient-45deg-blue-grey-blue-grey waves-effect waves-light border-round z-depth-4 tooltipped" data-position="bottom" data-tooltip="ระบบไม่เปิดให้เพิ่มข้อมูลได้ในขณะนี้">Create
                    <i class="mdi mdi-plus left" style="margin-right: 5px;"></i>
                </button>
            </a>
        @endif
        {{-- <a href="#">
            <button type="button" class="btn gradient-45deg-purple-light-blue waves-effect waves-light border-round z-depth-4">Export To PDF
                <i class="mdi mdi-adobe-acrobat left" style="margin-right: 5px;"></i>
            </button>
        </a> --}}
    </div>
</div>

<!-- QCC list start -->
<section class="users-list-wrapper section">
    <!-- Filter Only for Admin START -->
    @if(session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
        <div class="users-list-filter">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m6 l3">
                        <label for="users-list-role">ประเภทผลงาน</label>
                        <div class="input-field">
                            <select class="form-control select2 browser-default" id="users-list-role">
                                <option value="">Any</option>
                                @foreach($data['actcat'] as $actcat)
                                    <option value='{{ $actcat->act_cat }}'>{{ $actcat->act_cat }}</option>
                                @endforeach
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
                        <button class="btn btn-block indigo waves-effect waves-light" type="button" id="btn_show_all_qcc" name="btn_show_all_qcc">Show All</button>
                        &nbsp;
                        <button class="btn btn-block gradient-45deg-green-teal btn waves-effect waves-light" type="button" id="btn_downloadexcel" onclick="window.location='{{ url('page-qcc-datatable/export') }}'">Excel<i class="mdi mdi-file-excel right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Filter Only for Admin END -->

    {{-- <div class="users-list-table"> --}}
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table users-list-table">
                    <table id="users-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th class="center-align">#</th>
                                <th class="center-align">เลขที่กลุ่ม</th>
                                <th class="center-align">ชื่อกระบวนการ</th>
                                <th class="center-align">ประเภทผลงาน</th>
                                <th class="center-align">หน่วยงาน</th>
                                <th class="center-align">สายรอง</th>
                                <th class="center-align">ผู้ประสานงาน</th>
                                <th class="center-align">โทร</th>
                                <th class="center-align">email</th>
                                <th class="center-align">file link</th>
                                <th class="center-align">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($qcclist))
                            @foreach ($qcclist as $qcclist_item)
                                <tr>
                                    <td class="center-align">{{ $loop->iteration }}</td>
                                    <td class="center-align">{{ $qcclist_item->group_id }}</td>
                                    <td class="center-align">{{ $qcclist_item->act_name }}</td>

                                    @if($qcclist_item->act_cat == 'เทคนิค')
                                        <td class="center-align"><span class="chip blue lighten-5"><span class="blue-text">{{ $qcclist_item->act_cat }}</span></span></td>
                                    @elseif($qcclist_item->act_cat == 'สำนักงาน')
                                        <td class="center-align"><span class="chip amber lighten-5"><span class="amber-text">{{ $qcclist_item->act_cat }}</span></span></td>
                                    @elseif($qcclist_item->act_cat == null)
                                        <td class="center-align"><span class="chip red lighten-5"><span class="red-text">N/A</span></span></td>
                                    @endif
                                    <td class="center-align">{{ $qcclist_item->fay }}</td>
                                    <td class="center-align">{{ $qcclist_item->longno }}</td>
                                    <td class="center-align">{{ $qcclist_item->respondant_fullname }}</td>
                                    <td class="center-align">{{ $qcclist_item->telname }}</td>
                                    <td class="center-align">{{ $qcclist_item->email }}</td>

                                    @if($qcclist_item->attachment_url != null)
                                        <td><a href="{{ $qcclist_item->attachment_url }}" target="_blank"><button class="gradient-45deg-purple-deep-purple btn waves-effect waves-light btn-floating btn-small" id="ecp-qcc-btn"><i class="mdi mdi-file-download"></i></button></a></td>
                                    @else
                                        <td><a onclick='return false;' class="tooltipped" data-position="bottom" data-tooltip="ไม่มีการอัพโหลดเอกสาร"><button class="gradient-45deg-blue-grey-blue-grey btn waves-effect waves-light btn-floating btn-small" id="ecp-qcc-btn"><i class="mdi mdi-file-download"></i></button></a></td>
                                    @endif

                                    <td><a href="{{ URL::to('page-qcc-view/'.$qcclist_item->group_yr.'/'.$qcclist_item->group_id) }}"><button class="gradient-45deg-light-blue-cyan btn waves-effect waves-light btn-floating btn-small" id="view-qcc-btn"><i class="mdi mdi-eye"></i></button></a>
                                        @if($edit_module == 'Enable' || session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
                                            <a href="{{ URL::to('page-qcc-edit/'.$qcclist_item->group_yr.'/'.$qcclist_item->group_id) }}"><button class="gradient-45deg-amber-amber btn waves-effect waves-light btn-floating btn-small" id="edit-qcc-btn"><i class="mdi mdi-pencil"></i></button></a>
                                        @else
                                            <a onclick="editDisableFunction();"><button class="gradient-45deg-blue-grey-blue-grey btn waves-effect waves-light btn-floating btn-small" id="edit-qcc-btn-disable"><i class="mdi mdi-pencil"></i></button></a>
                                        @endif
                                        @if($delete_module == 'Enable' || session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
                                            <a onclick="deleteQccFunction({{ $qcclist_item->group_yr }},'{{ $qcclist_item->group_id }}');"><button class="gradient-45deg-red-pink btn waves-effect waves-light btn-floating btn-small" id="delete-qcc-btn"><i class="mdi mdi-trash-can"></i></button></a></td>
                                        @else
                                            <a onclick="deleteDisableFunction();"><button class="gradient-45deg-blue-grey-blue-grey btn waves-effect waves-light btn-floating btn-small" id="delete-qcc-btn-disable"><i class="mdi mdi-trash-can"></i></button></a></td>
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

<script>
// START dependent dropdown VIEW : page-qcc-datatable
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
// END dependent dropdown VIEW : page-qcc-datatable

// START Show All Button for VIEW : page-qcc-datatable
$('#btn_show_all_qcc').on('click', function(e) {
    $('#users-list-role').val('').trigger('change');
    $('#users-list-longno').val('').trigger('change');
    $('#users-list-fay').val('').trigger('change');
    M.updateTextFields();
});
// END Show All Button for VIEW : page-qcc-datatable

// START SweetAlert2 Delete Confirmation VIEW : page-qcc-datatable
function deleteQccFunction(groupyear,groupid){
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
                    window.location.href = '{{ URL::to('deleteqcc/') }}/'+groupyear+'/'+groupid;
                }, 350);
            } else {
            swal("Your record is safe", {
                title: 'Cancelled',
                icon: "error",
            });
            }
        });
    }
// END SweetAlert2 Delete Confirmation VIEW : page-qcc-datatable

// START SweetAlert2 Notification for Disabled Module
function createDisableFunction() {
    swal({
        title: 'ระบบไม่เปิดให้เพิ่มข้อมูลได้ในขณะนี้',
        icon: 'warning'
    })
};

function editDisableFunction() {
    swal({
        title: 'ระบบไม่เปิดให้แก้ไขข้อมูลได้ในขณะนี้',
        icon: 'warning'
    })
};

function deleteDisableFunction() {
    swal({
        title: 'ระบบไม่เปิดให้ลบข้อมูลได้ในขณะนี้',
        icon: 'warning'
    })
};
// END SweetAlert2 Notification for Disabled Module
</script>
@endsection
