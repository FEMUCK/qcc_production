<?php

namespace App\Http\Controllers;

use App\Qcc;
use App\QccUsers;
use App\Systemsetting;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Session;
// use Request;
class PageController extends Controller
{
    //*! START QCC Application */
    // page controller is protected with login middleware SOURCE : https://laracasts.com/discuss/channels/laravel/laravel-prevent-automatic-redirect-to-login
    public function __construct(){
        $this->middleware('login');
    }

    public function homePage(){
        // สำหรับแสดงค่า System Setting จาก Database
        $data['systemsettingdata'] = Systemsetting::getSystemSettingData();

        // For Coordinator Table Content
        $data['coordinatorlistdata'] = QccUsers::getCoordinatorList();
        // สำหรับแสดงค่าในตารางประกาศรางวัล act_prize_id VIEW : page-home
        $data['qccwonlist'] = Qcc::showWonQccList();
        // สำหรับแสดงค่าในตารางประกาศผลงานที่ผ่านเข้ารอบการนำเสนอผลงาน act_pass_to_present_round VIEW : page-home
        $data['qccpasstopresentroundlist'] = Qcc::showQccPassToPresentRoundList();

        // สำหรับแสดงค่า SYSYEAR จาก Database
        $data['qccsystemyear'] = Systemsetting::getQccSystemSettingYear();
        // สำหรับแสดงค่า SYS STRT DATE จาก Database
        $data['qccsystemstrtdate'] = Systemsetting::getQccSystemStrtDate();
        // สำหรับแสดงค่า SYS END DATE จาก Database
        $data['qccsystemenddate'] = Systemsetting::getQccSystemEndDate();

        $breadcrumbs = [
            // ['link' => "page-home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Home Page"],
            ['name' => "Home Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('pages.page-home', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('data', $data);
    }

    public function qccDashboardPage(){
        //  สำหรับแสดงค่า count by act cat VIEW : page-qcc-dashboard
        $data['cntbyactcat'] = Qcc::qccDashboardCountByActCat();
        //  สำหรับแสดงค่า ลดค่าใช้จ่าย, เพิ่มความพร้อมจ่าย, เพิ่มประสิทธิภาพ ฯลฯ VIEW : page-qcc-dashboard
        $data['sumbycostcat'] = Qcc::qccDashboardSumByCostCat();

        // navbar large
        $pageConfigs = ['navbarLarge' => false];

        return view('/pages/page-qcc-dashboard', ['pageConfigs' => $pageConfigs])->with('data', $data);
    }

    //*! START สำหรับดึงข้อมูลผลงานแยกประเภทตามสายรอง VIEW : page-qcc-dashboard */
    public function getHorizontalBarChartData(){
        // สำหรับเอาค่า longno มาใช้
        $longabbr = Qcc::getLongabbr(); // เอาไว้ใช้ใน function นี้เป็นหลัก // เป็น array
        // return $long;
        $labels = $longabbr->pluck('longabbr');
        // $labels = ["ผวก.", "รวห.", "รวย.", "รวบ.", "รวฟ.", "รวช.", "รวส.", "รวธ.", "รวพ."];
        $data1 = Qcc::qccDashboardSumActCatByLongno("1");
        $data2 = Qcc::qccDashboardSumActCatByLongno("2");

        // echo count($long);
        // dd ($long);
        //print_r($data1);

        $datatechnique_array = array();
        $dataoffice_array = array();
        foreach ($longabbr as $longabbr_item) { // Outer Loop for longabbr
            //echo $long_item->longabbr."<br>";
            $longabbr = $longabbr_item->longabbr;

            $cnt1 = 0;
            foreach($data1 as $data1_item){  // Inner Loop for datatechnique
                if($longabbr == $data1_item->longno){
                    array_push($datatechnique_array, $data1_item->cnt_act_cat_by_long);
                    $cnt1 = 1;
                    //echo $longabbr."=>".$data1_item->cnt_act_cat_by_long."<br>";
                }
            }
            if($cnt1 == 0){
                array_push($datatechnique_array,0);
                //echo $longabbr."=>0<br>";
            }

            $cnt2 = 0;
            foreach($data2 as $data2_item){  // Inner Loop for dataoffice
                if($longabbr == $data2_item->longno){
                    array_push($dataoffice_array, $data2_item->cnt_act_cat_by_long);
                    $cnt2 = 1;
                }
            }
            if($cnt2 == 0){
                array_push($dataoffice_array,0);
            }
        }
        //echo "<br>";
        //print_r($cnt_act_cat_by_long_array);
        // $datatechnique = array();
        $datatechnique = $datatechnique_array;
        // array_push($datatechnique, 0,11,1,1,0,1,3,11,25);
        $dataoffice = $dataoffice_array;

        return response()->json(compact('labels','datatechnique','dataoffice'), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //*! END สำหรับดึงข้อมูลผลงานแยกประเภทตามสายรอง VIEW : page-qcc-dashboard */

    // สำหรับแสดงค่าต่างๆตามสายรอง VIEW : page-qcc-dashboard
    public function getVerticalBarChartData(){
        // สำหรับเอาค่า longno มาใช้
        $longabbr = Qcc::getLongabbr(); // เอาไว้ใช้ใน function นี้เป็นหลัก // เป็น array
        $labels = $longabbr->pluck('longabbr');
        $data1 = Qcc::qccDashboardVerticalBarChartDataByLongno("1");
        $data2 = Qcc::qccDashboardVerticalBarChartDataByLongno("2");
        $data3 = Qcc::qccDashboardVerticalBarChartDataByLongno("3");

        $reduced_cost_array = array();
        $available_capacity_improvement_array = array();
        $increase_efficiency_array = array();
        foreach ($longabbr as $longabbr_item) { // Outer Loop for longabbr
            $longabbr = $longabbr_item->longabbr;

            $cnt1 = 0;
            foreach($data1 as $data1_item){  // Inner Loop for datatechnique
                if($longabbr == $data1_item->longno){
                    array_push($reduced_cost_array, $data1_item->cnt_reduced_cost_by_long);
                    $cnt1 = 1;
                }
            }
            if($cnt1 == 0){
                array_push($reduced_cost_array,0);
            }

            $cnt2 = 0;
            foreach($data2 as $data2_item){  // Inner Loop for dataoffice
                if($longabbr == $data2_item->longno){
                    array_push($available_capacity_improvement_array, $data2_item->cnt_available_capacity_improvement_by_long);
                    $cnt2 = 1;
                }
            }
            if($cnt2 == 0){
                array_push($available_capacity_improvement_array,0);
            }

            $cnt3 = 0;
            foreach($data3 as $data3_item){  // Inner Loop for dataoffice
                if($longabbr == $data3_item->longno){
                    array_push($increase_efficiency_array, $data3_item->cnt_increase_efficiency_by_long);
                    $cnt3 = 1;
                }
            }
            if($cnt3 == 0){
                array_push($increase_efficiency_array,0);
            }
        }
        $data_reduced_cost = $reduced_cost_array;
        $data_available_capacity_improvement = $available_capacity_improvement_array;
        $data_increase_efficiency = $increase_efficiency_array;

        return response()->json(compact('labels','data_reduced_cost','data_available_capacity_improvement','data_increase_efficiency'), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    // สำหรับดึงข้อมูลจำนวนผลงานแยกตามสายรอง VIEW : page-qcc-dashboard
    public function getPolarChartData(){
        // return Qcc::qccDashboardTotalActByLongno();

        // สำหรับเอาค่า longno มาใช้
        $longabbr = Qcc::getLongabbr(); // เอาไว้ใช้ใน function นี้เป็นหลัก // เป็น array
        $labels = $longabbr->pluck('longabbr');
        $data =  Qcc::qccDashboardTotalActByLongno();

        $cnt_act_by_long_array = array();
        foreach ($longabbr as $longabbr_item) { // Outer Loop for longabbr
            $longabbr = $longabbr_item->longabbr;

            $cnt = 0;
            foreach($data as $data_item){  // Inner Loop for datatechnique
                if($longabbr == $data_item->longno){
                    array_push($cnt_act_by_long_array, $data_item->cnt_act_by_long);
                    $cnt = 1;
                }
            }
            if($cnt == 0){
                array_push($cnt_act_by_long_array,0);
            }
        }
        $data_cnt_act_by_long = $cnt_act_by_long_array;
        return response()->json(compact('labels','data_cnt_act_by_long'), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function qccRegisterPage(){
        // For Dropdown from DB
        $data['actcat'] = Qcc::getActCat();
        $data['actpurpose'] = Qcc::getActPurpose();
        $data['acttool'] = Qcc::getActTool();

        // เรียกค่า config จาก folder config ไฟล์ siteconfig ค่า knowledgelistyear
        $knowledgelistyear = config('siteconfig.knowledgelistyear');
        $data['mainknowledgelist'] = Qcc::getMainKnowledgeList($knowledgelistyear);
        $data['knowledgeformatlist'] = Qcc::getKnowledgeFormatList($knowledgelistyear);

        // สำหรับแสดงค่า System Setting จาก Database
        $data['systemsettingdata'] = Systemsetting::getSystemSettingData();

        $breadcrumbs = [
            ['link' => "page-home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "QCC Register"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('pages.page-qcc-register', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('data', $data);
    }

    public function qccDataTablePage(){
        // For Dependent Dropdown
        $data['longno'] = QccUsers::getLongno();
        // For Dropdown from DB
        $data['actcat'] = Qcc::getActCat();
        // For QCC Table Content
        $data['qcclist'] = Qcc::showQccList();

        // สำหรับแสดงค่า System Setting จาก Database
        $data['systemsettingdata'] = Systemsetting::getSystemSettingData();

        $breadcrumbs = [
            ['link' => "page-home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "QCC Data Table"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('pages.page-qcc-datatable', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('data', $data);
    }

    public function qccSystemSetting(){
        // สำหรับแสดงค่า System Setting จาก Database
        $data['systemsettingdata'] = Systemsetting::getSystemSettingData();
        // สำหรับแสดงค่า SYSYEAR จาก Database
        $data['qccsystemyear'] = Systemsetting::getQccSystemSettingYear();
        // สำหรับแสดงค่า SYS STRT DATE จาก Database
        $data['qccsystemstrtdate'] = Systemsetting::getQccSystemStrtDate();
        // สำหรับแสดงค่า SYS END DATE จาก Database
        $data['qccsystemenddate'] = Systemsetting::getQccSystemEndDate();

        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "page-home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages "], ['name' => "System Setting"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

        if(session()->get('usertype_S012') == 'A'){
            return view('pages.page-qcc-system-setting', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs])->with('data', $data);
        }else{
            return redirect()->route('page-qcc-403');
        }
    }

    public function qccUsersListPage(){
        // For Dependent Dropdown
        $data['longno'] = QccUsers::getLongno();
        // For Users Table Content
        $data['userslistdata'] = QccUsers::getUsersList();

        $breadcrumbs = [
            ['link' => "page-home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "QCC Users List"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        if(session()->get('usertype_S012') == 'A'){
            return View::make('pages.page-qcc-users-list', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('data', $data);
        }else{
            return redirect()->route('page-qcc-403');
        }
    }

    // START Dependent Dropdown VIEW page-qcc-users-list
    public function getFay($longno){
        return QccUsers::getFayList(request()->longno);
    }
    // END Dependent Dropdown VIEW page-qcc-users-list

    // START สำหรับ onkeyup 'addQccAuthForm' VIEW page-qcc-users-list
    public function getUsersData($userid){
        return QccUsers::getUsersData($userid);
    }
    // END สำหรับ onkeyup 'addQccAuthForm' VIEW page-qcc-users-list

    public function addQccAuth(){
        QccUsers::addQccAuth();
        // echo Request::input('idinput');
        // echo Request::input('usertype');
        return back();
    }

    public function deleteQccAuth($userid){
        QccUsers::deleteQccAuth($userid);
        return back();
    }

    // public function qccView()
    public function qccView($groupyear, $groupid){
        // For put data from DB into Input Field
        $data['qccdetail'] = Qcc::getQccDetail($groupyear, $groupid);

        // สำหรับแสดงค่า System Setting จาก Database
        $data['systemsettingdata'] = Systemsetting::getSystemSettingData();

        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        // return view('pages.page-qcc-view', ['pageConfigs' => $pageConfigs]);
        return view('pages.page-qcc-view', ['pageConfigs' => $pageConfigs])->with('data', $data);
    }

    public function qccEdit($groupyear, $groupid){
        // เพื่อรับค่า parameter จาก URL
        // $groupyear = $data['groupyear'];
        // $groupid = $data['groupid'];

        // สำหรับแสดงค่า System Setting จาก Database
        $data['systemsettingdata'] = Systemsetting::getSystemSettingData();

        // For Dropdown from DB
        $data['actcat'] = Qcc::getActCat();
        $data['actpurpose'] = Qcc::getActPurpose();
        $data['acttool'] = Qcc::getActTool();
        $data['actprize'] = Qcc::getActPrize();

        // เรียกค่า config จาก folder config ไฟล์ siteconfig ค่า knowledgelistyear
        $knowledgelistyear = config('siteconfig.knowledgelistyear');
        $data['mainknowledgelist'] = Qcc::getMainKnowledgeList($knowledgelistyear);
        $data['knowledgeformatlist'] = Qcc::getKnowledgeFormatList($knowledgelistyear);


        // For put data from DB into Input Field
        $data['qccdetail'] = Qcc::getQccDetail($groupyear, $groupid);
        // ใช้ foreach เพื่อเอาเฉพาะค่าที่ต้องการใช้ออกมาจาก Array
        $qccdetaildata = $data['qccdetail'];
        foreach($qccdetaildata as $qccdetaildata_item){
            $km_main_knowledge1 = $qccdetaildata_item->km_main_knowledge1;
            $km_main_knowledge2 = $qccdetaildata_item->km_main_knowledge2;
            $km_main_knowledge3 = $qccdetaildata_item->km_main_knowledge3;
        }
        $data['subknowledgelist1'] = Qcc::getSubKnowledgeList1($km_main_knowledge1);
        $data['subknowledgelist2'] = Qcc::getSubKnowledgeList2($km_main_knowledge2);
        $data['subknowledgelist3'] = Qcc::getSubKnowledgeList3($km_main_knowledge3);

        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('pages.page-qcc-edit', ['pageConfigs' => $pageConfigs])->with('data', $data);
    }

    public function qccDelete($groupyear, $groupid){
        Qcc::deleteQcc($groupyear, $groupid);
        return back();
    }

    // ไว้เรียกค่า Dependent Dropdown form DB VIEW : page-qcc-register, page-qcc-edit
    public function getDependentDropdownSubKnowledgeList($mainknowledgeid){
        return Qcc::getDependentDropdownSubKnowledgeList($mainknowledgeid);
    }
    //*! END QCC Application */
}
