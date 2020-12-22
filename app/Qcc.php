<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;
use Session;

class Qcc extends Model
{
    protected $table = 'qcc_register';
    protected $fillable = ['act_name','act_cat_id','act_purpose_id','act_purpose_remark','act_tool_id','act_tool_remark','act_startdate','act_enddate','before_fix',
                            'issue1','issue2','issue3','issue4','issue5','issue6','method1','method2','method3','method4','method5','method6','indicator','conceptual_framework',
                            'theory','conceptual_framework_approach','results_based_monitoring','result_vs_goal','after_fix','reduced_cost','reduced_cost_desc',
                            'available_capacity_improvement','available_capacity_improvement_desc','increase_efficiency','increase_efficiency_desc','stakeholder_fx',
                            'reduced_mat_cost','reduced_man_day','reduced_enegy_cost','reduced_worker_accident','reduced_asset_accident','satisfaction','innovation','other_stakeholder_fx',
                            'follow_up1','follow_up2','follow_up3','follow_up4','group_yr','group_id','member_h','member_c','member_m2','member_m3','member_m4','member_m5','member_m6','deptown','respondant_id', 'respondant_fay', 'respondant_clong', 'respondant_long', 'attachment_url', 'act_pass_to_present_round', 'act_prize_id', 'act_prize_order','respondant_fay', 'respondant_clong', 'respondant_long'];
    const CREATED_AT = 'crdate';
    const UPDATED_AT = 'upddate';

    public static function genGroupID($longno){

        date_default_timezone_set('Asia/Bangkok');
        $today_ym = date("ym");
        // $currentYear = date("Y");
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        if($longno == "รวห.") {
                $longid = "GAd";
        }
        else if ($longno == "รวย.") {
                $longid = "GSt";
        }
        else if ($longno == "รวบ.") {
                $longid = "GFA";
        }
        else if ($longno == "รวฟ.") {
                $longid = "GGe";
        }
        else if ($longno == "รวช.") {
                $longid = "GFu";
        }
        else if ($longno == "รวส.") {
                $longid = "GTr";
        }
        else if ($longno == "รวธ.") {
                $longid = "GPb";
        }
        else if ($longno == "รวพ.") {
                $longid = "GPR";
        }

        $n = DB::table('qcc_register')
            ->where('group_yr', $currentYear)
            ->count();

        $num = str_pad($n + 1, 3, 0, STR_PAD_LEFT);
        $v_groupid = $longid."-".$today_ym."-".$num;

        return $v_groupid;
    }

    public static function qccAdd($v_groupid){

        // $currentYear = date("Y");
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        // เตรียมค่าไว้สำหรับเข้า check condition ตัดลูกน้ำออกจาก input ก่อน insert into table
        $v_reduced_cost = Request::input('v_reduced_cost');
        $v_available_capacity_improvement = Request::input('v_available_capacity_improvement');
        $v_increase_efficiency = Request::input('v_increase_efficiency');

        $v_reduced_mat_cost = Request::input('v_reduced_mat_cost');
        $v_reduced_man_day = Request::input('v_reduced_man_day');
        $v_reduced_enegy_cost = Request::input('v_reduced_enegy_cost');
        $v_reduced_worker_accident = Request::input('v_reduced_worker_accident');
        $v_reduced_asset_accident = Request::input('v_reduced_asset_accident');
        $v_satisfaction = Request::input('v_satisfaction');
        $v_innovation = Request::input('v_innovation');
        $v_other_stakeholder_fx = Request::input('v_other_stakeholder_fx');

        if($v_reduced_cost == ''){
            $reduced_cost = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_cost = str_replace(',','',$v_reduced_cost);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_available_capacity_improvement == ''){
            $available_capacity_improvement = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $available_capacity_improvement = str_replace(',','',$v_available_capacity_improvement);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_increase_efficiency == ''){
            $increase_efficiency = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $increase_efficiency = str_replace(',','',$v_increase_efficiency);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_mat_cost == ''){
            $reduced_mat_cost = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_mat_cost = str_replace(',','',$v_reduced_mat_cost);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_man_day == ''){
            $reduced_man_day = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_man_day = str_replace(',','',$v_reduced_man_day);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_enegy_cost == ''){
            $reduced_enegy_cost = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_enegy_cost = str_replace(',','',$v_reduced_enegy_cost);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_worker_accident == ''){
            $reduced_worker_accident = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_worker_accident = str_replace(',','',$v_reduced_worker_accident);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_asset_accident == ''){
            $reduced_asset_accident = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_asset_accident = str_replace(',','',$v_reduced_asset_accident);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_satisfaction == ''){
            $satisfaction = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $satisfaction = str_replace(',','',$v_satisfaction);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_innovation == ''){
            $innovation = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $innovation = str_replace(',','',$v_innovation);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_other_stakeholder_fx == ''){
            $other_stakeholder_fx = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $other_stakeholder_fx = str_replace(',','',$v_other_stakeholder_fx);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        Qcc::create([
                    'group_yr' => $currentYear,
                    'group_id' => $v_groupid,
                    'act_name' => Request::input('v_act_name'),
                    'act_startdate' => Request::input('v_act_startdate'),
                    'act_enddate' => Request::input('v_act_enddate'),
                    'act_purpose_id' => Request::input('v_act_purpose'),
                    'act_purpose_remark' => Request::input('v_act_purpose_remark'),
                    'act_tool_id' => Request::input('v_act_tool'),
                    'act_tool_remark' => Request::input('v_act_tool_remark'),
                    'act_cat_id' => Request::input('v_act_cat'),
                    'attachment_url' => Request::input('v_attachment_url'),
                    'member_c' => Request::input('v_member_c'),

                    'member_h' => Request::input('v_member_h'),
                    'member_m2' => Request::input('v_member_m2'),
                    'member_m3' => Request::input('v_member_m3'),
                    'member_m4' => Request::input('v_member_m4'),
                    'member_m5' => Request::input('v_member_m5'),
                    'member_m6' => Request::input('v_member_m6'),

                    'before_fix' => Request::input('v_before_fix'),
                    'indicator' => Request::input('v_indicator'),
                    'conceptual_framework' => Request::input('v_conceptual_framework'),
                    'theory' => Request::input('v_theory'),

                    'km_main_knowledge1' => Request::input('km_main_knowledge1'),
                    'km_sub_knowledge1' => Request::input('km_sub_knowledge1'),
                    'knowledge_used1' => Request::input('knowledge_used1'),
                    'knowledge_format1' => Request::input('knowledge_format1'),
                    'other_knowledge_format1' => Request::input('other_knowledge_format1'),
                    'knowledge_reference1' => Request::input('knowledge_reference1'),

					'km_main_knowledge2' => Request::input('km_main_knowledge2'),
                    'km_sub_knowledge2' => Request::input('km_sub_knowledge2'),
                    'knowledge_used2' => Request::input('knowledge_used2'),
                    'knowledge_format2' => Request::input('knowledge_format2'),
                    'other_knowledge_format2' => Request::input('other_knowledge_format2'),
                    'knowledge_reference2' => Request::input('knowledge_reference2'),

                    'km_main_knowledge3' => Request::input('km_main_knowledge3'),
                    'km_sub_knowledge3' => Request::input('km_sub_knowledge3'),
                    'knowledge_used3' => Request::input('knowledge_used3'),
                    'knowledge_format3' => Request::input('knowledge_format3'),
                    'other_knowledge_format3' => Request::input('other_knowledge_format3'),
                    'knowledge_reference3' => Request::input('knowledge_reference3'),

                    'conceptual_framework_approach' => Request::input('v_conceptual_framework_approach'),

                    'results_based_monitoring' => Request::input('v_results_based_monitoring'),
                    'result_vs_goal' => Request::input('v_result_vs_goal'),
                    'after_fix' => Request::input('v_after_fix'),
                    'reduced_cost' => $reduced_cost,
                    'reduced_cost_desc' => Request::input('v_reduced_cost_desc'),
                    'available_capacity_improvement' => $available_capacity_improvement,
                    'available_capacity_improvement_desc' => Request::input('v_available_capacity_improvement_desc'),
                    'increase_efficiency' => $increase_efficiency,
                    'increase_efficiency_desc' => Request::input('v_increase_efficiency_desc'),

                    'stakeholder_fx' => Request::input('v_stakeholder_fx'),
                    'reduced_mat_cost' => $reduced_mat_cost,
                    'reduced_man_day' => $reduced_man_day,
                    'reduced_enegy_cost' => $reduced_enegy_cost,
                    'reduced_worker_accident' => $v_reduced_worker_accident,
                    'reduced_asset_accident' => $reduced_asset_accident,
                    'satisfaction' => $satisfaction,
                    'innovation' => $innovation,
                    'other_stakeholder_fx' => $other_stakeholder_fx,

                    'follow_up1' => Request::input('v_follow_up1'),
                    'follow_up2' => Request::input('v_follow_up2'),
                    'follow_up3' => Request::input('v_follow_up3'),
                    'follow_up4' => Request::input('v_follow_up4'),

                    'respondant_id' => Session::get('username'),
                    'deptown' => Session::get('user_dept'),
                    'respondant_orgno' => Session::get('user_orgno'),
                    'respondant_orgno1' => Session::get('user_orgno1'),
                    'respondant_longno' => Session::get('user_longno'),

                    'respondant_fay' => Session::get('user_fay'),
                    'respondant_clong' => Session::get('user_clong'),
                    'respondant_long' => Session::get('user_long'),

                    // 'crby' => session()->get('username'),
                    // 'updby' => session()->get('username'),
                    'crby' => Session::get('username'),
                    'updby' => Session::get('username'),
                    'crdate' => now(),
                    'upddate' => now()
        ]);
        return true;
    }

    public static function qccEdit($groupyear, $groupid){

        // เตรียมค่าไว้สำหรับเข้า check condition ตัดลูกน้ำออกจาก input ก่อน insert into table
        $v_reduced_cost = Request::input('v_reduced_cost');
        $v_available_capacity_improvement = Request::input('v_available_capacity_improvement');
        $v_increase_efficiency = Request::input('v_increase_efficiency');

        $v_reduced_mat_cost = Request::input('v_reduced_mat_cost');
        $v_reduced_man_day = Request::input('v_reduced_man_day');
        $v_reduced_enegy_cost = Request::input('v_reduced_enegy_cost');
        $v_reduced_worker_accident = Request::input('v_reduced_worker_accident');
        $v_reduced_asset_accident = Request::input('v_reduced_asset_accident');
        $v_satisfaction = Request::input('v_satisfaction');
        $v_innovation = Request::input('v_innovation');
        $v_other_stakeholder_fx = Request::input('v_other_stakeholder_fx');

        if($v_reduced_cost == ''){
            $reduced_cost = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_cost = str_replace(',','',$v_reduced_cost);// ตัดลูกน้ำออกจาก input ก่อน insert into table SOURCE : https://www.thaicreate.com/php/forum/101029.html
        }

        if($v_available_capacity_improvement == ''){
            $available_capacity_improvement = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $available_capacity_improvement = str_replace(',','',$v_available_capacity_improvement);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_increase_efficiency == ''){
            $increase_efficiency = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $increase_efficiency = str_replace(',','',$v_increase_efficiency);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_mat_cost == ''){
            $reduced_mat_cost = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_mat_cost = str_replace(',','',$v_reduced_mat_cost);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_man_day == ''){
            $reduced_man_day = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_man_day = str_replace(',','',$v_reduced_man_day);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_enegy_cost == ''){
            $reduced_enegy_cost = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_enegy_cost = str_replace(',','',$v_reduced_enegy_cost);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_worker_accident == ''){
            $reduced_worker_accident = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_worker_accident = str_replace(',','',$v_reduced_worker_accident);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_reduced_asset_accident == ''){
            $reduced_asset_accident = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $reduced_asset_accident = str_replace(',','',$v_reduced_asset_accident);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_satisfaction == ''){
            $satisfaction = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $satisfaction = str_replace(',','',$v_satisfaction);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_innovation == ''){
            $innovation = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $innovation = str_replace(',','',$v_innovation);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        if($v_other_stakeholder_fx == ''){
            $other_stakeholder_fx = 0;// ทำให้ input field ที่ไม่ใส่ค่าจะเป็น 0 by default
        } else{
            $other_stakeholder_fx = str_replace(',','',$v_other_stakeholder_fx);// ตัดลูกน้ำออกจาก input ก่อน insert into table
        }

        $qccdetail = DB::table('qcc_register')
            ->where('group_yr', '=', $groupyear)
            ->where('group_id', '=', $groupid);

        $qccdetail = $qccdetail->update([
                    'act_name' => Request::input('v_act_name'),
                    'act_startdate' => Request::input('v_act_startdate'),
                    'act_enddate' => Request::input('v_act_enddate'),
                    'act_purpose_id' => Request::input('v_act_purpose'),
                    'act_purpose_remark' => Request::input('v_act_purpose_remark'),
                    'act_tool_id' => Request::input('v_act_tool'),
                    'act_tool_remark' => Request::input('v_act_tool_remark'),
                    'act_cat_id' => Request::input('v_act_cat'),
                    'attachment_url' => Request::input('v_attachment_url'),
                    'member_c' => Request::input('v_member_c'),

                    'member_h' => Request::input('v_member_h'),
                    'member_m2' => Request::input('v_member_m2'),
                    'member_m3' => Request::input('v_member_m3'),
                    'member_m4' => Request::input('v_member_m4'),
                    'member_m5' => Request::input('v_member_m5'),
                    'member_m6' => Request::input('v_member_m6'),

                    'before_fix' => Request::input('v_before_fix'),
                    'indicator' => Request::input('v_indicator'),
                    'conceptual_framework' => Request::input('v_conceptual_framework'),
                    'theory' => Request::input('v_theory'),

                    'km_main_knowledge1' => Request::input('km_main_knowledge1'),
                    'km_sub_knowledge1' => Request::input('km_sub_knowledge1'),
                    'knowledge_used1' => Request::input('knowledge_used1'),
                    'knowledge_format1' => Request::input('knowledge_format1'),
                    'other_knowledge_format1' => Request::input('other_knowledge_format1'),
                    'knowledge_reference1' => Request::input('knowledge_reference1'),

					'km_main_knowledge2' => Request::input('km_main_knowledge2'),
                    'km_sub_knowledge2' => Request::input('km_sub_knowledge2'),
                    'knowledge_used2' => Request::input('knowledge_used2'),
                    'knowledge_format2' => Request::input('knowledge_format2'),
                    'other_knowledge_format2' => Request::input('other_knowledge_format2'),
                    'knowledge_reference2' => Request::input('knowledge_reference2'),

                    'km_main_knowledge3' => Request::input('km_main_knowledge3'),
                    'km_sub_knowledge3' => Request::input('km_sub_knowledge3'),
                    'knowledge_used3' => Request::input('knowledge_used3'),
                    'knowledge_format3' => Request::input('knowledge_format3'),
                    'other_knowledge_format3' => Request::input('other_knowledge_format3'),
                    'knowledge_reference3' => Request::input('knowledge_reference3'),
                    'conceptual_framework_approach' => Request::input('v_conceptual_framework_approach'),

                    'results_based_monitoring' => Request::input('v_results_based_monitoring'),
                    'result_vs_goal' => Request::input('v_result_vs_goal'),
                    'after_fix' => Request::input('v_after_fix'),
                    'reduced_cost' => $reduced_cost,
                    'reduced_cost_desc' => Request::input('v_reduced_cost_desc'),
                    'available_capacity_improvement' => $available_capacity_improvement,
                    'available_capacity_improvement_desc' => Request::input('v_available_capacity_improvement_desc'),
                    'increase_efficiency' => $increase_efficiency,
                    'increase_efficiency_desc' => Request::input('v_increase_efficiency_desc'),

                    'stakeholder_fx' => Request::input('v_stakeholder_fx'),
                    'reduced_mat_cost' => $reduced_mat_cost,
                    'reduced_man_day' => $reduced_man_day,
                    'reduced_enegy_cost' => $reduced_enegy_cost,
                    'reduced_worker_accident' => $v_reduced_worker_accident,
                    'reduced_asset_accident' => $reduced_asset_accident,
                    'satisfaction' => $satisfaction,
                    'innovation' => $innovation,
                    'other_stakeholder_fx' => $other_stakeholder_fx,

                    'follow_up1' => Request::input('v_follow_up1'),
                    'follow_up2' => Request::input('v_follow_up2'),
                    'follow_up3' => Request::input('v_follow_up3'),
                    'follow_up4' => Request::input('v_follow_up4'),

                    'act_pass_to_present_round' => Request::input('v_act_pass_to_present_round'),
                    'act_prize_id' => Request::input('v_act_prize'),
                    'act_prize_order' => Request::input('v_act_prize_order'),

                    // 'updby' => session()->get('username'),
                    'updby' => Session::get('username'),
                    'upddate' => now()
            ]);
        return true;
    }

    // real delete row VIEW : page-qcc-datatable
    public static function deleteQcc($groupyear, $groupid)
    {
        $deleteqccdata = DB::table('qcc_register')
            ->where('group_yr', '=', $groupyear)
            ->where('group_id', '=', $groupid);
        $deleteqccdata->delete();
        return true;
    }

    // VIEW : page-qcc-datatable
    public static function showQccList(){

        // $currentYear = date("Y");
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        // $group_id = Input::get('v_group_id');
        // $cat_name = Input::get('v_cat_name');
        $qcclist = DB::table('qcc_register')
                        ->where('group_yr', $currentYear)
                        ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'qcc_register.respondant_id');

        // เพื่อให้ admin เห็นทุกกิจกรรมของทุกฝ่าย คือถ้าไม่ใช่ admin จะ where ด้วย
        // if (session()->get('usertype_S012') != 'A' || session()->get('adminflag_S012') != 'Y' || session()->get('superadmin_S012') != 'Y') {
        if (session()->get('usertype_S012') != 'A') {
            // $qcclist = $qcclist->where('respondant_fay', '=', session()->get('user_fay'));
            $qcclist = $qcclist->where('deptown', '=', session()->get('user_dept'));
        }
        // if(Input::get('v_group_id') != ''){
        //     $qcclist = $qcclist->where('group_id','LIKE',"%$group_id%");
        // }
        // if(Input::get('v_cat_name') != ''){
        //     $qcclist = $qcclist->where('act_name','LIKE',"%$cat_name%");
        // }
        // if(Session::get('admin') != 'Y'){
        //     $qcclist = $qcclist->where('deptown','=',Session::get('orgdept'));
        // }

        // เพิ่มชื่อฝ่ายหน้า report แบบง่ายๆ
        // $registdataqcc = $registdataqcc->select('group_id','act_name','deptown', DB::raw('(select fay from hrdperson.employeedata where dept=deptown and empn=respondant_id and empstatus is null) fay'));
        $qcclist = $qcclist->select('qcc_register.group_yr',
                                    'qcc_register.group_id',
                                    'qcc_register.act_name',
                                    'qcc_register.act_cat_id',
                                    DB::raw("(case when qcc_register.act_cat_id = '1' then 'เทคนิค'
                                    when qcc_register.act_cat_id = '2' then 'สำนักงาน'
                                    end) AS act_cat "),
                                    'hrdperson.employeedata.fay',
                                    'hrdperson.employeedata.longno',
                                    'qcc_register.respondant_id',
                                    DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where hrdperson.employeedata.EMPN=qcc_register.respondant_id) AS respondant_fullname"),
                                    'qcc_register.attachment_url',
                                    'hrdperson.employeedata.telname',
                                    'hrdperson.employeedata.email',
                                    // DB::raw('(select fay from hrdperson.employeedata where empn=respondant_id and empstatus is null) fay'),
                                );
        $qcclist = $qcclist->get();
        return $qcclist;
    }

    // VIEW : page-qcc-edit
    public static function getQccDetail($groupyear, $groupid){
        // $currentYear = date("Y");
        $qccdetail = DB::table('qcc_register')
                        ->where('group_id','=',"$groupid")
                        ->where('group_yr','=',$groupyear)
                        ->select('group_yr',
                        'group_id',
                        'act_name',
                        'act_purpose_id',
                        DB::raw("(case when qcc_register.act_purpose_id = '1' then 'ลดความสูญเปล่า'
                        when qcc_register.act_purpose_id = '2' then 'เพิ่มประสิทธิภาพ'
                        when qcc_register.act_purpose_id = '3' then 'สร้างนวัตกรรม'
                        when qcc_register.act_purpose_id = 'O' then qcc_register.act_purpose_remark
                        end) AS act_purpose "),
                        'act_purpose_remark',
                        'act_tool_id',
                        DB::raw("(case when qcc_register.act_tool_id = '1' then 'QCC'
                        when qcc_register.act_tool_id = '2' then 'Kaizen'
                        when qcc_register.act_tool_id = '3' then 'Lean'
                        when qcc_register.act_tool_id = 'O' then qcc_register.act_tool_remark
                        end) AS act_tool "),
                        'act_tool_remark',
                        'act_cat_id',
                        DB::raw("(case when qcc_register.act_cat_id = '1' then 'เทคนิค'
                        when qcc_register.act_cat_id = '2' then 'สำนักงาน'
                        end) AS act_cat "),
                        'act_startdate',
                        'act_enddate',

                        'respondant_id',
                        'deptown',

                        'respondant_orgno',
                        'respondant_orgno1',
                        'respondant_longno',
                        'respondant_fay',
                        'respondant_clong',
                        'respondant_long',

                        'before_fix',
                        'indicator',
                        'conceptual_framework',
                        'theory',

                        'km_main_knowledge1',
                        'km_sub_knowledge1',
                        'knowledge_used1',
                        'knowledge_format1',
                        'other_knowledge_format1',
                        'knowledge_reference1',

                        'km_main_knowledge2',
                        'km_sub_knowledge2',
                        'knowledge_used2',
                        'knowledge_format2',
                        'other_knowledge_format2',
                        'knowledge_reference2',

                        'km_main_knowledge3',
                        'km_sub_knowledge3',
                        'knowledge_used3',
                        'knowledge_format3',
                        'other_knowledge_format3',
                        'knowledge_reference3',

                        'conceptual_framework_approach',
                        'results_based_monitoring',
                        'result_vs_goal',
                        'after_fix',
                        'reduced_cost',
                        'reduced_cost_desc',
                        'available_capacity_improvement',
                        'available_capacity_improvement_desc',
                        'increase_efficiency',
                        'increase_efficiency_desc',
                        'stakeholder_fx',
                        'reduced_mat_cost',
                        'reduced_man_day',
                        'reduced_enegy_cost',
                        'reduced_worker_accident',
                        'reduced_asset_accident',
                        'satisfaction',
                        'innovation',
                        'other_stakeholder_fx',
                        'member_c',
                        'member_h',
                        'member_m2',
                        'member_m3',
                        'member_m4',
                        'member_m5',
                        'member_m6',
                        'follow_up1',
                        'follow_up2',
                        'follow_up3',
                        'follow_up4',
                        DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_c) c_name'),
                        DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_h) h_name'),
                        DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m2) m2_name'),
                        DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m3) m3_name'),
                        DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m4) m4_name'),
                        DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m5) m5_name'),
                        DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m6) m6_name'),
                        'attachment_url',
                        'act_pass_to_present_round',
                        'act_prize_id',
                        'act_prize_order',

                        DB::raw('(select hrdperson.employeedata.fay from hrdperson.employeedata where hrdperson.employeedata.dept=qcc_register.deptown and hrdperson.employeedata.empn=qcc_register.respondant_id) AS employeedata_fay'),
                        // DB::raw('(select hrdperson.employeedata.post_name from hrdperson.employeedata where hrdperson.employeedata.fay=employeedata_fay and hrdperson.employeedata.ladumnum="12" and hrdperson.employeedata.pbloy="ผบ." and empstatus is null) AS employeedata_faypostname'),

                        )->get();
        return $qccdetail;
    }

    // สำหรับแสดงค่าในตารางประกาศผลงานที่ผ่านเข้ารอบการนำเสนอผลงาน act_pass_to_present_round VIEW : page-home
    public static function showQccPassToPresentRoundList(){

        // $currentYear = date("Y");
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qccpasstopresentroundlist = DB::table('qcc_register')
                        ->where('group_yr', $currentYear)
                        ->whereNotNull('act_pass_to_present_round')
                        ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'qcc_register.respondant_id');

        $qccpasstopresentroundlist = $qccpasstopresentroundlist->select('qcc_register.group_id',
                                    'qcc_register.group_yr',
                                    'qcc_register.act_name',
                                    'qcc_register.act_cat_id',
                                    DB::raw("(case when qcc_register.act_cat_id = '1' then 'เทคนิค'
                                    when qcc_register.act_cat_id = '2' then 'สำนักงาน'
                                    end) AS act_cat "),
                                    // 'qcc_register.respondant_id',
                                    // DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where hrdperson.employeedata.EMPN=qcc_register.respondant_id) AS respondant_fullname"),
                                    'hrdperson.employeedata.fay',
                                    'hrdperson.employeedata.longno',
                                    // 'hrdperson.employeedata.telname',
                                    // 'hrdperson.employeedata.email',
                                    // DB::raw('(select fay from hrdperson.employeedata where empn=respondant_id and empstatus is null) fay'),
                                );
        $qccpasstopresentroundlist = $qccpasstopresentroundlist->get();
        return $qccpasstopresentroundlist;
    }

    // สำหรับแสดงค่าในตารางประกาศรางวัล act_prize_id VIEW : page-home
    public static function showWonQccList(){

        // $currentYear = date("Y");
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qccwonlist = DB::table('qcc_register')
                        ->where('group_yr', $currentYear)
                        ->whereNotNull('act_pass_to_present_round')
                        ->whereNotNull('act_prize_id')
                        ->whereNotNull('act_prize_order')
                        ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'qcc_register.respondant_id');

        $qccwonlist = $qccwonlist->select('qcc_register.group_id',
                                    'qcc_register.group_yr',
                                    'qcc_register.act_name',
                                    'qcc_register.act_cat_id',
                                    DB::raw("(case when qcc_register.act_cat_id = '1' then 'เทคนิค'
                                    when qcc_register.act_cat_id = '2' then 'สำนักงาน'
                                    end) AS act_cat "),
                                    'qcc_register.act_prize_id',
                                    DB::raw("(case when qcc_register.act_prize_id = '1' then 'Gold'
                                    when qcc_register.act_prize_id = '2' then 'Silver'
                                    when qcc_register.act_prize_id = '3' then 'Bronze'
                                    end) AS act_prize "),
                                    'qcc_register.act_prize_order',
                                    // 'qcc_register.respondant_id',
                                    // DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where hrdperson.employeedata.EMPN=qcc_register.respondant_id) AS respondant_fullname"),
                                    'hrdperson.employeedata.fay',
                                    'hrdperson.employeedata.longno',
                                    // 'hrdperson.employeedata.telname',
                                    // 'hrdperson.employeedata.email',
                                    // DB::raw('(select fay from hrdperson.employeedata where empn=respondant_id and empstatus is null) fay'),
                                );
        $qccwonlist = $qccwonlist->orderBy('qcc_register.act_prize_id', 'asc')->orderBy('qcc_register.act_prize_order', 'asc')->get();
        return $qccwonlist;
    }

    public static function getActCat(){ // For Dropdown from DB View page-qcc-register
        $actcat = DB::table('qcc_act_cat')
            // ->where('orgstatus', '=', 'A')
            // ->whereNull('orgno1')
            ->select(
                'act_cat',
                'act_cat_id',
            )
            // ->orderBy(DB::raw('cast(act_cat_id as unsigned)')) //เพื่อเปลี่ยน act_cat_id จาก varchar เป็น int
            ->orderBy('act_cat_order') //เรียงตาม act_purpose_order ได้เลยเพราะเป็น int อยู่แล้ว
            ->get();
        return $actcat;
    }

    public static function getActPurpose(){ // For Dropdown from DB View page-qcc-register
        $actpurpose = DB::table('qcc_act_purpose')
            // ->where('orgstatus', '=', 'A')
            // ->whereNull('orgno1')
            ->select(
                'act_purpose',
                'act_purpose_id',
            )
            ->orderBy('act_purpose_order') //เรียงตาม act_purpose_order ได้เลยเพราะเป็น int อยู่แล้ว
            ->get();
        return $actpurpose;
    }

    public static function getActTool(){ // For Dropdown from DB View page-qcc-register
        $acttool = DB::table('qcc_act_tool')
            // ->where('orgstatus', '=', 'A')
            // ->whereNull('orgno1')
            ->select(
                'act_tool',
                'act_tool_id',
            )
            ->orderBy('act_tool_order') //เรียงตาม act_purpose_order ได้เลยเพราะเป็น int อยู่แล้ว
            ->get();
        return $acttool;
    }

    public static function getActPrize(){ // For Dropdown from DB View page-qcc-edit
        $actprize = DB::table('qcc_act_prize')
            // ->where('orgstatus', '=', 'A')
            // ->whereNull('orgno1')
            ->select(
                'act_prize',
                'act_prize_id',
            )
            ->orderBy('act_prize_order') //เรียงตาม act_prize_order ได้เลยเพราะเป็น int อยู่แล้ว
            ->get();
        return $actprize;
    }

    // สำหรับ Export Excel VIEW : page-qcc-datatable
    public static function getQccListExport(){
        // $currentYear = date("Y");
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qcclistexport = DB::table('qcc_register')
                        ->where('group_yr','=',$currentYear)
                        ->select(
                                DB::raw("ROW_NUMBER() OVER ( ORDER BY respondant_longno ASC, respondant_fay ASC) AS ROW"),
                                'group_id',
                                'act_name',
                                DB::raw("(case when qcc_register.act_cat_id = '1' then 'เทคนิค'
                                when qcc_register.act_cat_id = '2' then 'สำนักงาน'
                                end) AS act_cat "),

                                DB::raw('(select fay from hrdperson.employeedata where empstatus is null and empn=respondant_id) respondant_fay'),
                                DB::raw('(select longno from hrdperson.employeedata where empstatus is null and empn=respondant_id) respondant_longno'),
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=respondant_id) respondant_name'),
                                DB::raw('(select telname from hrdperson.employeedata where empstatus is null and empn=respondant_id) respondant_telname'),
                                DB::raw('(select email from hrdperson.employeedata where empstatus is null and empn=respondant_id) respondant_email'),

                                DB::raw("(case when qcc_register.act_purpose_id = '1' then 'ลดความสูญเปล่า'
                                when qcc_register.act_purpose_id = '2' then 'เพิ่มประสิทธิภาพ'
                                when qcc_register.act_purpose_id = '3' then 'สร้างนวัตกรรม'
                                when qcc_register.act_purpose_id = 'O' then qcc_register.act_purpose_remark
                                end) AS act_purpose "),
                                'act_purpose_remark',
                                DB::raw("(case when qcc_register.act_tool_id = '1' then 'QCC'
                                when qcc_register.act_tool_id = '2' then 'Kaizen'
                                when qcc_register.act_tool_id = '3' then 'Lean'
                                when qcc_register.act_tool_id = 'O' then qcc_register.act_tool_remark
                                end) AS act_tool "),
                                'act_tool_remark',
                                'act_startdate',
                                'act_enddate',
                                'member_c',
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_c) c_name'),

                                'member_h',
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_h) h_name'),
                                'member_m2',
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m2) m2_name'),
                                'member_m3',
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m3) m3_name'),
                                'member_m4',
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m4) m4_name'),
                                'member_m5',
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m5) m5_name'),
                                'member_m6',
                                DB::raw('(select name from hrdperson.employeedata where empstatus is null and empn=member_m6) m6_name'),

                                'before_fix',
                                'indicator',
                                'conceptual_framework',
                                'theory',
                                'conceptual_framework_approach',

                                'results_based_monitoring',
                                'after_fix',
                                'result_vs_goal',
                                'reduced_cost',
                                'reduced_cost_desc',
                                'available_capacity_improvement',
                                'available_capacity_improvement_desc',
                                'increase_efficiency',
                                'increase_efficiency_desc',

                                'stakeholder_fx',
                                'reduced_mat_cost',
                                'reduced_man_day',
                                'reduced_enegy_cost',
                                'reduced_worker_accident',
                                'reduced_asset_accident',
                                'satisfaction',
                                'innovation',
                                'other_stakeholder_fx',

                                'follow_up1',
                                'follow_up2',
                                'follow_up3',
                                'follow_up4',

                                'attachment_url'
                                )->get();
        return $qcclistexport;
    }

    //*! START QCC Dashboard Query */
    // สำหรับแสดงค่า count by act cat VIEW : page-qcc-dashboard
    public static function qccDashboardCountByActCat(){
        // $currentYear = date("Y");
        // $currentYear = 2019;
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qccdashboardcountbyactcat = DB::table('qcc_register')
                        ->where('group_yr', $currentYear)
                        ->join('qcc_act_cat', 'qcc_act_cat.act_cat_id', '=', 'qcc_register.act_cat_id');

        $qccdashboardcountbyactcat = $qccdashboardcountbyactcat->select(
                                    'qcc_act_cat.act_cat',
                                    DB::raw("(select count(group_id)) cnt_act_cat"),
                                )->groupBy('qcc_act_cat.act_cat')->get();
        return $qccdashboardcountbyactcat;
    }

    // สำหรับแสดงค่า ลดค่าใช้จ่าย, เพิ่มความพร้อมจ่าย, เพิ่มประสิทธิภาพ VIEW : page-qcc-dashboard
    public static function qccDashboardSumByCostCat(){
        // $currentYear = date("Y");
        // $currentYear = 2019;
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qccdashboardsumbycostcat = DB::table('qcc_register')
                        ->where('group_yr', $currentYear);

        $qccdashboardsumbycostcat = $qccdashboardsumbycostcat->select(
                                    DB::raw("(select sum(reduced_cost)) sum_reduced_cost"),
                                    DB::raw("(select sum(available_capacity_improvement)) sum_available_capacity_improvement"),
                                    DB::raw("(select sum(increase_efficiency)) sum_increase_efficiency"),
                                    DB::raw("(select sum(reduced_mat_cost)) sum_reduced_mat_cost"),
                                    DB::raw("(select sum(reduced_man_day)) sum_reduced_man_day"),
                                    DB::raw("(select sum(reduced_enegy_cost)) sum_reduced_enegy_cost"),
                                    DB::raw("(select sum(reduced_worker_accident)) sum_reduced_worker_accident"),
                                    DB::raw("(select sum(reduced_asset_accident)) sum_reduced_asset_accident"),
                                    DB::raw("(select sum(satisfaction)) sum_satisfaction"),
                                    DB::raw("(select sum(innovation)) sum_innovation"),
                                    DB::raw("(select sum(other_stakeholder_fx)) sum_other_stakeholder_fx"),
                                )->get();
        return $qccdashboardsumbycostcat;
    }

    //*! START QCC Dashboard Query กราฟ ผลงานแยกประเภทตามสายรอง VIEW : page-qcc-dashboard */
    public static function getLongabbr(){ // สำหรับเอาค่า longno มาใช้สร้าง label VIEW : page-qcc-dashboard
        $longabbr = DB::table('hrdperson.longno')
            ->where('longstatus', '=', 'A')
            ->select(
                'longabbr'
            )
            ->orderBy('longorder')
            ->get();

        // $longabbr = $longabbr->pluck('longabbr');
        // return response()->json($longabbr, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE); // SOURCE : https://stackoverflow.com/questions/50717005/laravel-encode-json-responses-in-utf-8
        // return response()->json(compact('longabbr'), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE); // SOURCE : https://stackoverflow.com/questions/50717005/laravel-encode-json-responses-in-utf-8
        return $longabbr;
    }

    // สำหรับแสดงค่า ผลงานแยกประเภทตามสายรอง VIEW : page-qcc-dashboard
    public static function qccDashboardSumActCatByLongno($actcatid){
        // $currentYear = date("Y");
        // $currentYear = 2019;
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qccdashboardsumactbylongno = DB::table('qcc_register')
                        ->where('group_yr', $currentYear)
                        ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'qcc_register.respondant_id')
                        ->join('qcc_act_cat', 'qcc_act_cat.act_cat_id', '=', 'qcc_register.act_cat_id');

        if($actcatid == '1'){
            $qccdashboardsumactbylongno->where('act_cat','เทคนิค');
        }else if($actcatid == '2'){
            $qccdashboardsumactbylongno->where('act_cat','สำนักงาน');
        }

        $qccdashboardsumactbylongno = $qccdashboardsumactbylongno->select(
                                    'employeedata.longno',
                                    'qcc_act_cat.act_cat',
                                    DB::raw("(select count(group_id)) cnt_act_cat_by_long"),
                                // )->groupBy('employeedata.longno','qcc_act_cat.act_cat')->get();
                                )->groupBy('employeedata.longno')->get();

        // return response()->json($qccdashboardsumactbylongno, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE); // SOURCE : https://stackoverflow.com/questions/50717005/laravel-encode-json-responses-in-utf-8
        return $qccdashboardsumactbylongno; // ส่งไปเป็น array เลย เด๋วเอาไป extract ที่ controller
    }
    //*! END QCC Dashboard Query กราฟ ผลงานแยกประเภทตามสายรอง VIEW : page-qcc-dashboard */

    // สำหรับแสดงค่า ผลงานแยกตามสายรอง VIEW : page-qcc-dashboard
    public static function qccDashboardTotalActByLongno(){
        // $currentYear = date("Y");
        // $currentYear = 2019;
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qccdashboardtotalactbylongno = DB::table('qcc_register')
                        ->where('group_yr', $currentYear)
                        ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'qcc_register.respondant_id');

        $qccdashboardtotalactbylongno = $qccdashboardtotalactbylongno->select(
                                    'employeedata.longno',
                                    DB::raw("(select count(group_id)) cnt_act_by_long"),
                                )->groupBy('employeedata.longno')->get();

        // $labels = $qccdashboardtotalactbylongno->pluck('longno');
        // $data = $qccdashboardtotalactbylongno->pluck('cnt_act_by_long');
        // return response()->json(compact('labels', 'data'), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        return $qccdashboardtotalactbylongno;
    }

    // สำหรับแสดงค่าต่างๆตามสายรอง VIEW : page-qcc-dashboard
    public static function qccDashboardVerticalBarChartDataByLongno($value){
        // $currentYear = date("Y");
        // $currentYear = 2019;
        $currentYear = Systemsetting::getQccSystemSettingYear(); //เพื่อเอาเลขปี 2020 มาใส่่ query
        $qccdashboardverticalbarchartdatabylongno = DB::table('qcc_register')
                        ->where('group_yr', $currentYear)
                        ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'qcc_register.respondant_id');
                        // ->join('qcc_act_cat', 'qcc_act_cat.act_cat_id', '=', 'qcc_register.act_cat_id');
        if($value == '1'){
            $qccdashboardverticalbarchartdatabylongno->select(
                'employeedata.longno',
                DB::raw("(select SUM(reduced_cost)) cnt_reduced_cost_by_long"));
        }else if($value == '2'){
            $qccdashboardverticalbarchartdatabylongno->select(
                'employeedata.longno',
                DB::raw("(select SUM(available_capacity_improvement)) cnt_available_capacity_improvement_by_long"));
        }else if($value == '3'){
            $qccdashboardverticalbarchartdatabylongno->select(
                'employeedata.longno',
                DB::raw("(select SUM(increase_efficiency)) cnt_increase_efficiency_by_long"));
        }

        $qccdashboardverticalbarchartdatabylongno = $qccdashboardverticalbarchartdatabylongno->groupBy('employeedata.longno')->get();

        // return response()->json($qccdashboardverticalbarchartdatabylongno, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE); // SOURCE : https://stackoverflow.com/questions/50717005/laravel-encode-json-responses-in-utf-8
        return $qccdashboardverticalbarchartdatabylongno; // ส่งไปเป็น array เลย เด๋วเอาไป extract ที่ controller
    }
    //*! END QCC Dashboard Query */

    //*! START QCC Dropdown from DB */
    // Fetch main knowledge list to dropdown
    public static function getMainKnowledgeList($knowledgelistyear)
    {
        $mainknowledgelist = DB::table('qcc_km_mainknowledge')
            ->where('mainknowledgeyear', $knowledgelistyear)
            ->select('mainknowledgeid', 'mainknowledge_name')
            ->orderBy('mainknowledge_order')
            ->get();
        return $mainknowledgelist;
    }

    // Fetch sub knowledge list to dropdown (Dependent Dropdown From DB) VIEW : page-qcc-register, page-qcc-edit
    public static function getDependentDropdownSubKnowledgeList($mainknowledgeid)
    {
        // เรียกค่า config จาก folder config ไฟล์ siteconfig ค่า knowledgelistyear
        $knowledgelistyear = config('siteconfig.knowledgelistyear');
        $subknowledgelist = DB::table('qcc_km_subknowledge')
            ->where('subknowledgeyear', $knowledgelistyear)
            ->where('mainknowledgeid', $mainknowledgeid)
            ->select('subknowledgeid', 'subknowledgename')
            ->orderBy('subknowledgeorder')
            ->get();
        return $subknowledgelist;
    }

    // Fetch knowledge format list to dropdown
    public static function getKnowledgeFormatList($knowledgelistyear)
    {
        $knowledgeformatlist = DB::table('qcc_km_knowledgeformat')
            ->where('knowledgeformatyear', $knowledgelistyear)
            ->select('knowledgeformatid', 'knowledgeformat_name')
            ->orderBy('knowledgeformat_order')
            ->get();
        return $knowledgeformatlist;
    }

    // Fetch sub knowledge list to dropdown
    // public static function getSubKnowledgeList()
    // {
    //     // เรียกค่า config จาก folder config ไฟล์ siteconfig ค่า knowledgelistyear
    //     $knowledgelistyear = config('siteconfig.knowledgelistyear');
    //     $subknowledgelist = DB::table('qcc_km_subknowledge')
    //         ->where('subknowledgeyear', $knowledgelistyear)
    //         ->select('subknowledgeid', 'subknowledgename', 'mainknowledgeid')
    //         ->orderBy('subknowledgeorder')
    //         ->get();
    //     return $subknowledgelist;
    // }

    // Fetch sub knowledge list to dropdown
    public static function getSubKnowledgeList1($km_main_knowledge1)
    {
        // เรียกค่า config จาก folder config ไฟล์ siteconfig ค่า knowledgelistyear
        $knowledgelistyear = config('siteconfig.knowledgelistyear');
        $subknowledgelist1 = DB::table('qcc_km_subknowledge')
            ->where('subknowledgeyear', $knowledgelistyear)
            ->where('mainknowledgeid', $km_main_knowledge1)
            ->select('subknowledgeid', 'subknowledgename', 'mainknowledgeid')
            ->orderBy('subknowledgeorder')
            ->get();
        return $subknowledgelist1;
    }

    public static function getSubKnowledgeList2($km_main_knowledge2)
    {
        // เรียกค่า config จาก folder config ไฟล์ siteconfig ค่า knowledgelistyear
        $knowledgelistyear = config('siteconfig.knowledgelistyear');
        $subknowledgelist2 = DB::table('qcc_km_subknowledge')
            ->where('subknowledgeyear', $knowledgelistyear)
            ->where('mainknowledgeid', $km_main_knowledge2)
            ->select('subknowledgeid', 'subknowledgename', 'mainknowledgeid')
            ->orderBy('subknowledgeorder')
            ->get();
        return $subknowledgelist2;
    }

    public static function getSubKnowledgeList3($km_main_knowledge3)
    {
        // เรียกค่า config จาก folder config ไฟล์ siteconfig ค่า knowledgelistyear
        $knowledgelistyear = config('siteconfig.knowledgelistyear');
        $subknowledgelist3 = DB::table('qcc_km_subknowledge')
            ->where('subknowledgeyear', $knowledgelistyear)
            ->where('mainknowledgeid', $km_main_knowledge3)
            ->select('subknowledgeid', 'subknowledgename', 'mainknowledgeid')
            ->orderBy('subknowledgeorder')
            ->get();
        return $subknowledgelist3;
    }
    //*! END QCC Dropdown from DB */
}
