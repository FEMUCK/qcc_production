@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','QCC Form Edit')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-wizard.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
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
            $v_act_purpose_remark = $qccdetail_item->act_purpose_remark;
            $v_act_tool_id = $qccdetail_item->act_tool_id;
            $v_act_tool_remark = $qccdetail_item->act_tool_remark;
            $v_act_cat_id = $qccdetail_item->act_cat_id;
            $v_attachment_url = $qccdetail_item->attachment_url;

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

            $km_main_knowledge1 = $qccdetail_item->km_main_knowledge1;
            $km_sub_knowledge1 = $qccdetail_item->km_sub_knowledge1;
            $knowledge_used1 = $qccdetail_item->knowledge_used1;
            $knowledge_format1 = $qccdetail_item->knowledge_format1;
            $other_knowledge_format1 = $qccdetail_item->other_knowledge_format1;
            $knowledge_reference1 = $qccdetail_item->knowledge_reference1;

            $km_main_knowledge2 = $qccdetail_item->km_main_knowledge2;
            $km_sub_knowledge2 = $qccdetail_item->km_sub_knowledge2;
            $knowledge_used2 = $qccdetail_item->knowledge_used2;
            $knowledge_format2 = $qccdetail_item->knowledge_format2;
            $other_knowledge_format2 = $qccdetail_item->other_knowledge_format2;
            $knowledge_reference2 = $qccdetail_item->knowledge_reference2;

            $km_main_knowledge3 = $qccdetail_item->km_main_knowledge3;
            $km_sub_knowledge3 = $qccdetail_item->km_sub_knowledge3;
            $knowledge_used3 = $qccdetail_item->knowledge_used3;
            $knowledge_format3 = $qccdetail_item->knowledge_format3;
            $other_knowledge_format3 = $qccdetail_item->other_knowledge_format3;
            $knowledge_reference3 = $qccdetail_item->knowledge_reference3;
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

            $v_act_pass_to_present_round = $qccdetail_item->act_pass_to_present_round;
            $v_act_prize_id = $qccdetail_item->act_prize_id;
            $v_act_prize_order = $qccdetail_item->act_prize_order;

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

        $km_main_knowledge1 = '';
        $km_sub_knowledge1 = '';
        $knowledge_used1 = '';
        $knowledge_format1 = '';
        $other_knowledge_format1 = '';
        $knowledge_reference1 = '';

        $km_main_knowledge2 = '';
        $km_sub_knowledge2 = '';
        $knowledge_used2 = '';
        $knowledge_format2 = '';
        $other_knowledge_format2 = '';
        $knowledge_reference2 = '';

        $km_main_knowledge3 = '';
        $km_sub_knowledge3 = '';
        $knowledge_used3 = '';
        $knowledge_format3 = '';
        $other_knowledge_format3 = '';
        $knowledge_reference3 = '';

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

        $v_act_pass_to_present_round = '';
        $v_act_prize_id = '';
        $v_act_prize_order = '';

        $employeedata_fay = '';
    }
?>

<!-- app invoice View Page -->
<section class="invoice-edit-wrapper section">
    <div class="row px-36">

        <div class="col xl9 m8 s12">
            <ul class="collapsible popout">
                <li class="active"><!-- Profile -->
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-account-details" style="margin-top: -7px;"></i>Profile</div>
                    <div class="collapsible-body white" style="display: block;">
                        <div class="row mb-3">
                            <form name='qccEditForm' id="qccEditForm" method='POST' action="{{ route('editqcc')}}">
                                @csrf
                                <input type="hidden" name="v_group_yr" value="{{ $v_group_yr }}">
                                {{-- <input type="hidden" name="v_respondant_fay" value="">
                                <input type="hidden" name="v_respondant_clong" value="">
                                <input type="hidden" name="v_respondant_long" value=""> --}}

                            <div class="input-field col xl4 m12 display-flex align-items-center">
                                <label for="v_groupid">เลขที่กลุ่ม#</label>
                                <input type="text" id="v_groupid" name="v_groupid" value="{{ $v_groupid }}" readonly>
                            </div>
                            <div class="col xl8 m12">
                                <div class="invoice-date-picker display-flex align-items-center">
                                    <div class="display-flex align-items-center">
                                        <small>สังกัดหน่วยงาน : </small>
                                        <div class="display-flex ml-4">
                                            <input type="text" id="v_respondant_fay" name="v_respondant_fay" value="{{ $employeedata_fay }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <label for="v_act_name">ชื่อกระบวนการ/งานที่ถูกปรับปรุง : <span class="red-text">*</span></label>
                                <input type="text" id="v_act_name" name="v_act_name" class="validate" value="{{ $v_act_name }}" required>
                            </div>
                            <div class="input-field col m3 s3">
                                <i class="mdi mdi-calendar-month-outline prefix"></i>
                                <label for="v_act_startdate">วันที่เริ่มต้น : <span class="red-text">*</span></label>
                                <input type="text" id="v_act_startdate" name="v_act_startdate" class="datepicker" value="{{ $v_act_startdate }}" required>
                            </div>
                            <div class="input-field col m3 s3">
                                <i class="mdi mdi-calendar-month-outline prefix"></i>
                                <label for="v_act_enddate">วันที่สิ้นสุด : <span class="red-text">*</span></label>
                                <input type="text" id="v_act_enddate" name="v_act_enddate" class="datepicker" value="{{ $v_act_enddate }}" required>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Basic Select2 วัตถุประสงค์ในการปรับปรุง --}}
                            <div class="input-field col m3 s3">
                                <select class="select2 browser-default" id="v_act_purpose" name="v_act_purpose">
                                    <option value="" selected disabled>วัตถุประสงค์ในการปรับปรุง : </option>
                                        @foreach($data['actpurpose'] as $actpurpose)
                                            @if($v_act_purpose_id ==  $actpurpose->act_purpose_id )
                                                <option value='{{ $actpurpose->act_purpose_id }}' selected>{{ $actpurpose->act_purpose }}</option>
                                            @else
                                                <option value='{{ $actpurpose->act_purpose_id }}'>{{ $actpurpose->act_purpose }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="input-field col m3 s3">
                                <label for="v_act_purpose_remark">วัตถุประสงค์ในการปรับปรุงอื่น ๆ : </label>
                                <input type="text" class="validate" id="v_act_purpose_remark" name="v_act_purpose_remark" value="{{ $v_act_purpose_remark }}">
                            </div>
                            {{-- Basic Select2 เครื่องมือที่ใช้ในการปรับปรุง --}}
                            <div class="input-field col m3 s3">
                                <select class="select2 browser-default" id="v_act_tool" name="v_act_tool">
                                    <option value="" selected disabled>เครื่องมือที่ใช้ในการปรับปรุง : </option>
                                        @foreach($data['acttool'] as $acttool)
                                            @if($v_act_tool_id ==  $acttool->act_tool_id )
                                                <option value='{{ $acttool->act_tool_id }}' selected>{{ $acttool->act_tool }}</option>
                                            @else
                                                <option value='{{ $acttool->act_tool_id }}'>{{ $acttool->act_tool }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="input-field col m3 s3">
                                <label for="v_act_tool_remark">เครื่องมือที่ใช้ในการปรับปรุงอื่น ๆ : </label>
                                <input type="text" class="validate" id="v_act_tool_remark" name="v_act_tool_remark" value="{{ $v_act_tool_remark }}">
                            </div>
                        </div>

                        <div class="row">
                            {{-- Basic Select2 ประเภทผลงาน --}}
                            <div class="input-field col m3 s3">
                                <select class="select2 browser-default" id="v_act_cat" name="v_act_cat">
                                    <option value="" selected disabled>ประเภทผลงาน : </option>
                                        @foreach($data['actcat'] as $actcat)
                                            @if($v_act_cat_id ==  $actcat->act_cat_id )
                                                <option value='{{ $actcat->act_cat_id }}' selected>{{ $actcat->act_cat }}</option>
                                            @else
                                                <option value='{{ $actcat->act_cat_id }}'>{{ $actcat->act_cat }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="input-field col m3 s3">
                                <i class="mdi mdi-link-variant prefix"></i>
                                <label for="v_attachment_url">URL ECP เอกสาร : </label>
                                <textarea type="text" id="v_attachment_url" name="v_attachment_url" rows="4" class="materialize-textarea">{{ $v_attachment_url }}</textarea>
                            </div>
                            <div class="input-field col s3">
                                <i class="mdi mdi-head-lightbulb-outline prefix"></i>
                                <input id="v_member_c" name="v_member_c" type="text" class="validate" value="{{ $v_member_c }}" required>
                                <label for="v_member_c">ที่ปรึกษา<font color="red">*</font></label>
                            </div>
                            <div class="input-field col s3">
                                <input disabled id="v_member_name_c" name="v_member_name_c" type="text" class="validate" value="{{ $v_member_name_c }}">
                                <label for="v_member_name_c">ชื่อ - สกุล</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s3">
                                <i class="mdi mdi-head-cog-outline prefix"></i>
                                <input id="v_member_h" name="v_member_h" type="text" class="validate" value="{{ $v_member_h }}" required>
                                <label for="v_member_h">หัวหน้ากลุ่ม<font color="red">*</font></label>
                            </div>
                            <div class="input-field col s3">
                                <input disabled id="v_member_name_h" name="v_member_name_h" type="text" class="validate" value="{{ $v_member_name_h }}">
                                <label for="v_member_name_h">ชื่อ - สกุล</label>
                            </div>

                            <div class="input-field col s3">
                                <i class="mdi mdi-account-outline prefix"></i>
                                <input id="v_member_m2" name="v_member_m2" type="text" class="validate" value="{{ $v_member_m2 }}">
                                <label for="v_member_m2">สมาชิก 1</label>
                            </div>
                            <div class="input-field col s3">
                                <input disabled id="v_member_name_m2" name="v_member_name_m2" type="text" class="validate" value="{{ $v_member_name_m2 }}">
                                <label for="v_member_name_m2">ชื่อ - สกุล</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <i class="mdi mdi-account-outline prefix"></i>
                                <input id="v_member_m3" name="v_member_m3" type="text" class="validate" value="{{ $v_member_m3 }}">
                                <label for="v_member_m3">สมาชิก 2</label>
                            </div>
                            <div class="input-field col s3">
                                <input disabled id="v_member_name_m3" name="v_member_name_m3" type="text" class="validate" value="{{ $v_member_name_m3 }}">
                                <label for="v_member_name_m3">ชื่อ - สกุล</label>
                            </div>

                            <div class="input-field col s3">
                                <i class="mdi mdi-account-outline prefix"></i>
                                <input id="v_member_m4" name="v_member_m4" type="text" class="validate" value="{{ $v_member_m4 }}">
                                <label for="v_member_m4">สมาชิก 3</label>
                            </div>
                            <div class="input-field col s3">
                                <input disabled id="v_member_name_m4" name="v_member_name_m4" type="text" class="validate" value="{{ $v_member_name_m4 }}">
                                <label for="v_member_name_m4">ชื่อ - สกุล</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <i class="mdi mdi-account-outline prefix"></i>
                                <input id="v_member_m5" name="v_member_m5" type="text" class="validate" value="{{ $v_member_m5 }}">
                                <label for="v_member_m5">สมาชิก 4</label>
                            </div>
                            <div class="input-field col s3">
                                <input disabled id="v_member_name_m5" name="v_member_name_m5" type="text" class="validate" value="{{ $v_member_name_m5 }}">
                                <label for="v_member_name_m5">ชื่อ - สกุล</label>
                            </div>

                            <div class="input-field col s3">
                                <i class="mdi mdi-account-outline prefix"></i>
                                <input id="v_member_m6" name="v_member_m6" type="text" class="validate" value="{{ $v_member_m6 }}">
                                <label for="v_member_m6">สมาชิก 5</label>
                            </div>
                            <div class="input-field col s3">
                                <input disabled id="v_member_name_m6" name="v_member_name_m6" type="text" class="validate" value="{{ $v_member_name_m6 }}">
                                <label for="v_member_name_m6">ชื่อ - สกุล</label>
                            </div>
                        </div>
                    </div>
                </li>
                <li class=""><!-- Plan -->
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-file-document" style="margin-top: -7px;"></i>Plan</div>
                    <div class="collapsible-body white" style="">
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <p><strong>1. การค้นหาปัญหา/ประเด็นการปรับปรุง</strong></p>
                            </div>
                            <div class="input-field col m6 s12">
                                <p><strong>2. วิธีการหรือแนวทางในการแก้ปัญหา/ยกระดับงาน</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <label for="v_before_fix">1.1 สภาพก่อนปรับปรุงและประเด็นในการปรับปรุง : <span class="red-text">*</span></label>
                                <textarea name="v_before_fix" id="v_before_fix" rows="4" type="text" class="materialize-textarea" required>{{ $v_before_fix }}</textarea>
                            </div>
                            <div class="input-field col m6 s12">
                                <label for="v_conceptual_framework">2.1 กรอบแนวคิดในการปรับปรุง : <span class="red-text">*</span></label>
                                <textarea name="v_conceptual_framework" id="v_conceptual_framework" rows="4" type="text" class="materialize-textarea" required>{{ $v_conceptual_framework }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <label for="v_indicator">1.2 เป้าหมายหลักที่ต้องการปรับปรุง (ตัวชี้วัด) : <span class="red-text">*</span></label>
                                <textarea name="v_indicator" id="v_indicator" rows="4" type="text" class="materialize-textarea" required>{{ $v_indicator }}</textarea>
                            </div>
                            <div class="input-field col m6 s12">
                                <label for="v_theory">2.2 หลักการ (ทฤษฎี) ที่รองรับกรอบแนวคิด : <span class="red-text">*</span></label>
                                <textarea name="v_theory" id="v_theory" rows="4" type="text" class="materialize-textarea" required>{{ $v_theory }}</textarea>
                            </div>
                        </div>
                    </div>
                </li>


                <li class=""><!-- Knowledge -->
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-lightbulb-on" style="margin-top: -7px;"></i>Knowledge</div>
                    <div class="collapsible-body white" style="">
						<div class="row">
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="km_main_knowledge1" name="km_main_knowledge1" required>
                                    <option value="" selected disabled>เลือกหมวดหมู่ความรู้หลัก1 : </option>
                                    @foreach($data['mainknowledgelist'] as $mainknowledgelist_item)
                                        {{ $checked = '' }}
                                        @if($km_main_knowledge1 == $mainknowledgelist_item->mainknowledgeid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $mainknowledgelist_item->mainknowledgeid }}' {{ $checked }}>{{ $mainknowledgelist_item->mainknowledge_name }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="km_sub_knowledge1" name="km_sub_knowledge1" required>
                                    <option value="" selected disabled>เลือกหมวดหมู่ความรู้รอง1 : </option>
                                    @foreach($data['subknowledgelist1'] as $subknowledgelist_item)
                                        {{ $checked = '' }}
                                        @if($km_sub_knowledge1 == $subknowledgelist_item->subknowledgeid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $subknowledgelist_item->subknowledgeid }}' {{ $checked }}>{{ $subknowledgelist_item->subknowledgename }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l6 m6 s6">
								<i class="mdi mdi-lightbulb-on-outline prefix"></i>
								<input id="knowledge_used1" name="knowledge_used1" type="text" class="validate" value="{{ $knowledge_used1 }}" required>
								<label for="knowledge_used1">ระบุชื่อเรื่องความรู้ที่นำมาใช้1<font color="red">*</font></label>
                            </div>
                        </div>
                        <div class="row">
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="knowledge_format1" name="knowledge_format1" required>
                                    <option value="" selected disabled>เลือกรูปแบบของความรู้1 : </option>
                                    @foreach($data['knowledgeformatlist'] as $knowledgeformatlist_item)
                                        {{ $checked = '' }}
                                        @if($knowledge_format1 == $knowledgeformatlist_item->knowledgeformatid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $knowledgeformatlist_item->knowledgeformatid }}' {{ $checked }}>{{ $knowledgeformatlist_item->knowledgeformat_name }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l4 m4 s4">
								<input id="other_knowledge_format1" name="other_knowledge_format1" type="text" value="{{ $other_knowledge_format1 }}" disabled>
								<label for="other_knowledge_format1">อื่นๆ (โปรดระบุ)1</label>
							</div>
							<div class="input-field col l5 m5 s5">
								<i class="mdi mdi-source-branch prefix"></i>
								<input id="knowledge_reference1" name="knowledge_reference1" type="text" class="validate" value="{{ $knowledge_reference1 }}" required>
								<label for="knowledge_reference1">แหล่งอ้างอิง1<font color="red">*</font></label>
							</div>
                        </div>

                        <div class="divider mt-3 mb-3"></div>

						<div class="row">
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="km_main_knowledge2" name="km_main_knowledge2">
                                    <option value="" selected disabled>เลือกหมวดหมู่ความรู้หลัก2 : </option>
                                    @foreach($data['mainknowledgelist'] as $mainknowledgelist_item)
                                        {{ $checked = '' }}
                                        @if($km_main_knowledge2 == $mainknowledgelist_item->mainknowledgeid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $mainknowledgelist_item->mainknowledgeid }}' {{ $checked }}>{{ $mainknowledgelist_item->mainknowledge_name }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="km_sub_knowledge2" name="km_sub_knowledge2">
                                    <option value="" selected disabled>เลือกหมวดหมู่ความรู้รอง2 : </option>
                                    @foreach($data['subknowledgelist2'] as $subknowledgelist_item)
                                        {{ $checked = '' }}
                                        @if($km_sub_knowledge2 == $subknowledgelist_item->subknowledgeid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $subknowledgelist_item->subknowledgeid }}' {{ $checked }}>{{ $subknowledgelist_item->subknowledgename }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l6 m6 s6">
								<i class="mdi mdi-lightbulb-on-outline prefix"></i>
								<input id="knowledge_used2" name="knowledge_used2" type="text" value="{{ $knowledge_used2 }}">
								<label for="knowledge_used2">ระบุชื่อเรื่องความรู้ที่นำมาใช้2</label>
                            </div>
                        </div>
                        <div class="row">
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="knowledge_format2" name="knowledge_format2">
                                    <option value="" selected disabled>เลือกรูปแบบของความรู้2 : </option>
                                    @foreach($data['knowledgeformatlist'] as $knowledgeformatlist_item)
                                        {{ $checked = '' }}
                                        @if($knowledge_format2 == $knowledgeformatlist_item->knowledgeformatid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $knowledgeformatlist_item->knowledgeformatid }}' {{ $checked }}>{{ $knowledgeformatlist_item->knowledgeformat_name }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l4 m4 s4">
								<input id="other_knowledge_format2" name="other_knowledge_format2" type="text" value="{{ $other_knowledge_format2 }}" disabled>
								<label for="other_knowledge_format2">อื่นๆ (โปรดระบุ)2</label>
							</div>
							<div class="input-field col l5 m5 s5">
								<i class="mdi mdi-source-branch prefix"></i>
								<input id="knowledge_reference2" name="knowledge_reference2" type="text" value="{{ $knowledge_reference2 }}">
								<label for="knowledge_reference2">แหล่งอ้างอิง2</label>
							</div>
                        </div>


                        <div class="divider mt-3 mb-3"></div>

						<div class="row">
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="km_main_knowledge3" name="km_main_knowledge3">
                                    <option value="" selected disabled>เลือกหมวดหมู่ความรู้หลัก3 : </option>
                                    @foreach($data['mainknowledgelist'] as $mainknowledgelist_item)
                                        {{ $checked = '' }}
                                        @if($km_main_knowledge3 == $mainknowledgelist_item->mainknowledgeid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $mainknowledgelist_item->mainknowledgeid }}' {{ $checked }}>{{ $mainknowledgelist_item->mainknowledge_name }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="km_sub_knowledge3" name="km_sub_knowledge3">
                                    <option value="" selected disabled>เลือกหมวดหมู่ความรู้รอง3 : </option>
                                    @foreach($data['subknowledgelist3'] as $subknowledgelist_item)
                                        {{ $checked = '' }}
                                        @if($km_sub_knowledge3 == $subknowledgelist_item->subknowledgeid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $subknowledgelist_item->subknowledgeid }}' {{ $checked }}>{{ $subknowledgelist_item->subknowledgename }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l6 m6 s6">
								<i class="mdi mdi-lightbulb-on-outline prefix"></i>
								<input id="knowledge_used3" name="knowledge_used3" type="text" value="{{ $knowledge_used3 }}">
								<label for="knowledge_used3">ระบุชื่อเรื่องความรู้ที่นำมาใช้3</label>
                            </div>
                        </div>
                        <div class="row">
							<div class="input-field col l3 m3 s3">
								<select class="select2 browser-default" id="knowledge_format3" name="knowledge_format3">
                                    <option value="" selected disabled>เลือกรูปแบบของความรู้3 : </option>
                                    @foreach($data['knowledgeformatlist'] as $knowledgeformatlist_item)
                                        {{ $checked = '' }}
                                        @if($knowledge_format3 == $knowledgeformatlist_item->knowledgeformatid)
                                            {{ $checked = "selected" }}
                                        @endif
                                        <option value='{{ $knowledgeformatlist_item->knowledgeformatid }}' {{ $checked }}>{{ $knowledgeformatlist_item->knowledgeformat_name }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="input-field col l4 m4 s4">
								<input id="other_knowledge_format3" name="other_knowledge_format3" type="text" value="{{ $other_knowledge_format3 }}" disabled>
								<label for="other_knowledge_format3">อื่นๆ (โปรดระบุ)3</label>
							</div>
							<div class="input-field col l5 m5 s5">
								<i class="mdi mdi-source-branch prefix"></i>
								<input id="knowledge_reference3" name="knowledge_reference3" type="text" value="{{ $knowledge_reference3 }}">
								<label for="knowledge_reference3">แหล่งอ้างอิง3</label>
							</div>
                        </div>

                    </div>
                </li>



                <li class=""><!-- Do -->
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-file-document-edit" style="margin-top: -7px;"></i>Do</div>
                    <div class="collapsible-body white" style="">
                        <div class="row">
                            <div class="input-field col m12 s12">
                                <label for="v_conceptual_framework_approach">วิธีการปรับปรุงตามกรอบแนวคิด : <span class="red-text">*</span></label>
                                <textarea name="v_conceptual_framework_approach" id="v_conceptual_framework_approach" rows="4" type="text" class="materialize-textarea" required>{{ $v_conceptual_framework_approach }}</textarea>
                            </div>
                        </div>
                    </div>
                </li>
                <li class=""><!-- Check -->
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-file-eye" style="margin-top: -7px;"></i>Check</div>
                    <div class="collapsible-body white" style="">
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <p>
                                    <strong>3. ผลลัพธ์ที่เกิดขึ้น /ประโยชน์ที่ กฟผ. ได้รับ</strong>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m12 s12">
                                <label for="v_results_based_monitoring">3.1 ตรวจสอบผลการปรับปรุง : <span class="red-text">*</span></label>
                                <textarea name="v_results_based_monitoring" id="v_results_based_monitoring" rows="4" type="text" class="materialize-textarea" required>{{ $v_results_based_monitoring }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m12 s12">
                                <label for="v_after_fix">3.2 สภาพหลังการปรับปรุง : <span class="red-text">*</span></label>
                                <textarea name="v_after_fix" id="v_after_fix" rows="4" type="text" class="materialize-textarea" required>{{ $v_after_fix }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m12 s12">
                                <label for="v_result_vs_goal">3.3 ผลที่ได้เทียบกับเป้าหมายหลัก : <span class="red-text">*</span></label>
                                <textarea name="v_result_vs_goal" id="v_result_vs_goal" rows="4" type="text" class="materialize-textarea" required>{{ $v_result_vs_goal }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <i class="mdi mdi-bitcoin prefix"></i>
                                <label for="v_reduced_cost">ลดค่าใช้จ่าย(บาท/ปี)</label>
                                <input id="v_reduced_cost" name="v_reduced_cost" type="text" class="validate" value="{{ $v_reduced_cost }}">
                            </div>
                            <div class="input-field col s3">
                                <label for="v_reduced_cost_desc">คำอธิบาย(ถ้ามี)</label>
                                <input id="v_reduced_cost_desc" name="v_reduced_cost_desc" type="text" class="validate" value="{{ $v_reduced_cost_desc }}">
                            </div>

                            <div class="input-field col s3">
                                <i class="material-icons prefix">network_check</i>
                                <label for="v_available_capacity_improvement">เพิ่มความพร้อมจ่าย(%/ปี)</label>
                                <input id="v_available_capacity_improvement" name="v_available_capacity_improvement" type="text" class="validate" value="{{ $v_available_capacity_improvement }}">
                            </div>
                            <div class="input-field col s3">
                                <label for="v_available_capacity_improvement_desc">คำอธิบาย(ถ้ามี)</label>
                                <input id="v_available_capacity_improvement_desc" name="v_available_capacity_improvement_desc" type="text" class="validate" value="{{ $v_available_capacity_improvement_desc }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <i class="mdi mdi-finance prefix"></i>
                                <label for="v_increase_efficiency">เพิ่มประสิทธิภาพ(%/ปี)</label>
                                <input id="v_increase_efficiency" name="v_increase_efficiency" type="text" class="validate" value="{{ $v_increase_efficiency }}">
                            </div>
                            <div class="input-field col s3">
                                <label for="v_increase_efficiency_desc">คำอธิบาย(ถ้ามี)</label>
                                <input id="v_increase_efficiency_desc" name="v_increase_efficiency_desc" type="text" class="validate" value="{{ $v_increase_efficiency_desc }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m12 s12">
                                <label for="v_stakeholder_fx">3.4 ผลต่อและผู้มีส่วนได้ส่วนเสีย (องค์กร ผู้ปฏิบัติงาน ลูกค้า สังคม) : <span class="red-text">*</span></label>
                                <textarea name="v_stakeholder_fx" id="v_stakeholder_fx" rows="4" type="text" class="materialize-textarea" required>{{ $v_stakeholder_fx }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                {{-- <i class="mdi mdi-fuse prefix"></i> --}}
                                <i class="mdi mdi-wall prefix"></i>
                                <label for="v_reduced_mat_cost"><small>ประหยัดค่าวัสดุอุปกรณ์(บาท/ปี)</small></label>
                                <input id="v_reduced_mat_cost" name="v_reduced_mat_cost" type="text" class="validate" value="{{ $v_reduced_mat_cost }}">
                            </div>
                            <div class="input-field col s3">
                                <i class="mdi mdi-clock-outline prefix"></i>
                                <label for="v_reduced_man_day"><small>ประหยัดเวลา/แรงงาน(บาท/ปี)</small></label>
                                <input id="v_reduced_man_day" name="v_reduced_man_day" type="text" class="validate" value="{{ $v_reduced_man_day }}">
                            </div>

                            <div class="input-field col s3">
                                <i class="mdi mdi-battery-charging-high prefix"></i>
                                <label for="v_reduced_enegy_cost"><small>ประหยัดค่าพลังงาน(บาท/ปี)</small></label>
                                <input id="v_reduced_enegy_cost" name="v_reduced_enegy_cost" type="text" class="validate" value="{{ $v_reduced_enegy_cost }}">
                            </div>
                            <div class="input-field col s3">
                                <i class="mdi mdi-account-alert prefix"></i>
                                <label for="v_reduced_worker_accident"><small>ลดอุบัติเหตุด้านบุคคล(ราย/ปี)</small></label>
                                <input id="v_reduced_worker_accident" name="v_reduced_worker_accident" type="text" class="validate" value="{{ $v_reduced_worker_accident }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <i class="mdi mdi-alert prefix"></i>
                                <label for="v_reduced_asset_accident"><small>ลดความเสียหายทรัพย์สิน(บาท/ปี)</small></label>
                                <input id="v_reduced_asset_accident" name="v_reduced_asset_accident" type="text" class="validate" value="{{ $v_reduced_asset_accident }}">
                            </div>
                            <div class="input-field col s3">
                                <i class="mdi mdi-account-star prefix"></i>
                                <label for="v_satisfaction"><small>ความพึงพอใจที่เพิ่มขึ้น(%)</small></label>
                                <input id="v_satisfaction" name="v_satisfaction" type="text" class="validate" value="{{ $v_satisfaction }}">
                            </div>
                            <div class="input-field col s3">
                                <i class="mdi mdi-lightbulb-on prefix"></i>
                                <label for="v_innovation"><small>สิ่งประดิษฐ์(%)</small></label>
                                <input id="v_innovation" name="v_innovation" type="text" class="validate" value="{{ $v_innovation }}">
                            </div>
                            <div class="input-field col s3">
                                <i class="mdi mdi-dots-horizontal-circle prefix"></i>
                                <label for="v_other_stakeholder_fx"><small>อื่นๆ(%)</small></label>
                                <input id="v_other_stakeholder_fx" name="v_other_stakeholder_fx" type="text" class="validate" value="{{ $v_other_stakeholder_fx }}">
                            </div>
                        </div>
                    </div>
                </li>
                <li class=""><!-- Act -->
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-file-cog" style="margin-top: -7px;"></i>Act</div>
                    <div class="collapsible-body white" style="">
                        <div class="row">
                            <div class="col m6 s12">
                                <p>
                                    <span>4. การขยายผล (เป็น Innovation / Best Practice)</span>
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>การติดตามผล / ความเป็นไปได้ในการขยายผล</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="v_follow_up1">4.1 มีกระบวนการทำงานใหม่/ชิ้นงานใหม่/สิ่งประดิษฐ์ใหม่/เครื่องมือใหม่ และ มาตรฐานใหม่ : <span class="red-text">*</span></label>
                                <textarea name="v_follow_up1" id="v_follow_up1" rows="4" type="text" class="materialize-textarea" required>{{ $v_follow_up1 }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="v_follow_up2">4.2 ผลงานมีแนวโน้มต่อยอดเป็นนวัตกรรม : <span class="red-text">*</span></label>
                                <textarea name="v_follow_up2" id="v_follow_up2" rows="4" type="text" class="materialize-textarea" required>{{ $v_follow_up2 }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="v_follow_up3">4.3 มีแผนงาน และข้อมูลติดตามผลการรักษามาตรฐาน : <span class="red-text">*</span></label>
                                <textarea name="v_follow_up3" id="v_follow_up3" rows="4" type="text" class="materialize-textarea" required>{{ $v_follow_up3 }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="v_follow_up4">4.4 มีศักยภาพสามารถขยายผลในสายงาน หรือข้ามสายงาน : <span class="red-text">*</span></label>
                                <textarea name="v_follow_up4" id="v_follow_up4" rows="4" type="text" class="materialize-textarea" required>{{ $v_follow_up4 }}</textarea>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Only for Admin update สำหรับแจ้งผลการผ่านเข้ารอบนำเสนอผลงาน, ระดับรางวัลของกิจกรรม เพื่อแสดงผลใน VIEW page-home -->
                @if(session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
                    <li class=""><!-- Admin -->
                        <div class="collapsible-header" tabindex="0"><i class="mdi mdi-account-tie" style="margin-top: -7px;"></i>Admin</div>
                        <div class="collapsible-body white" style="">
                            <div class="row">

                                <?php
                                    $pass = '';
                                    if ($v_act_pass_to_present_round == 'P') {
                                        $pass = "checked";
                                    }
                                ?>
                                <div class="input-field col m6 s12">
                                    <p>
                                        <label>
                                        <input type="checkbox" id="v_act_pass_to_present_round" name="v_act_pass_to_present_round" value="P" {{ $pass }}/>
                                            <span>ผ่านเข้ารอบการนำเสนอผลงานประจำปี {{ now()->year+543 }}</span>
                                        </label>
                                    </p>
                                </div>

                                {{-- Basic Select2 ระดับรางวัลของกิจกรรม --}}
                                <div class="input-field col m3 s6">
                                    <select class="select2 browser-default" id="v_act_prize" name="v_act_prize">
                                        <option value="" selected disabled>ระดับรางวัลของกิจกรรม : </option>
                                        <option value=''>Blank</option>
                                        @foreach($data['actprize'] as $actprize)
                                            @if($v_act_prize_id == $actprize->act_prize_id)
                                                <option value='{{ $actprize->act_prize_id }}' selected>{{ $actprize->act_prize }}</option>
                                            @else
                                                <option value='{{ $actprize->act_prize_id }}'>{{ $actprize->act_prize }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col m3 s6">
                                    <i class="mdi mdi-order-numeric-ascending prefix"></i>
                                    <label for="v_act_prize_order">อันดับรางวัลที่ได้รับ</label>
                                    <input id="v_act_prize_order" name="v_act_prize_order" type="text" class="validate" value="{{ $v_act_prize_id }}">
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

        <!-- form action  -->
        <div class="col xl3 m4 s12">
            <div class="card invoice-action-wrapper mb-10">
                <div class="card-content">
                    <div class="invoice-action-btn">
                        <a href="{{ URL::to('page-qcc-view/'.$v_group_yr.'/'.$v_groupid) }}" class="btn indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                            <i class="mdi mdi-file-eye mr-4"></i>
                            <span class="responsive-text">Preview</span>
                        </a>
                    </div>
                    {{-- <div class="invoice-action-btn">
                        <a class="btn btn-light-indigo btn-block waves-effect waves-light">
                            <span class="responsive-text">Download</span>
                        </a>
                    </div> --}}
                    <div class="invoice-action-btn">
                        {{-- <button class="btn btn-light-indigo btn-block waves-effect waves-light" type="submit" id="btn_update_qcc" name="btn_update_qcc"> --}}
                        @if($edit_module == 'enable' || session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
                            <button class="btn btn-block waves-effect waves-light" type="submit" id="btn_update_qcc" name="btn_update_qcc">
                                <i class="mdi mdi-content-save mr-3"></i>
                                <span class="responsive-text">Save</span>
                            </button>
                        @else
                            <button onclick="editDisableFunction();" class="btn btn-block waves-effect waves-light gradient-45deg-blue-grey-blue-grey tooltipped" data-position="bottom" data-tooltip="ระบบไม่เปิดให้เพิ่มข้อมูลได้ในขณะนี้" type="button" id="btn_update_qcc_disable" name="btn_update_qcc_disable">
                                <i class="mdi mdi-content-save mr-3"></i>
                                <span class="responsive-text">Save</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </form> <!-- CLOSE qccEditForm  -->
    </div>
</section>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/form_repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('vendors/igorescobar/jquery-mask-plugin/dist/jquery.mask.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/app-invoice.js')}}"></script>
<script src="{{asset('js/scripts/form-wizard.js')}}"></script>
<script src="{{asset('js/scripts/form-select2.js')}}"></script>
<script src="{{asset('js/scripts/extra-components-sweetalert.js')}}"></script>

<script>
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

// START Form Mask to format user input to match a specified pattern.
$('#v_member_c, #v_member_h, #v_member_m2, #v_member_m3, #v_member_m4, #v_member_m5, #v_member_m6').mask('000000');
$('#v_reduced_cost, #v_available_capacity_improvement, #v_increase_efficiency, #v_reduced_mat_cost, #v_reduced_man_day, #v_reduced_enegy_cost, #v_reduced_asset_accident, #v_satisfaction, #v_innovation, #v_other_stakeholder_fx').mask('#,##0.00', {reverse: true});
$('#v_reduced_worker_accident').mask('#,##0', {reverse: true});
$('#v_act_prize_order').mask('00', {reverse: true});
// END Form Mask to format user input to match a specified pattern.

// START สำหรับแสดง onkeyup ใน View : page-qcc-edit จะทำงานก็ต่อเมื่อความยาวตัวอักษร = 6 Source:https://stackoverflow.com/questions/33285622/jquery-trigger-event-based-on-form-input-length
$('#v_member_c').keyup(function() {
    var v_member_c = $(this).val();
    var v_member_c_lenght = $('#v_member_c').val().length;
    var url = '{{ url('usersdata') }}/' + v_member_c;
    if(v_member_c_lenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#v_member_name_c').val(value.users_fullname);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});

$('#v_member_h').keyup(function() {
    var v_member_h = $(this).val();
    var v_member_h_lenght = $('#v_member_h').val().length;
    var url = '{{ url('usersdata') }}/' + v_member_h;
    if(v_member_c_lenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#v_member_name_h').val(value.users_fullname);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});

$('#v_member_m2').keyup(function() {
    var v_member_m2 = $(this).val();
    var v_member_m2_lenght = $('#v_member_m2').val().length;
    var url = '{{ url('usersdata') }}/' + v_member_m2;
    if(v_member_m2_lenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#v_member_name_m2').val(value.users_fullname);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});

$('#v_member_m3').keyup(function() {
    var v_member_m3 = $(this).val();
    var v_member_m3_lenght = $('#v_member_m3').val().length;
    var url = '{{ url('usersdata') }}/' + v_member_m3;
    if(v_member_m3_lenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#v_member_name_m3').val(value.users_fullname);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});

$('#v_member_m4').keyup(function() {
    var v_member_m4 = $(this).val();
    var v_member_m4_lenght = $('#v_member_m4').val().length;
    var url = '{{ url('usersdata') }}/' + v_member_m4;
    if(v_member_m4_lenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#v_member_name_m4').val(value.users_fullname);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});

$('#v_member_m5').keyup(function() {
    var v_member_m5 = $(this).val();
    var v_member_m5_lenght = $('#v_member_m5').val().length;
    var url = '{{ url('usersdata') }}/' + v_member_m5;
    if(v_member_m5_lenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#v_member_name_m5').val(value.users_fullname);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});

$('#v_member_m6').keyup(function() {
    var v_member_m6 = $(this).val();
    var v_member_m6_lenght = $('#v_member_m6').val().length;
    var url = '{{ url('usersdata') }}/' + v_member_m6;
    if(v_member_m6_lenght = 6) {
        $.get(url, function (data) {
            $.each(data, function(key, value) {
                $('#v_member_name_m6').val(value.users_fullname);
                M.updateTextFields();
            });
        });
    }else {
        // not ok
    }
});
// END สำหรับแสดง onkeyup ใน View : page-qcc-edit จะทำงานก็ต่อเมื่อความยาวตัวอักษร = 6 Source:https://stackoverflow.com/questions/33285622/jquery-trigger-event-based-on-form-input-length

// START สำหรับ clear ค่าถ้าความยาวตัวอักษร idinput < 6 Event onkeyup ใน View : page-qcc-edit
$('#v_member_c').keyup(function() {
    var v_member_c = $(this).val();
    var v_member_c_lenght = $('#v_member_c').val().length;
    if(v_member_c_lenght < 6) {
        $('#v_member_name_c').val('');
        M.updateTextFields();
    }
});

$('#v_member_h').keyup(function() {
    var v_member_h = $(this).val();
    var v_member_h_lenght = $('#v_member_h').val().length;
    if(v_member_h_lenght < 6) {
        $('#v_member_name_h').val('');
        M.updateTextFields();
    }
});

$('#v_member_m2').keyup(function() {
    var v_member_m2 = $(this).val();
    var v_member_m2_lenght = $('#v_member_m2').val().length;
    if(v_member_m2_lenght < 6) {
        $('#v_member_name_m2').val('');
        M.updateTextFields();
    }
});

$('#v_member_m3').keyup(function() {
    var v_member_m3 = $(this).val();
    var v_member_m3_lenght = $('#v_member_m3').val().length;
    if(v_member_m3_lenght < 6) {
        $('#v_member_name_m3').val('');
        M.updateTextFields();
    }
});

$('#v_member_m4').keyup(function() {
    var v_member_m4 = $(this).val();
    var v_member_m4_lenght = $('#v_member_m4').val().length;
    if(v_member_m4_lenght < 6) {
        $('#v_member_name_m4').val('');
        M.updateTextFields();
    }
});

$('#v_member_m5').keyup(function() {
    var v_member_m5 = $(this).val();
    var v_member_m5_lenght = $('#v_member_m5').val().length;
    if(v_member_m5_lenght < 6) {
        $('#v_member_name_m5').val('');
        M.updateTextFields();
    }
});

$('#v_member_m6').keyup(function() {
    var v_member_m6 = $(this).val();
    var v_member_m6_lenght = $('#v_member_m6').val().length;
    if(v_member_m6_lenght < 6) {
        $('#v_member_name_m6').val('');
        M.updateTextFields();
    }
});
// END สำหรับ clear ค่าถ้าความยาวตัวอักษร idinput < 6 Event  onkeyup ใน View : page-qcc-edit

// START ไว้เรียกค่า Dependent Dropdown form DB VIEW : page-qcc-register
$('#km_main_knowledge1').change(function() {
    var km_main_knowledge1 = $("#km_main_knowledge1").val();
    var url = '{{ url('subknowledgelist') }}/' + km_main_knowledge1;
    $.get(url, function (data) {
        var km_sub_knowledge1 = $('#km_sub_knowledge1');
        km_sub_knowledge1.empty();
        km_sub_knowledge1.append("<option value='' disabled selected>เลือกหมวดหมู่ความรู้รอง1 :</option>");

        $.each(data, function(key, value) {
            km_sub_knowledge1.append("<option value='"+value.subknowledgeid +"'>" + value.subknowledgename + "</option>");
        });
    });
});

$('#km_main_knowledge2').change(function() {
    var km_main_knowledge2 = $("#km_main_knowledge2").val();
    var url = '{{ url('subknowledgelist') }}/' + km_main_knowledge2;
    $.get(url, function (data) {
        var km_sub_knowledge2 = $('#km_sub_knowledge2');
        km_sub_knowledge2.empty();
        km_sub_knowledge2.append("<option value='' disabled selected>เลือกหมวดหมู่ความรู้รอง2 :</option>");

        $.each(data, function(key, value) {
            km_sub_knowledge2.append("<option value='"+value.subknowledgeid +"'>" + value.subknowledgename + "</option>");
        });
    });
});

$('#km_main_knowledge3').change(function() {
    var km_main_knowledge3 = $("#km_main_knowledge3").val();
    var url = '{{ url('subknowledgelist') }}/' + km_main_knowledge3;
    $.get(url, function (data) {
        var km_sub_knowledge3 = $('#km_sub_knowledge3');
        km_sub_knowledge3.empty();
        km_sub_knowledge3.append("<option value='' disabled selected>เลือกหมวดหมู่ความรู้รอง3 :</option>");

        $.each(data, function(key, value) {
            km_sub_knowledge3.append("<option value='"+value.subknowledgeid +"'>" + value.subknowledgename + "</option>");
        });
    });
});
// END ไว้เรียกค่า Dependent Dropdown form DB VIEW : page-qcc-register

$("#knowledge_format1").change(function(){
    var knowledge_format1 = $("#knowledge_format1").val();
    if(knowledge_format1 == "9"){
        $('#other_knowledge_format1').removeAttr("disabled");
        $('#other_knowledge_format1').attr("required", "required");
    }else {
        $('#other_knowledge_format1').attr("disabled", "disabled");
        $('#other_knowledge_format1').removeAttr("required");
    }
});

$("#knowledge_format2").change(function(){
    var knowledge_format2 = $("#knowledge_format2").val();
    if(knowledge_format2 == "9"){
        $('#other_knowledge_format2').removeAttr("disabled");
        $('#other_knowledge_format2').attr("required", "required");
    }else {
        $('#other_knowledge_format2').attr("disabled", "disabled");
        $('#other_knowledge_format2').removeAttr("required");
    }
});

$("#knowledge_format3").change(function(){
    var knowledge_format3 = $("#knowledge_format3").val();
    if(knowledge_format3 == "9"){
        $('#other_knowledge_format3').removeAttr("disabled");
        $('#other_knowledge_format3').attr("required", "required");
    }else {
        $('#other_knowledge_format3').attr("disabled", "disabled");
        $('#other_knowledge_format3').removeAttr("required");
    }
});

// START Onload jQuery สำหรับตรวจสอบค่าตอน Load knowledge_format Enable other_knowledge_format input field VIEW :  page-qcc-edit
$(document).ready(function() {
    var knowledge_format1 = $("#knowledge_format1").val();
	if (knowledge_format1 == '9'){
        $('#other_knowledge_format1').removeAttr("disabled");
	}else if (coursetype == 'O'){
		$('#other_knowledge_format1').removeAttr("disabled");
	}

	var knowledge_format2 = $("#knowledge_format2").val();
	if (knowledge_format2 == '9'){
        $('#other_knowledge_format2').removeAttr("disabled");
	}else if (coursetype == 'O'){
		$('#other_knowledge_format2').removeAttr("disabled");
	}

	var knowledge_format3 = $("#knowledge_format3").val();
	if (knowledge_format3 == '9'){
        $('#other_knowledge_format3').removeAttr("disabled");
	}else if (coursetype == 'O'){
		$('#other_knowledge_format3').removeAttr("disabled");
	}
});
// END Onload jQuery สำหรับตรวจสอบค่าตอน Load knowledge_format Enable other_knowledge_format input field VIEW :  page-qcc-edit

$("#btn_update_qcc").click(function(){

    var v_act_name = $("#v_act_name").val();
    var v_act_startdate = $("#v_act_startdate").val();
    var v_act_enddate = $("#v_act_enddate").val();
    var v_act_purpose = $("#v_act_purpose").val();
    var v_act_tool = $("#v_act_tool").val();
    var v_act_cat = $("#v_act_cat").val();

    var v_before_fix = $("#v_before_fix").val();
    var v_indicator = $("#v_indicator").val();
    var v_conceptual_framework = $("#v_conceptual_framework").val();
    var v_theory = $("#v_theory").val();
    var v_conceptual_framework_approach = $("#v_conceptual_framework_approach").val();
    var v_results_based_monitoring = $("#v_results_based_monitoring").val();
    var v_after_fix = $("#v_after_fix").val();
    var v_result_vs_goal = $("#v_result_vs_goal").val();
    var v_reduced_cost = $("#v_reduced_cost").val();
    var v_available_capacity_improvement = $("#v_available_capacity_improvement").val();
    var v_increase_efficiency = $("#v_increase_efficiency").val();
    var v_stakeholder_fx = $("#v_stakeholder_fx").val();
    var v_reduced_mat_cost = $("#v_reduced_mat_cost").val();
    var v_reduced_man_day = $("#v_reduced_man_day").val();
    var v_reduced_enegy_cost = $("#v_reduced_enegy_cost").val();
    var v_reduced_worker_accident = $("#v_reduced_worker_accident").val();
    var v_reduced_asset_accident = $("#v_reduced_asset_accident").val();
    var v_satisfaction = $("#v_satisfaction").val();
    var v_innovation = $("#v_innovation").val();
    var v_other_stakeholder_fx = $("#v_other_stakeholder_fx").val();
    var v_follow_up1 = $("#v_follow_up1").val();
    var v_follow_up2 = $("#v_follow_up2").val();
    var v_follow_up3 = $("#v_follow_up3").val();
    var v_follow_up4 = $("#v_follow_up4").val();

    var v_act_startdate = $("#v_act_startdate").val();
    var split_v_act_startdate = $('#v_act_startdate').val().split("/"); // SOURCE : https://stackoverflow.com/questions/7151543/convert-dd-mm-yyyy-string-to-date
    var strtodate_v_act_startdate = new Date(split_v_act_startdate[2], split_v_act_startdate[1] - 1, split_v_act_startdate[0]);
    var v_act_enddate = $("#v_act_enddate").val();
    var split_v_act_enddate = $('#v_act_enddate').val().split("/");
    var strtodate_v_act_enddate = new Date(split_v_act_enddate[2], split_v_act_enddate[1] - 1, split_v_act_enddate[0]);

    var km_main_knowledge1 = $("#km_main_knowledge1").val();
    var km_sub_knowledge1 = $("#km_sub_knowledge1").val();
    var knowledge_used1 = $("#knowledge_used1").val();
    var knowledge_format1 = $("#knowledge_format1").val();
    var other_knowledge_format1 = $("#other_knowledge_format1").val();
    var knowledge_reference1 = $("#knowledge_reference1").val();

    var km_main_knowledge2 = $("#km_main_knowledge2").val();
    var km_sub_knowledge2 = $("#km_sub_knowledge2").val();
    var knowledge_used2 = $("#knowledge_used2").val();
    var knowledge_format2 = $("#knowledge_format2").val();
    var other_knowledge_format2 = $("#other_knowledge_format2").val();
    var knowledge_reference2 = $("#knowledge_reference2").val();

    var km_main_knowledge3 = $("#km_main_knowledge3").val();
    var km_sub_knowledge3 = $("#km_sub_knowledge3").val();
    var knowledge_used3 = $("#knowledge_used3").val();
    var knowledge_format3 = $("#knowledge_format3").val();
    var other_knowledge_format3 = $("#other_knowledge_format3").val();
    var knowledge_reference3 = $("#knowledge_reference3").val();

    var msg = "";
    var cnt = 0;

    if (strtodate_v_act_startdate > strtodate_v_act_enddate) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาตรวจสอบวันที่เริ่มต้น-สิ้นสุดกิจกรรม";
    }

    if (v_act_name == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุชื่อกระบวนการ/งานที่ถูกปรับปรุง"
    }

    if (v_act_startdate == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุวันที่เริ่มต้นกิจกรรม"
    }

    if (v_act_enddate == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุวันที่สิ้นสุดกิจกรรม"
    }

    if (v_act_purpose == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุวัตถุประสงค์"
    }

    if (v_act_tool == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุเครื่องมือที่ใช้ในการปรับปรุง"
    }

    if (v_act_cat == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุประเภทผลงาน"
    }

    if (v_before_fix == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุสภาพก่อนปรับปรุงและประเด็นในการปรับปรุง"
    }

    if (v_indicator == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุเป้าหมายหลักที่ต้องการปรับปรุง (ตัวชี้วัด)"
    }

    if (v_conceptual_framework == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุกรอบแนวคิดในการปรับปรุง"
    }

    if (v_theory == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุหลักการ (ทฤษฎี) ที่รองรับกรอบแนวคิด"
    }


    if (km_main_knowledge1 == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุหมวดหมู่ความรู้หลัก1"
    }

    if (km_sub_knowledge1 == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุหมวดหมู่ความรู้รอง1"
    }

    if (knowledge_used1 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุชื่อเรื่องความรู้ที่นำมาใช้1"
    }

    if (knowledge_format1 == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุรูปแบบของความรู้1"
    }

    if(knowledge_format1 == "9" && other_knowledge_format1 == ''){
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุรายละเอียดรูปแบบของความรู้ (อื่นๆ)1"
    }

    if (knowledge_reference1 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุแหล่งอ้างอิง1"
    }


    if (km_main_knowledge2 != null && km_sub_knowledge2 == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุหมวดหมู่ความรู้รอง2"
    }

    if (km_main_knowledge2 != null && knowledge_used2 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุชื่อเรื่องความรู้ที่นำมาใช้2"
    }

    if (km_main_knowledge2 != null && knowledge_format2 == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุรูปแบบของความรู้2"
    }

    if(km_main_knowledge2 != null && knowledge_format2 == "9" && other_knowledge_format2 == ''){
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุรายละเอียดรูปแบบของความรู้ (อื่นๆ)2"
    }

    if (km_main_knowledge2 != null && knowledge_reference2 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุแหล่งอ้างอิง2"
    }


    if (km_main_knowledge3 != null && km_sub_knowledge3 == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุหมวดหมู่ความรู้รอง3"
    }

    if (km_main_knowledge3 != null && knowledge_used3 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุชื่อเรื่องความรู้ที่นำมาใช้3"
    }

    if (km_main_knowledge3 != null && knowledge_format3 == null) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุรูปแบบของความรู้3"
    }

    if(km_main_knowledge3 != null && knowledge_format3 == "9" && other_knowledge_format3 == ''){
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุรายละเอียดรูปแบบของความรู้ (อื่นๆ)3"
    }

    if (km_main_knowledge3 != null && knowledge_reference3 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุแหล่งอ้างอิง3"
    }


    if (v_conceptual_framework_approach == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุวิธีการปรับปรุงตามกรอบแนวคิด"
    }

    if (v_results_based_monitoring == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุการตรวจสอบผลการปรับปรุง"
    }

    if (v_after_fix == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุสภาพหลังการปรับปรุง"
    }

    if (v_result_vs_goal == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลที่ได้เทียบกับเป้าหมายหลัก"
    }

    if (v_reduced_cost == '' && v_available_capacity_improvement == '' && v_increase_efficiency == '' ) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลที่ได้เทียบกับเป้าหมายหลัก(ลดค่าใช้จ่าย, เพิ่มความพร้อมจ่าย หรือ เพิ่มประสิทธิภาพ)"
    }

    if (v_stakeholder_fx == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลต่อและผู้มีส่วนได้ส่วนเสีย"
    }

    if (v_reduced_mat_cost == '' && v_reduced_man_day == '' && v_reduced_enegy_cost == '' && v_reduced_worker_accident == '' && v_reduced_asset_accident == '' && v_satisfaction == '' && v_innovation == '' && v_other_stakeholder_fx == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลต่อและผู้มีส่วนได้ส่วนเสีย(ประหยัดค่าวัสดุอุปกรณ์, ประหยัดเวลา/แรงงาน, ประหยัดค่าพลังงาน, ลดอุบัติเหตุด้านบุคคล, ลดอุบัติเหตุ/ความเสียหายด้านทรัพย์สิน,	ความพึงพอใจที่เพิ่มขึ้น, สิ่งประดิษฐ์ หรือ อื่นๆ)"
    }

    if (v_follow_up1 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุการติดตามผล/ความเป็นไปได้ในการขยายผล 1"
    }

    if (v_follow_up2 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุการติดตามผล/ความเป็นไปได้ในการขยายผล 2"
    }

    if (v_follow_up3 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุการติดตามผล/ความเป็นไปได้ในการขยายผล 3"
    }

    if (v_follow_up4 == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุการติดตามผล/ความเป็นไปได้ในการขยายผล 4"
    }

    if(cnt > 0){
    swal({
        title: "Please Check Your Input!!",
        // text: "Please check the missing field!"+msg,
        text: msg,
        icon: 'warning',
        buttons: "OK",
        // timer: 1500
    });
        return false;
        // alert('ccc');
    }else{
        return true;
    }
});

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
