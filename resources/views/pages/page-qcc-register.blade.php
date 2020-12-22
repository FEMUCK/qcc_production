{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','QCC Register')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/materialize-stepper/materialize-stepper.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-wizard.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
@endsection

{{-- page content --}}
@section('content')
<?php
    // ประกาศตัวแปรไว้ก่อนใช้งานด้านบนนี้เลย สำหรับ checkbox module ต่างๆ ด้านล่าง พร้อมกับใช้ foreach จากด้านบนเลย (ไม่ต้องไปประกาศแทรกใน HTML)
    $create_module = '';
    foreach($data as $value){
        if(isset($data['systemsettingdata'])){
            $systemsettingdata = $data['systemsettingdata'];
            foreach($systemsettingdata as $systemsettingdata_item){
                $paramno = $systemsettingdata_item->paramno;
                $paramtype = $systemsettingdata_item->paramtype;
                $paramval = $systemsettingdata_item->paramval;

                if($paramno == 'S012' && $paramtype == 'ADD' && $paramval == 'Enable'){
                    $create_module = 'Enable';
                }else{}
            }
        }
    }
?>
<div class="section section-form-wizard">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                กรุณาระบุข้อมูลให้ครบถ้วนและถูกต้องตามรูปแบบ จากนั้นกด Next เพื่อไปขั้นตอนถัดไป
                <br>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <div class="card light-blue">
                            <div class="card-content white-text">
                                <span class="card-title">คำอธิบายเพิ่มเติมส่วนที่ 4 Knowledge</span>
                                <p style="font-size:92%;">
                                    ความรู้ที่ใช้ในการพัฒนาหรือปรับปรุงงาน : ความรู้ใดที่ท่านนำมาใช้ในการพัฒนาหรือปรับปรุงงานที่ส่งเข้าประกวด เช่น พัฒนาระบบจองห้องประชุม ความรู้ที่ใช้ในการพัฒนาหรือปรับปรุงงาน คือ การเขียนโปรแกรมภาษา Java เป็นต้น<br>
                                    รูปแบบของความรู้ : ความรู้ที่ท่านนำมาใช้ในการพัฒนาหรือปรับปรุงงาน เป็นความรู้ที่อยู่ในรูปแบบใด เช่น BAR/AAR, หนังสือ, บทความ, ประสบการณ์ตรง เป็นต้น<br>
                                    แหล่งอ้างอิงความรู้ : ความรู้ที่ท่านนำมาใช้ในการพัฒนาหรือปรับปรุงงาน  ท่านนำมาจากแหล่งใด เช่น Link URL ของ website ต่างๆ, ชื่อห้องสมุด, ชื่อบุคคล-หน่วยงาน เป็นต้น
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>

    <!-- Horizontal Stepper -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">ลงทะเบียนกิจกรรมการปรับปรุง/พัฒนาคุณภาพงาน</h4>
                    </div>

                    {{-- <form name='qccRegistForm' id="qccRegistForm" method='POST' action="{{ route('addqcc')}}"> --}}
                    {{-- <form action="{{ url('addqcc')}}" method="POST"> --}}
                    <form name='qccRegistForm' id="qccRegistForm" method="POST" action="{{ route('addqcc')}}">
                        @csrf
                        {{-- <input type="hidden" id="v_group_yr" name="v_group_yr" value="{{ now()->year }}"> --}}
                        {{-- <input type="text" id="v_group_id" name="v_group_id"> --}}

                    <ul class="stepper horizontal" id="horizStepper">
                        <li class="step active">
                            {{-- Step 1 Activity --}}
                            <div class="step-title waves-effect">Activity</div>
                            <div class="step-content">

                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="v_act_name">ชื่อกระบวนการ/งานที่ถูกปรับปรุง : <span class="red-text">*</span></label>
                                        <input type="text" id="v_act_name" name="v_act_name" class="validate" required>
                                    </div>
                                    <div class="input-field col m3 s3">
                                        <i class="mdi mdi-calendar-month-outline prefix"></i>
                                        <label for="v_act_startdate">วันที่เริ่มต้น : <span class="red-text">*</span></label>
                                        <input type="text" id="v_act_startdate" name="v_act_startdate" class="datepicker" required>
                                    </div>
                                    <div class="input-field col m3 s3">
                                        <i class="mdi mdi-calendar-month-outline prefix"></i>
                                        <label for="v_act_enddate">วันที่สิ้นสุด : <span class="red-text">*</span></label>
                                        <input type="text" id="v_act_enddate" name="v_act_enddate" class="datepicker" required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Basic Select2 วัตถุประสงค์ในการปรับปรุง --}}
                                    <div class="input-field col m3 s3">
                                        <select class="select2 browser-default" id="v_act_purpose" name="v_act_purpose">
                                            <option value="" selected disabled>วัตถุประสงค์ในการปรับปรุง : </option>
                                            @foreach($data['actpurpose'] as $actpurpose)
                                                <option value='{{ $actpurpose->act_purpose_id }}'>{{ $actpurpose->act_purpose }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col m3 s3">
                                        <label for="v_act_purpose_remark">วัตถุประสงค์ในการปรับปรุงอื่น ๆ : </label>
                                        <input type="text" class="validate" id="v_act_purpose_remark" name="v_act_purpose_remark">
                                    </div>
                                    {{-- Basic Select2 เครื่องมือที่ใช้ในการปรับปรุง --}}
                                    <div class="input-field col m3 s3">
                                        <select class="select2 browser-default" id="v_act_tool" name="v_act_tool">
                                            <option value="" selected disabled>เครื่องมือที่ใช้ในการปรับปรุง : </option>
                                            @foreach($data['acttool'] as $acttool)
                                                <option value='{{ $acttool->act_tool_id }}'>{{ $acttool->act_tool }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col m3 s3">
                                        <label for="v_act_tool_remark">เครื่องมือที่ใช้ในการปรับปรุงอื่น ๆ : </label>
                                        <input type="text" class="validate" id="v_act_tool_remark" name="v_act_tool_remark">
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Basic Select2 ประเภทผลงาน --}}
                                    <div class="input-field col m3 s3">
                                        <select class="select2 browser-default" id="v_act_cat" name="v_act_cat">
                                            <option value="" selected disabled>ประเภทผลงาน : </option>
                                            @foreach($data['actcat'] as $actcat)
                                                <option value='{{ $actcat->act_cat_id }}'>{{ $actcat->act_cat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col m3 s3">
                                        <i class="mdi mdi-link-variant prefix"></i>
                                        <label for="v_act_url">URL ECP เอกสารแนบ : </label>
                                        <textarea type="text" id="v_attachment_url" name="v_attachment_url" rows="4" class="materialize-textarea"></textarea>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-head-lightbulb-outline prefix"></i>
                                        <input id="v_member_c" name="v_member_c" type="text" class="validate" required>
                                        <label for="v_member_c">ที่ปรึกษา : <font color="red">*</font></label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input disabled id="v_member_name_c" name="v_member_name_c" type="text" class="validate">
                                        <label for="v_member_name_c">ชื่อ - สกุล</label>
                                    </div>
                                </div>

                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m6 s12 mb-1">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_activity" name="btn_reset_activity">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m6 s12 mb-1">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_activity" name="btn_nextstep_activity">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 2 Profile --}}
                            <div class="step-title waves-effect">Profile</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-head-cog-outline prefix"></i>
                                        <input id="v_member_h" name="v_member_h" type="text" class="validate" required>
                                        <label for="v_member_h">หัวหน้ากลุ่ม : <font color="red">*</font></label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input disabled id="v_member_name_h" name="v_member_name_h" type="text" class="validate">
                                        <label for="v_member_name_h">ชื่อ - สกุล</label>
                                    </div>

                                    <div class="input-field col s3">
                                        <i class="mdi mdi-account-outline prefix"></i>
                                        <input id="v_member_m2" name="v_member_m2" type="text" class="validate">
                                        <label for="v_member_m2">สมาชิก 1 : </label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input disabled id="v_member_name_m2" name="v_member_name_m2" type="text" class="validate">
                                        <label for="v_member_name_m2">ชื่อ - สกุล</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-account-outline prefix"></i>
                                        <input id="v_member_m3" name="v_member_m3" type="text" class="validate">
                                        <label for="v_member_m3">สมาชิก 2 : </label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input disabled id="v_member_name_m3" name="v_member_name_m3" type="text" class="validate">
                                        <label for="v_member_name_m3">ชื่อ - สกุล</label>
                                    </div>

                                    <div class="input-field col s3">
                                        <i class="mdi mdi-account-outline prefix"></i>
                                        <input id="v_member_m4" name="v_member_m4" type="text" class="validate">
                                        <label for="v_member_m4">สมาชิก 3 : </label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input disabled id="v_member_name_m4" name="v_member_name_m4" type="text" class="validate">
                                        <label for="v_member_name_m4">ชื่อ - สกุล</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-account-outline prefix"></i>
                                        <input id="v_member_m5" name="v_member_m5" type="text" class="validate">
                                        <label for="v_member_m5">สมาชิก 4 : </label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input disabled id="v_member_name_m5" name="v_member_name_m5" type="text" class="validate">
                                        <label for="v_member_name_m5">ชื่อ - สกุล</label>
                                    </div>

                                    <div class="input-field col s3">
                                        <i class="mdi mdi-account-outline prefix"></i>
                                        <input id="v_member_m6" name="v_member_m6" type="text" class="validate">
                                        <label for="v_member_m6">สมาชิก 5 : </label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input disabled id="v_member_name_m6" name="v_member_name_m6" type="text" class="validate">
                                        <label for="v_member_name_m6">ชื่อ - สกุล</label>
                                    </div>
                                </div>

                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_profile" name="btn_reset_profile">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_profile" name="btn_nextstep_profile">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 3 Plan --}}
                            <div class="step-title waves-effect">Plan</div>
                            <div class="step-content">
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
                                        <textarea name="v_before_fix" id="v_before_fix" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="v_conceptual_framework">2.1 กรอบแนวคิดในการปรับปรุง : <span class="red-text">*</span></label>
                                        <textarea name="v_conceptual_framework" id="v_conceptual_framework" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="v_indicator">1.2 เป้าหมายหลักที่ต้องการปรับปรุง (ตัวชี้วัด) : <span class="red-text">*</span></label>
                                        <textarea name="v_indicator" id="v_indicator" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="v_theory">2.2 หลักการ (ทฤษฎี) ที่รองรับกรอบแนวคิด : <span class="red-text">*</span></label>
                                        <textarea name="v_theory" id="v_theory" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_plan" name="btn_reset_plan">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_plan" name="btn_nextstep_plan">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 4 Knowledge --}}
                            <div class="step-title waves-effect">Knowledge</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="km_main_knowledge1" name="km_main_knowledge1" required>
                                            <option value="" selected disabled>เลือกหมวดหมู่ความรู้หลัก1 : </option>
                                            @foreach($data['mainknowledgelist'] as $mainknowledgelist_item)
                                                <option value='{{ $mainknowledgelist_item->mainknowledgeid }}'>{{ $mainknowledgelist_item->mainknowledge_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="km_sub_knowledge1" name="km_sub_knowledge1" required>
                                            <option value="" selected disabled>เลือกหมวดหมู่ความรู้รอง1 : </option>
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <i class="mdi mdi-lightbulb-on-outline prefix"></i>
                                        <input id="knowledge_used1" name="knowledge_used1" type="text" class="validate" required>
                                        <label style="font-size:70%;" for="knowledge_used1">ระบุชื่อเรื่องความรู้ที่นำมาใช้1<font color="red">*</font></label>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="knowledge_format1" name="knowledge_format1" required>
                                            <option value="" selected disabled>เลือกรูปแบบของความรู้1 : </option>
                                            @foreach($data['knowledgeformatlist'] as $knowledgeformatlist_item)
                                                <option value='{{ $knowledgeformatlist_item->knowledgeformatid }}'>{{ $knowledgeformatlist_item->knowledgeformat_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <input id="other_knowledge_format1" name="other_knowledge_format1" type="text" disabled>
                                        <label for="other_knowledge_format1">อื่นๆ (โปรดระบุ)1</label>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <i class="mdi mdi-source-branch prefix"></i>
                                        <input id="knowledge_reference1" name="knowledge_reference1" type="text" class="validate" required>
                                        <label for="knowledge_reference1">แหล่งอ้างอิง1</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="km_main_knowledge2" name="km_main_knowledge2">
                                            <option value="" selected disabled>เลือกหมวดหมู่ความรู้หลัก2 : </option>
                                            @foreach($data['mainknowledgelist'] as $mainknowledgelist_item)
                                                <option value='{{ $mainknowledgelist_item->mainknowledgeid }}'>{{ $mainknowledgelist_item->mainknowledge_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="km_sub_knowledge2" name="km_sub_knowledge2">
                                            <option value="" selected disabled>เลือกหมวดหมู่ความรู้รอง2 : </option>
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <i class="mdi mdi-lightbulb-on-outline prefix"></i>
                                        <input id="knowledge_used2" name="knowledge_used2" type="text">
                                        <label style="font-size:70%;" for="knowledge_used2">ระบุชื่อเรื่องความรู้ที่นำมาใช้2<font color="red">*</font></label>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="knowledge_format2" name="knowledge_format2">
                                            <option value="" selected disabled>เลือกรูปแบบของความรู้2 : </option>
                                            @foreach($data['knowledgeformatlist'] as $knowledgeformatlist_item)
                                                <option value='{{ $knowledgeformatlist_item->knowledgeformatid }}'>{{ $knowledgeformatlist_item->knowledgeformat_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <input id="other_knowledge_format2" name="other_knowledge_format2" type="text" disabled>
                                        <label for="other_knowledge_format2">อื่นๆ (โปรดระบุ)2</label>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <i class="mdi mdi-source-branch prefix"></i>
                                        <input id="knowledge_reference2" name="knowledge_reference2" type="text">
                                        <label for="knowledge_reference2">แหล่งอ้างอิง2</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="km_main_knowledge3" name="km_main_knowledge3">
                                            <option value="" selected disabled>เลือกหมวดหมู่ความรู้หลัก3 : </option>
                                            @foreach($data['mainknowledgelist'] as $mainknowledgelist_item)
                                                <option value='{{ $mainknowledgelist_item->mainknowledgeid }}'>{{ $mainknowledgelist_item->mainknowledge_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="km_sub_knowledge3" name="km_sub_knowledge3">
                                            <option value="" selected disabled>เลือกหมวดหมู่ความรู้รอง3 : </option>
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <i class="mdi mdi-lightbulb-on-outline prefix"></i>
                                        <input id="knowledge_used3" name="knowledge_used3" type="text">
                                        <label style="font-size:70%;" for="knowledge_used3">ระบุชื่อเรื่องความรู้ที่นำมาใช้3<font color="red">*</font></label>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <select class="select2 browser-default" id="knowledge_format3" name="knowledge_format3">
                                            <option value="" selected disabled>เลือกรูปแบบของความรู้3 : </option>
                                            @foreach($data['knowledgeformatlist'] as $knowledgeformatlist_item)
                                                <option value='{{ $knowledgeformatlist_item->knowledgeformatid }}'>{{ $knowledgeformatlist_item->knowledgeformat_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <input id="other_knowledge_format3" name="other_knowledge_format3" type="text" disabled>
                                        <label for="other_knowledge_format3">อื่นๆ (โปรดระบุ)3</label>
                                    </div>
                                    <div class="input-field col l2 m2 s2">
                                        <i class="mdi mdi-source-branch prefix"></i>
                                        <input id="knowledge_reference3" name="knowledge_reference3" type="text">
                                        <label for="knowledge_reference3">แหล่งอ้างอิง3</label>
                                    </div>
                                </div>

                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_km" name="btn_reset_km">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_km" name="btn_nextstep_km">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 5 Do --}}
                            <div class="step-title waves-effect">Do</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <label for="v_conceptual_framework_approach">วิธีการปรับปรุงตามกรอบแนวคิด : <span class="red-text">*</span></label>
                                        <textarea name="v_conceptual_framework_approach" id="v_conceptual_framework_approach" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>

                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_do" name="btn_reset_do">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_do" name="btn_nextstep_do">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 6 Check --}}
                            <div class="step-title waves-effect">Check</div>
                            <div class="step-content">
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
                                        <textarea name="v_results_based_monitoring" id="v_results_based_monitoring" rows="2" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <label for="v_after_fix">3.2 สภาพหลังการปรับปรุง : <span class="red-text">*</span></label>
                                        <textarea name="v_after_fix" id="v_after_fix" rows="2" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_check1" name="btn_reset_check1">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_check1" name="btn_nextstep_check1">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 7 Check --}}
                            <div class="step-title waves-effect">Check</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <label for="v_result_vs_goal">3.3 ผลที่ได้เทียบกับเป้าหมายหลัก : <span class="red-text">*</span></label>
                                        <textarea name="v_result_vs_goal" id="v_result_vs_goal" rows="2" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-bitcoin prefix"></i>
                                        <label for="v_reduced_cost">ลดค่าใช้จ่าย(บาท/ปี)</label>
                                        <input id="v_reduced_cost" name="v_reduced_cost" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <label for="v_reduced_cost_desc">คำอธิบาย(ถ้ามี)</label>
                                        <input id="v_reduced_cost_desc" name="v_reduced_cost_desc" type="text" class="validate">
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix">network_check</i>
                                        <label for="v_available_capacity_improvement">เพิ่มความพร้อมจ่าย(%/ปี)</label>
                                        <input id="v_available_capacity_improvement" name="v_available_capacity_improvement" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <label for="v_available_capacity_improvement_desc">คำอธิบาย(ถ้ามี)</label>
                                        <input id="v_available_capacity_improvement_desc" name="v_available_capacity_improvement_desc" type="text" class="validate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-finance prefix"></i>
                                        <label for="v_increase_efficiency">เพิ่มประสิทธิภาพ(%/ปี)</label>
                                        <input id="v_increase_efficiency" name="v_increase_efficiency" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <label for="v_increase_efficiency_desc">คำอธิบาย(ถ้ามี)</label>
                                        <input id="v_increase_efficiency_desc" name="v_increase_efficiency_desc" type="text" class="validate">
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_check2" name="btn_reset_check2">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_check2" name="btn_nextstep_check2">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 8 Check --}}
                            <div class="step-title waves-effect">Check</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <label for="v_stakeholder_fx">3.4 ผลต่อและผู้มีส่วนได้ส่วนเสีย (องค์กร ผู้ปฏิบัติงาน ลูกค้า สังคม) : <span class="red-text">*</span></label>
                                        <textarea name="v_stakeholder_fx" id="v_stakeholder_fx" rows="2" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        {{-- <i class="mdi mdi-fuse prefix"></i> --}}
                                        <i class="mdi mdi-wall prefix"></i>
                                        <label for="v_reduced_mat_cost">ประหยัดค่าวัสดุอุปกรณ์(บาท/ปี)</label>
                                        <input id="v_reduced_mat_cost" name="v_reduced_mat_cost" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-clock-outline prefix"></i>
                                        <label for="v_reduced_man_day">ประหยัดเวลา/แรงงาน(บาท/ปี)</label>
                                        <input id="v_reduced_man_day" name="v_reduced_man_day" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-battery-charging-high prefix"></i>
                                        <label for="v_reduced_enegy_cost">ประหยัดค่าพลังงาน(บาท/ปี)</label>
                                        <input id="v_reduced_enegy_cost" name="v_reduced_enegy_cost" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-account-alert prefix"></i>
                                        <label for="v_reduced_worker_accident">ลดอุบัติเหตุด้านบุคคล(ราย/ปี)</label>
                                        <input id="v_reduced_worker_accident" name="v_reduced_worker_accident" type="text" class="validate" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-alert prefix"></i>
                                        <label for="v_reduced_asset_accident">ลดความเสียหายด้านทรัพย์สิน(บาท/ปี)</label>
                                        <input id="v_reduced_asset_accident" name="v_reduced_asset_accident" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-account-star prefix"></i>
                                        <label for="v_satisfaction">ความพึงพอใจที่เพิ่มขึ้น(%)</label>
                                        <input id="v_satisfaction" name="v_satisfaction" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-lightbulb-on prefix"></i>
                                        <label for="v_innovation">สิ่งประดิษฐ์(%)</label>
                                        <input id="v_innovation" name="v_innovation" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="mdi mdi-dots-horizontal-circle prefix"></i>
                                        <label for="v_other_stakeholder_fx">อื่นๆ(%)</label>
                                        <input id="v_other_stakeholder_fx" name="v_other_stakeholder_fx" type="text" class="validate" required>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="button" id="btn_reset_check3" name="btn_reset_check3">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="waves-effect waves dark btn btn-primary next-step" type="button" id="btn_nextstep_check3" name="btn_nextstep_check3">Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="step">
                            {{-- Step 9 Act --}}
                            <div class="step-title waves-effect">Act</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <p>
                                            <strong>4. การขยายผล (เป็น Innovation / Best Practice)</strong>
                                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การติดตามผล / ความเป็นไปได้ในการขยายผล
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="v_follow_up1">4.1 มีกระบวนการทำงานใหม่/ชิ้นงานใหม่/สิ่งประดิษฐ์ใหม่/เครื่องมือใหม่ และ มาตรฐานใหม่ : <span class="red-text">*</span></label>
                                        <textarea name="v_follow_up1" id="v_follow_up1" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="v_follow_up2">4.2 ผลงานมีแนวโน้มต่อยอดเป็นนวัตกรรม : <span class="red-text">*</span></label>
                                        <textarea name="v_follow_up2" id="v_follow_up2" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="v_follow_up3">4.3 มีแผนงาน และข้อมูลติดตามผลการรักษามาตรฐาน : <span class="red-text">*</span></label>
                                        <textarea name="v_follow_up3" id="v_follow_up3" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="v_follow_up4">4.4 มีศักยภาพสามารถขยายผลในสายงาน หรือข้ามสายงาน : <span class="red-text">*</span></label>
                                        <textarea name="v_follow_up4" id="v_follow_up4" rows="4" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <div class="row">
                                        <div class="col m4 s12 mb-3">
                                            <button class="red btn mr-1 btn-reset" type="button" id="btn_reset_act" name="btn_reset_act">
                                                <i class="material-icons">clear</i>Reset
                                            </button>
                                        </div>
                                        <div class="col m4 s12 mb-3">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>Prev
                                            </button>
                                        </div>
                                        @if($create_module == 'Enable' || session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
                                            <div class="col m4 s12 mb-3">
                                                <button class="waves-effect waves-dark btn btn-primary" type="submit" id="btn_save_qcc" id="btn_save_qcc">Submit</button>
                                            </div>
                                        @else
                                            <div class="col m4 s12 mb-3">
                                                <button onclick="createDisableFunction();" class="waves-effect waves-dark btn gradient-45deg-blue-grey-blue-grey tooltipped" data-position="bottom" data-tooltip="ระบบไม่เปิดให้เพิ่มข้อมูลได้ในขณะนี้" type="button" id="btn_save_qcc_disable" id="btn_save_qcc_disable">Submit</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
<script src="{{asset('vendors/materialize-stepper/materialize-stepper.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('vendors/igorescobar/jquery-mask-plugin/dist/jquery.mask.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/form-wizard.js')}}"></script>
<script src="{{asset('js/scripts/form-select2.js')}}"></script>
<script src="{{asset('js/scripts/extra-components-sweetalert.js')}}"></script>

<script>
/*! Initialize Stepper เพื่อใช้งาน **/
// SOURCE : https://kinark.github.io/Materialize-stepper/
var stepper = document.querySelector('.stepper');
var stepperInstace = new MStepper(stepper, {
    // options
    firstActive: 0, // this is the default
    // Allow navigation by clicking on the next and previous steps on linear steppers.
    linearStepsNavigation: true,
    // Enable or disable navigation by clicking on step-titles
    stepTitleNavigation: true,
    // Auto generation of a form around the stepper.
    autoFormCreation: true
    // Function to be called everytime a nextstep occurs. It receives 2 arguments, in this sequece: stepperForm, activeStepContent.
    // validationFunction: validationFunction, // more about this default functions below
});

$("#v_act_enddate").change(function(){
    var split_v_act_startdate = $('#v_act_startdate').val().split("/"); // SOURCE : https://stackoverflow.com/questions/7151543/convert-dd-mm-yyyy-string-to-date
    var strtodate_v_act_startdate = new Date(split_v_act_startdate[2], split_v_act_startdate[1] - 1, split_v_act_startdate[0]);
    var split_v_act_enddate = $('#v_act_enddate').val().split("/");
    var strtodate_v_act_enddate = new Date(split_v_act_enddate[2], split_v_act_enddate[1] - 1, split_v_act_enddate[0]);

    if (strtodate_v_act_startdate > strtodate_v_act_enddate) {
        swal({
            title: "End Date Less Than Start Date!!",
            text: "กรุณาตรวจสอบวันที่เริ่มต้น-สิ้นสุดกิจกรรม",
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
    }
});

// START Form Validation next button
// SOURCE : https://codepen.io/flist/pen/mqXemY
$("#btn_nextstep_activity").click(function(){
    var v_act_name = $("#v_act_name").val();
    var v_act_startdate = $("#v_act_startdate").val();
    var v_act_enddate = $("#v_act_enddate").val();
    var v_act_purpose = $("#v_act_purpose").val();
    var v_act_tool = $("#v_act_tool").val();
    var v_act_cat = $("#v_act_cat").val();
    var v_member_c = $("#v_member_c").val();

    var msg = "";
    var cnt = 0;

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

    if (v_member_c == '') {
            cnt = cnt + 1;
            msg = msg+"\n"+cnt+". กรุณาระบุที่ปรึกษา"
    }

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        return true;
    }
});

$("#btn_nextstep_profile").click(function(){
    var v_member_h = $("#v_member_h").val();

    var msg = "";
    var cnt = 0;

    if (v_member_h == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุหัวหน้ากลุ่ม"
    }

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        return true;
    }
});

$("#btn_nextstep_plan").click(function(){
    var v_before_fix = $("#v_before_fix").val();
    var v_indicator = $("#v_indicator").val();
    var v_conceptual_framework = $("#v_conceptual_framework").val();
    var v_theory = $("#v_theory").val();

    var msg = "";
    var cnt = 0;

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

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        return true;
    }
});

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

$("#btn_nextstep_km").click(function(){
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

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        return true;
    }
});

$("#btn_nextstep_do").click(function(){
    var v_conceptual_framework_approach = $("#v_conceptual_framework_approach").val();

    var msg = "";
    var cnt = 0;

    if (v_conceptual_framework_approach == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุวิธีการปรับปรุงตามกรอบแนวคิด"
    }

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        return true;
    }
});

$("#btn_nextstep_check1").click(function(){
    var v_results_based_monitoring = $("#v_results_based_monitoring").val();
    var v_after_fix = $("#v_after_fix").val();

    var msg = "";
    var cnt = 0;

    if (v_results_based_monitoring == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุการตรวจสอบผลการปรับปรุง"
    }

    if (v_after_fix == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุสภาพหลังการปรับปรุง"
    }

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        return true;
    }
});

// ใช้เวลาเปลี่ยนค่าใน Stepper (nextstep_check2) ถ้ามีการคีย์อย่างน้อย 1 field จะ remove attribute require ทำให้กด next ได้ ถ้าไม่ทำแบบนี้ถึงไม่กรอกตัวเลขจะมีแค่ alert แต่ยัง next step ได้
// SOURCE : https://stackoverflow.com/questions/18770369/how-to-set-html5-required-attribute-in-javascript
$("#v_reduced_cost, #v_available_capacity_improvement, #v_increase_efficiency").change(function(){
    var v_reduced_cost = $("#v_reduced_cost").val();
    var v_available_capacity_improvement = $("#v_available_capacity_improvement").val();
    var v_increase_efficiency = $("#v_increase_efficiency").val();

    if (v_reduced_cost != '' || v_available_capacity_improvement != '' || v_increase_efficiency != '') {
        $("#v_reduced_cost, #v_available_capacity_improvement, #v_increase_efficiency").removeAttr('required');
    }else if(v_reduced_cost == '' && v_available_capacity_improvement == '' && v_increase_efficiency == ''){
        $("#v_reduced_cost, #v_available_capacity_improvement, #v_increase_efficiency").attr('required', '');
    }
});

$("#btn_nextstep_check2").click(function(){
    var v_result_vs_goal = $("#v_result_vs_goal").val();
    var v_reduced_cost = $("#v_reduced_cost").val();
    var v_available_capacity_improvement = $("#v_available_capacity_improvement").val();
    var v_increase_efficiency = $("#v_increase_efficiency").val();

    var msg = "";
    var cnt = 0;

    if (v_result_vs_goal == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลที่ได้เทียบกับเป้าหมายหลัก"
    }

    if (v_reduced_cost == '' && v_available_capacity_improvement == '' && v_increase_efficiency == '' ) {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลที่ได้เทียบกับเป้าหมายหลัก(ลดค่าใช้จ่าย, เพิ่มความพร้อมจ่าย หรือ เพิ่มประสิทธิภาพ)"
        $("#v_reduced_cost, #v_available_capacity_improvement, #v_increase_efficiency").attr('required', '');
    }

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
        $("#v_reduced_cost, #v_available_capacity_improvement, #v_increase_efficiency").attr('required', '');
        return false;
    }else{
        return true;
    }
});

// ใช้เวลาเปลี่ยนค่าใน Stepper (nextstep_check2) ถ้ามีการคีย์อย่างน้อย 1 field จะ remove attribute require ทำให้กด next ได้ ถ้าไม่ทำแบบนี้ถึงไม่กรอกตัวเลขจะมีแค่ alert แต่ยัง next step ได้
// SOURCE : https://stackoverflow.com/questions/18770369/how-to-set-html5-required-attribute-in-javascript
$("#v_reduced_mat_cost, #v_reduced_man_day, #v_reduced_enegy_cost, #v_reduced_worker_accident, #v_reduced_asset_accident, #v_satisfaction, #v_innovation, #v_other_stakeholder_fx").change(function(){
    var v_reduced_mat_cost = $("#v_reduced_mat_cost").val();
    var v_reduced_man_day = $("#v_reduced_man_day").val();
    var v_reduced_enegy_cost = $("#v_reduced_enegy_cost").val();
    var v_reduced_worker_accident = $("#v_reduced_worker_accident").val();
    var v_reduced_asset_accident = $("#v_reduced_asset_accident").val();
    var v_satisfaction = $("#v_satisfaction").val();
    var v_innovation = $("#v_innovation").val();
    var v_other_stakeholder_fx = $("#v_other_stakeholder_fx").val();

    if (v_reduced_mat_cost != '' || v_reduced_man_day != '' || v_reduced_enegy_cost != '' || v_reduced_worker_accident != '' || v_reduced_asset_accident != '' || v_satisfaction != '' || v_innovation != '' || v_other_stakeholder_fx != '') {
        $("#v_reduced_mat_cost, #v_reduced_man_day, #v_reduced_enegy_cost, #v_reduced_worker_accident, #v_reduced_asset_accident, #v_satisfaction, #v_innovation, #v_other_stakeholder_fx").removeAttr('required');
    }else if(v_reduced_mat_cost == '' && v_reduced_man_day == '' && v_reduced_enegy_cost == '' && v_reduced_worker_accident == '' && v_reduced_asset_accident == '' && v_satisfaction == '' && v_innovation == '' && v_other_stakeholder_fx == ''){
        $("#v_reduced_mat_cost, #v_reduced_man_day, #v_reduced_enegy_cost, #v_reduced_worker_accident, #v_reduced_asset_accident, #v_satisfaction, #v_innovation, #v_other_stakeholder_fx").attr('required', '');
    }
});

$("#btn_nextstep_check3").click(function(){
    var v_stakeholder_fx = $("#v_stakeholder_fx").val();
    var v_reduced_mat_cost = $("#v_reduced_mat_cost").val();
    var v_reduced_man_day = $("#v_reduced_man_day").val();
    var v_reduced_enegy_cost = $("#v_reduced_enegy_cost").val();
    var v_reduced_worker_accident = $("#v_reduced_worker_accident").val();
    var v_reduced_asset_accident = $("#v_reduced_asset_accident").val();
    var v_satisfaction = $("#v_satisfaction").val();
    var v_innovation = $("#v_innovation").val();
    var v_other_stakeholder_fx = $("#v_other_stakeholder_fx").val();

    var msg = "";
    var cnt = 0;

    if (v_stakeholder_fx == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลต่อและผู้มีส่วนได้ส่วนเสีย"
    }

    if (v_reduced_mat_cost == '' && v_reduced_man_day == '' && v_reduced_enegy_cost == '' && v_reduced_worker_accident == '' && v_reduced_asset_accident == '' && v_satisfaction == '' && v_innovation == '' && v_other_stakeholder_fx == '') {
        cnt = cnt + 1;
        msg = msg+"\n"+cnt+". กรุณาระบุผลต่อและผู้มีส่วนได้ส่วนเสีย(ประหยัดค่าวัสดุอุปกรณ์, ประหยัดเวลา/แรงงาน, ประหยัดค่าพลังงาน, ลดอุบัติเหตุด้านบุคคล, ลดอุบัติเหตุ/ความเสียหายด้านทรัพย์สิน,	ความพึงพอใจที่เพิ่มขึ้น, สิ่งประดิษฐ์ หรือ อื่นๆ)"
        $("#v_reduced_mat_cost, #v_reduced_man_day, #v_reduced_enegy_cost, #v_reduced_worker_accident, #v_reduced_asset_accident, #v_satisfaction, #v_innovation, #v_other_stakeholder_fx").attr('required', '');
    }

    if(cnt > 0){
        swal({
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        return true;
    }
});
// END Form Validation next button

// START Clear Button for input field VIEW page-qcc-register
$("#btn_reset_activity").click(function(){
    $("#v_act_name").val('');
    $("#v_act_startdate").val('');
    $("#v_act_enddate").val('');
    $("#v_act_purpose").val('').trigger('change');
    $("#v_act_purpose_remark").val('');
    $("#v_act_tool").val('').trigger('change');
    $("#v_act_tool_remark").val('');
    $("#v_act_cat").val('').trigger('change');
    $("#v_act_url").val('');
    $("#v_member_c").val('');
    $("#v_member_name_c").val('');
    M.updateTextFields();
});

$("#btn_reset_profile").click(function(){
    $("#v_member_h").val('');
    $("#v_member_name_h").val('');
    $("#v_member_m2").val('');
    $("#v_member_name_m2").val('');
    $("#v_member_m3").val('');
    $("#v_member_name_m3").val('');
    $("#v_member_m4").val('');
    $("#v_member_name_m4").val('');
    $("#v_member_m5").val('');
    $("#v_member_name_m5").val('');
    $("#v_member_m6").val('');
    $("#v_member_name_m6").val('');
    M.updateTextFields();
});

$("#btn_reset_plan").click(function(){
    $("#v_before_fix").val('');
    $("#v_indicator").val('');
    $("#v_conceptual_framework").val('');
    $("#v_theory").val('');
    M.updateTextFields();
});

$("#btn_reset_km").click(function(){
    $("#km_main_knowledge1").val('').trigger('change');
    $("#km_sub_knowledge1").val('').trigger('change');
    $("#knowledge_used1").val('');
    $("#knowledge_format1").val('').trigger('change');
    $("#other_knowledge_format1").val('');
    $("#knowledge_reference1").val('');

    $("#km_main_knowledge2").val('').trigger('change');
    $("#km_sub_knowledge2").val('').trigger('change');
    $("#knowledge_used2").val('');
    $("#knowledge_format2").val('').trigger('change');
    $("#other_knowledge_format2").val('');
    $("#knowledge_reference2").val('');

    $("#km_main_knowledge3").val('').trigger('change');
    $("#km_sub_knowledge3").val('').trigger('change');
    $("#knowledge_used3").val('');
    $("#knowledge_format3").val('').trigger('change');
    $("#other_knowledge_format3").val('');
    $("#knowledge_reference3").val('');
    M.updateTextFields();
});

$("#btn_reset_do").click(function(){
    $("#v_conceptual_framework_approach").val('');
    M.updateTextFields();
});

$("#btn_reset_check1").click(function(){
    $("#v_results_based_monitoring").val('');
    $("#v_after_fix").val('');
    M.updateTextFields();
});

$("#btn_reset_check2").click(function(){
    $("#v_result_vs_goal").val('');
    $("#v_reduced_cost").val('');
    $("#v_reduced_cost_desc").val('');
    $("#v_available_capacity_improvement").val('');
    $("#v_available_capacity_improvement_desc").val('');
    $("#v_increase_efficiency").val('');
    $("#v_increase_efficiency_desc").val('');
    M.updateTextFields();
});

$("#btn_reset_check3").click(function(){
    $("#v_stakeholder_fx").val('');
    $("#v_reduced_mat_cost").val('');
    $("#v_reduced_man_day").val('');
    $("#v_reduced_enegy_cost").val('');
    $("#v_reduced_worker_accident").val('');
    $("#v_reduced_asset_accident").val('');
    $("#v_satisfaction").val('');
    $("#v_innovation").val('');
    $("#v_other_stakeholder_fx").val('');
    M.updateTextFields();
});

$("#btn_reset_act").click(function(){
    $("#v_follow_up1").val('');
    $("#v_follow_up2").val('');
    $("#v_follow_up3").val('');
    $("#v_follow_up4").val('');
    M.updateTextFields();
});
// END Clear Button for input field VIEW page-qcc-register
</script>

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
// END Form Mask to format user input to match a specified pattern.

// START สำหรับแสดง onkeyup ใน View : page-qcc-register จะทำงานก็ต่อเมื่อความยาวตัวอักษร = 6 Source:https://stackoverflow.com/questions/33285622/jquery-trigger-event-based-on-form-input-length
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
// END สำหรับแสดง onkeyup ใน View : page-qcc-register จะทำงานก็ต่อเมื่อความยาวตัวอักษร = 6 Source:https://stackoverflow.com/questions/33285622/jquery-trigger-event-based-on-form-input-length

// START สำหรับ clear ค่าถ้าความยาวตัวอักษร idinput < 6 Event onkeyup ใน View : page-qcc-register
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
// END สำหรับ clear ค่าถ้าความยาวตัวอักษร idinput < 6 Event  onkeyup ใน View : page-qcc-register

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

// START Form Validation submit button
$("#btn_save_qcc").click(function(){
    var v_group_yr = $("#v_group_yr").val();
    var v_group_id = $("#v_group_id").val();
    var v_act_name = $("#v_act_name").val();
    var v_act_startdate = $("#v_act_startdate").val();
    var v_act_enddate = $("#v_act_enddate").val();
    var v_act_purpose = $("#v_act_purpose").val();
    // var v_act_purpose_remark = $("#v_act_purpose_remark").val();
    var v_act_tool = $("#v_act_tool").val();
    // var v_act_tool_remark = $("#v_act_tool_remark").val();
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
    // var v_reduced_cost_desc = $("#v_reduced_cost_desc").val();
    var v_available_capacity_improvement = $("#v_available_capacity_improvement").val();
    // var v_available_capacity_improvement_desc = $("#v_available_capacity_improvement_desc").val();
    var v_increase_efficiency = $("#v_increase_efficiency").val();
    // var v_increase_efficiency_desc = $("#v_increase_efficiency_desc").val();

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

    var v_member_c = $("#v_member_c").val();
    var v_member_h = $("#v_member_h").val();
    var v_member_m2 = $("#v_member_m2").val();
    var v_member_m3 = $("#v_member_m3").val();
    var v_member_m4 = $("#v_member_m4").val();
    var v_member_m5 = $("#v_member_m5").val();
    var v_member_m6 = $("#v_member_m6").val();

    var split_v_act_startdate = $('#v_act_startdate').val().split("/"); // SOURCE : https://stackoverflow.com/questions/7151543/convert-dd-mm-yyyy-string-to-date
    var strtodate_v_act_startdate = new Date(split_v_act_startdate[2], split_v_act_startdate[1] - 1, split_v_act_startdate[0]);
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
            title: "Field Empty!!",
            // text: "Please check the missing field!"+msg,
            text: msg,
            icon: 'warning',
            buttons: "OK",
            // timer: 1500
        });
            return false;
    }else{
        swal("Your record has been saved", {
            icon: "success",
        }).then(function () {
            return true;
        })
    }
    // return true;
});
// END Form Validation submit button

// START SweetAlert2 Notification for Disabled Module
function createDisableFunction() {
    swal({
        title: 'ระบบไม่เปิดให้เพิ่มข้อมูลได้ในขณะนี้',
        icon: 'warning'
    })
};
// END SweetAlert2 Notification for Disabled Module
</script>
@endsection
