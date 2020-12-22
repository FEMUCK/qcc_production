{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','QCC Form View' )

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
<?php
    foreach($data as $value){
        // ประกาศตัวแปรไว้ก่อนใช้งานด้านบนนี้เลย สำหรับ checkbox module ต่างๆ ด้านล่าง พร้อมกับใช้ foreach จากด้านบนเลย (ไม่ต้องไปประกาศแทรกใน HTML)
        $edit_module = '';
        if(isset($data['systemsettingdata'])){
            $systemsettingdata = $data['systemsettingdata'];
            foreach($systemsettingdata as $systemsettingdata_item){
                $paramno = $systemsettingdata_item->paramno;
                $paramtype = $systemsettingdata_item->paramtype;
                $paramval = $systemsettingdata_item->paramval;

				if($paramno == 'S012' && $paramtype == 'EDIT' && $paramval == 'Enable'){
                    $edit_module = 'enable';
                }else{}
            }
        }

        if(isset($data['qccdetail'])){
            $qccdetail = $data['qccdetail'];
        }
    }

    if(isset($qccdetail)){
        foreach($qccdetail as $qccdetail_item){
            $v_groupid = $qccdetail_item->group_id;
            $v_group_yr = $qccdetail_item->group_yr;
            $v_act_name = $qccdetail_item->act_name;
            $v_act_startdate = $qccdetail_item->act_startdate;
            $v_act_enddate = $qccdetail_item->act_enddate;
            $v_act_purpose_id = $qccdetail_item->act_purpose_id;
            $v_act_purpose = $qccdetail_item->act_purpose;
            $v_act_purpose_remark = $qccdetail_item->act_purpose_remark;
            $v_act_tool_id = $qccdetail_item->act_tool_id;
            $v_act_tool = $qccdetail_item->act_tool;
            $v_act_tool_remark = $qccdetail_item->act_tool_remark;
            $v_act_cat_id = $qccdetail_item->act_cat_id;

            $v_member_c = $qccdetail_item->member_c;
            $v_member_name_c = $qccdetail_item->c_name;
            $v_member_h = $qccdetail_item->member_h;
            $v_member_name_h = $qccdetail_item->h_name;
            $v_member_m2 = $qccdetail_item->member_m2;
            $v_member_name_m2 = $qccdetail_item->m2_name;
            $v_member_m3 = $qccdetail_item->member_m3;
            $v_member_name_m3 = $qccdetail_item->m3_name;
            $v_member_m4 = $qccdetail_item->member_m4;
            $v_member_name_m4 = $qccdetail_item->m4_name;
            $v_member_m5 = $qccdetail_item->member_m5;
            $v_member_name_m5 = $qccdetail_item->m5_name;
            $v_member_m6 = $qccdetail_item->member_m6;
            $v_member_name_m6 = $qccdetail_item->m6_name;

            $v_before_fix = $qccdetail_item->before_fix;
            $v_indicator = $qccdetail_item->indicator;
            $v_conceptual_framework = $qccdetail_item->conceptual_framework;
            $v_theory = $qccdetail_item->theory;

            $v_conceptual_framework_approach = $qccdetail_item->conceptual_framework_approach;

            $v_results_based_monitoring = $qccdetail_item->results_based_monitoring;
            $v_after_fix = $qccdetail_item->after_fix;
            $v_result_vs_goal = $qccdetail_item->result_vs_goal;
            $v_reduced_cost = $qccdetail_item->reduced_cost;
            $v_reduced_cost_desc = $qccdetail_item->reduced_cost_desc;
            $v_available_capacity_improvement = $qccdetail_item->available_capacity_improvement;
            $v_available_capacity_improvement_desc = $qccdetail_item->available_capacity_improvement_desc;
            $v_increase_efficiency = $qccdetail_item->increase_efficiency;
            $v_increase_efficiency_desc = $qccdetail_item->increase_efficiency_desc;
            $v_stakeholder_fx = $qccdetail_item->stakeholder_fx;
            $v_reduced_mat_cost = $qccdetail_item->reduced_mat_cost;
            $v_reduced_man_day = $qccdetail_item->reduced_man_day;
            $v_reduced_enegy_cost = $qccdetail_item->reduced_enegy_cost;
            $v_reduced_worker_accident = $qccdetail_item->reduced_worker_accident;
            $v_reduced_asset_accident = $qccdetail_item->reduced_asset_accident;
            $v_satisfaction = $qccdetail_item->satisfaction;
            $v_innovation = $qccdetail_item->innovation;
            $v_other_stakeholder_fx = $qccdetail_item->other_stakeholder_fx;

            $v_follow_up1 = $qccdetail_item->follow_up1;
            $v_follow_up2 = $qccdetail_item->follow_up2;
            $v_follow_up3 = $qccdetail_item->follow_up3;
            $v_follow_up4 = $qccdetail_item->follow_up4;

            $employeedata_fay = $qccdetail_item->employeedata_fay;
        }
    }else{
        $v_groupid = '';
        $v_group_yr = '';
        $v_act_name = '';
        $v_act_startdate = '';
        $v_act_enddate = '';
        $v_act_purpose_id = '';
        $v_act_purpose_remark = '';
        $v_act_tool_id = '';
        $v_act_tool_remark = '';
        $v_act_cat_id = '';

        $v_member_c = '';
        $v_member_name_c = '';
        $v_member_h = '';
        $v_member_name_h = '';
        $v_member_m2 = '';
        $v_member_name_m2 = '';
        $v_member_m3 = '';
        $v_member_name_m3 = '';
        $v_member_m4 = '';
        $v_member_name_m4 = '';
        $v_member_m5 = '';
        $v_member_name_m5 = '';
        $v_member_m6 = '';
        $v_member_name_m6 = '';


        $v_before_fix = '';
        $v_indicator = '';
        $v_conceptual_framework = '';
        $v_theory = '';

        $v_conceptual_framework_approach = '';

        $v_results_based_monitoring = '';
        $v_after_fix = '';
        $v_result_vs_goal = '';
        $v_reduced_cost = '';
        $v_reduced_cost_desc = '';
        $v_available_capacity_improvement = '';
        $v_available_capacity_improvement_desc = '';
        $v_increase_efficiency = '';
        $v_increase_efficiency_desc = '';
        $v_stakeholder_fx = '';
        $v_reduced_mat_cost = '';
        $v_reduced_man_day = '';
        $v_reduced_enegy_cost = '';
        $v_reduced_worker_accident = '';
        $v_reduced_asset_accident = '';
        $v_satisfaction = '';
        $v_innovation = '';
        $v_other_stakeholder_fx = '';

        $v_follow_up1 = '';
        $v_follow_up2 = '';
        $v_follow_up3 = '';
        $v_follow_up4 = '';

        $employeedata_fay = '';
    }
?>

<!-- app invoice View Page -->
<section class="invoice-view-wrapper section">
    <div class="row">
        <!-- invoice view page -->
        <div class="col xl9 m8 s12">
            <div class="card">
                <div class="card-content invoice-print-area">
                    <!-- header section -->
                    <div class="row invoice-date-number">
                        <div class="col xl4 s12">
                            <span class="invoice-number mr-1">เลขที่กลุ่ม#</span>
                            <span>{{ $v_groupid }}</span>
                            <br>
                            <span class="invoice-number mr-1">(คะแนนรวมที่ได้..........)</span>
                        </div>
                        <div class="col xl8 s12 push-s3">
                            <div class="invoice-date display-flex align-items-center flex-wrap">
                                <div class="mr-3">
                                    <small>Date Issue:</small>
                                    <span>{{ now()->format('d/m/') }}{{ now()->year+543 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logo and title -->
                    <div class="row mt-3">
                    {{-- <div class="row mt-3 invoice-logo-title"> --}}
                        {{-- <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                            <img src="{{asset('images/gallery/pixinvent-logo.png')}}" alt="logo" height="46" width="164">
                        </div> --}}
                        <div class="col l12 m12 s12">
                            <h6 class="indigo-text center-align">ใบสมัครการปรับปรุง/พัฒนาคุณภาพงาน ประจำปี 2563</h6>
                            <br>
                            {{-- <span>เรียน ผู้อำนวยการฝ่าย.........................ผ่าน..................................................</span> --}}
                            <span>เรียน ผู้อำนวยการฝ่าย {{ $employeedata_fay }} ผ่าน..................................................</span>
                            <br>
                            &emsp;&ensp;&ensp;&ensp;<span>กลุ่ม/บุคคล........................................ขอส่งผลงานการปรับปรุง/พัฒนาคุณภาพงาน เข้าคัดเลือกผลงาน กฟผ. ประจำปี 2563 โดยมีรายละเอียดดังนี้</span>
                        </div>
                    </div>

                    {{-- <hr class="divider mb-3 mt-3" style="width:100%; color:gray; background-color:gray;"> --}}
                    <div class="divider mb-3 mt-3"></div>

                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m6 s12">
                            <h6 class="invoice-from">Profile</h6>
                            <div class="invoice-address">
                                <span>สังกัดหน่วยงาน : </span>
                                <span>GAd-2002-056</span>
                            </div>
                            <div class="invoice-address">
                                <span>ชื่อกระบวนการ/งานที่ถูกปรับปรุง : </span>
                                <span>{{ $v_act_name }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>วัตถุประสงค์ในการปรับปรุง : </span>
                                <span>{{ $v_act_purpose }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>เครื่องมือที่ใช้ในการปรับปรุง : </span>
                                <span>{{ $v_act_tool }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>ระยะเวลาดำเนินการ : </span>
                                <span>{{ $v_act_startdate }} ถึง {{ $v_act_enddate }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>ที่ปรึกษา : </span>
                                <span>{{ $v_member_c }} {{ $v_member_name_c }}</span>
                            </div>
                        </div>
                        <div class="col m6 s12">
                            {{-- <div class="divider show-on-small hide-on-med-and-up mb-3"></div> --}}
                            <h6 class="invoice-to">Team</h6>
                            <div class="invoice-address">
                                <span>หัวหน้ากลุ่ม : </span>
                                <span>{{ $v_member_h }} {{ $v_member_name_h }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>สมาชิก 1 : </span>
                                <span>{{ $v_member_m2 }} {{ $v_member_name_m2 }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>สมาชิก 2 : </span>
                                <span>{{ $v_member_m3 }} {{ $v_member_name_m3 }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>สมาชิก 3 : </span>
                                <span>{{ $v_member_m4 }} {{ $v_member_name_m4 }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>สมาชิก 4 : </span>
                                <span>{{ $v_member_m5 }} {{ $v_member_name_m5 }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>สมาชิก 5 : </span>
                                <span>{{ $v_member_m6 }} {{ $v_member_name_m6 }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="divider mb-3 mt-3"></div>

                    <div class="row mt-3">
                        <div class="col l12 m12 s12">
                            <p class="center-align">1. การค้นหาปัญหา/ประเด็นการปรับปรุง (15 คะแนน)</p>
                            <br>
                            <p class="center-align">สภาพก่อนการปรับปรุง (คะแนนที่ได้..........)</p>
                            <p>{{ $v_before_fix }}</p>
                            <br>
                            <p class="center-align">เป้าหมายหลักที่ต้องการปรับปรุง (ตัวชี้วัด) (คะแนนที่ได้..........)</p>
                            <p>{{ $v_indicator }}</p>
                            {{-- <br><br><br> --}}
                            <br>
                            <p class="center-align">2. วิธีการหรือแนวทางในการแก้ปัญหา/ยกระดับงาน (30 คะแนน)</p>
                        </div>
                    </div>
                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m6 s12">
                            <br>
                            <div class="invoice-address">
                                <p class="center-align">กรอบแนวคิดในการปรับปรุง (คะแนนที่ได้..........)</p>
                                <p>{{ $v_conceptual_framework }}</p>
                            </div>
                        </div>
                        <div class="col m6 s12">
                            <br>
                            <div class="invoice-address">
                                <p class="center-align">หลักการ (ทฤษฎี) ที่รองรับกรอบแนวคิด (คะแนนที่ได้..........)</p>
                                <p>{{ $v_theory }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l12 m12 s12">
                            <p class="center-align">วิธีการปรับปรุงตามกรอบแนวคิด (คะแนนที่ได้..........)</p>
                            <p>{{ $v_conceptual_framework_approach }}</p>
                        </div>
                    </div>

                    <!-- invoice subtotal -->
                    <div class="divider mt-3 mb-3"></div>

                    <div class="row mt-3">
                        <div class="col l12 m12 s12">
                            <p class="center-align">3. ผลลัพธ์ที่เกิดขึ้น/ประโยชน์ที่ กฟผ. ได้รับ (40 คะแนน)</p>
                            <br>
                            <p class="center-align">ตรวจสอบผลการปรับปรุง (คะแนนที่ได้..........)</p>
                            <p>{{ $v_results_based_monitoring }}</p>
                            <br>
                            <p class="center-align">สภาพหลังการปรับปรุง</p>
                            <p>{{ $v_after_fix }}</p>
                        </div>
                    </div>
                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m6 s12">
                            <br>
                            <div class="invoice-address">
                                <p class="center-align">ผลที่ได้เทียบกับเป้าหมายหลัก (คะแนนที่ได้..........)</p>
                                <p>{{ $v_result_vs_goal }}</p>
                            </div>
                        </div>
                        <br>
                        <div class="col m6 s12">
                            <div class="invoice-address">
                                <p>ลดค่าใช้จ่าย {{ $v_reduced_cost }} บาท/ปี</p>
                                <span>คำอธิบาย (ถ้ามี) : </span>
                                <span>{{ $v_reduced_cost_desc }}</span>
                            </div>
                            <div class="invoice-address">
                                <p>เพิ่มความพร้อมจ่าย {{ $v_available_capacity_improvement }} %/ปี</p>
                                <span>คำอธิบาย (ถ้ามี) : </span>
                                <span>{{ $v_available_capacity_improvement_desc }}</span>
                            </div>
                            <div class="invoice-address">
                                <p>เพิ่มประสิทธิภาพ {{ $v_increase_efficiency }}%/ปี</p>
                                <span>คำอธิบาย (ถ้ามี) : </span>
                                <span>{{ $v_increase_efficiency_desc }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row invoice-info">
                        <div class="col m6 s12">
                            <br>
                            <div class="invoice-address">
                                <p class="center-align">ผลต่อผู้มีส่วนได้ส่วนเสีย (คะแนนที่ได้..........)</p>
                                &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;<small>(องค์กร ผู้ปฏิบัติงาน ลูกค้า สังคม)</small>
                                <p>{{ $v_stakeholder_fx }}</p>
                            </div>
                        </div>
                        <br>
                        <div class="col m6 s12">
                            <div class="invoice-address">
                                <p>ประหยัดค่าวัสดุอุปกรณ์ {{ $v_reduced_mat_cost }} บาท/ปี</p>
                            </div>
                            <div class="invoice-address">
                                <p>ประหยัดเวลา/แรงงาน {{ $v_reduced_man_day }} บาท/ปี</p>
                            </div>
                            <div class="invoice-address">
                                <p>ประหยัดค่าพลังงาน {{ $v_reduced_enegy_cost }} บาท/ปี</p>
                            </div>
                            <div class="invoice-address">
                                <p>ลดอุบัติเหตุด้านบุคคล {{ $v_reduced_worker_accident }} ราย/ปี</p>
                            </div>
                            <div class="invoice-address">
                                <p>ลดอุบัติ/ความเสียหายด้านทรัพย์สิน {{ $v_reduced_asset_accident }} บาท/ปี</p>
                            </div>
                            <div class="invoice-address">
                                <p>ความพึงพอใจที่เพิ่มขึ้น {{ $v_satisfaction }}%</p>
                            </div>
                            <div class="invoice-address">
                                <p>สิ่งประดิษฐ์ {{ $v_innovation }}%</p>
                            </div>
                            <div class="invoice-address">
                                <p>อื่น ๆ {{ $v_other_stakeholder_fx }} บาท/ปี</p>
                            </div>
                        </div>
                    </div>

                    <div class="divider mt-3 mb-3"></div>

                    <div class="row mt-3">
                        <div class="col l12 m12 s12">
                            <p class="center-align">4. ความเป็นไปได้ของการขยายผล <small>(เป็น Innovation/Best Practice)</small> (15 คะแนน)</p>
                            <br>
                            <p class="center-align">มีกระบวนการทำงานใหม่/ชิ้นงานใหม่/สิ่งประดิษฐ์ใหม่/เครื่องมือใหม่ และ มาตรฐานใหม่ (คะแนนที่ได้..........)</p>
                            <p>{{ $v_follow_up1 }}</p>
                            <br>
                            <p class="center-align">ผลงานมีแนวโน้มต่อยอดเป็นนวัตกรรม (คะแนนที่ได้..........)</p>
                            <p>{{ $v_follow_up2 }}</p>
                            <br>
                            <p class="center-align">มีแผนงาน และข้อมูลติดตามผลการรักษามาตรฐาน (คะแนนที่ได้..........)</p>
                            <p>{{ $v_follow_up3 }}</p>
                            <br>
                            <p class="center-align">มีศักยภาพสามารถขยายผลในสายงาน หรือข้ามสายงาน (คะแนนที่ได้..........)</p>
                            <p>{{ $v_follow_up4 }}</p>
                        </div>
                    </div>

                    <div class="divider mt-3 mb-3"></div>

                    <div class="row mt-3">
                        {{-- <div class="col l12 m12 s12"> --}}
                        <div class="col">
                            &emsp;&ensp;&ensp;&ensp;<span>จึงเรียนมาเพื่อโปรดพิจารณา</span>
                            <br>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span>ลงนามหัวหน้ากลุ่ม/บุคคล ........................................</span>
                            <br>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<small>({{ $v_member_name_h }})</small>
                            <br>
                            <br>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<span>ลงนามผู้อำนวยการฝ่าย ........................................</span>
                            <div class="col push-l12">
                                <p><label><input type="checkbox"><span>เห็นชอบ</span></label></p>
                                <p><label><input type="checkbox"><span>ไม่เห็นชอบ</span></label></p>
                            </div>
                            <br>
                            {{-- &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<small>(.................................................)</small> --}}
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<small>(.................................................)</small>
                            <br>
                            <br>
                            <small><font style="color:gray;">* หมายเหตุ 1. หากเห็นชอบรวบรวมเอกสารเสนอตามโครงสายบังคับบัญชาระดับรองผู้ว่าการ</font></small>
                            <br>
                            &emsp;&emsp;&ensp;&nbsp;&nbsp;&nbsp;&nbsp;<small><font style="color:gray;">2. คะแนนที่ได้หมายถึงคะแนนที่กรรมการเป็นผู้ลงคะแนน</font></small>
                            <br>
                            <br>
                            <span>สำเนา .............................................</span>
                        </div>
                    </div>

                </div><!-- Close Print area  -->
            </div>
        </div>
        <!-- invoice action  -->
        <div class="col xl3 m4 s12">
            <div class="card invoice-action-wrapper">
                <div class="card-content">
                    <div class="invoice-action-btn">
                        {{-- <a href="#" class="btn indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                            <i class="material-icons mr-4">check</i>
                            <span class="text-nowrap">Send Invoice</span>
                        </a> --}}
                    </div>
                    <div class="invoice-action-btn">
                        <a href="#" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
                            <i class="mdi mdi-printer" style="margin-top: -7px;"></i>
                            <span>Print</span>
                        </a>
                    </div>
                    <div class="invoice-action-btn">
                        @if($edit_module == 'enable' || session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
                            <a href="{{ URL::to('page-qcc-edit/'.$v_group_yr.'/'.$v_groupid) }}" class="btn-block btn btn-light-amber waves-effect waves-light">
                                <i class="mdi mdi-file-edit" style="margin-top: -7px;"></i>
                                <span>Edit</span>
                            </a>
                        @else
                            <a onclick="editDisableFunction();" class="btn-block btn btn-light-grey waves-effect waves-light">
                                <i class="mdi mdi-file-edit" style="margin-top: -7px;"></i>
                                <span>Edit</span>
                            </a>
                        @endif
                    </div>
                    <div class="invoice-action-btn">
                        {{-- <a href="#" class="btn waves-effect waves-light display-flex align-items-center justify-content-center">
                            <i class="material-icons mr-3">attach_money</i>
                            <span class="text-nowrap">Add Payment</span>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/app-invoice.js')}}"></script>

<script>
// START SweetAlert2 Notification for Disabled Module
function editDisableFunction() {
    swal({
        title: 'ระบบไม่เปิดให้แก้ไขข้อมูลได้ในขณะนี้',
        icon: 'warning'
    })
};
// END SweetAlert2 Notification for Disabled Module
</script>
@endsection
