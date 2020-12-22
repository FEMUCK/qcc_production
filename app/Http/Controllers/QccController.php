<?php

namespace App\Http\Controllers;

use App\Qcc;
use App\QccUsers;
use Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Session;

class QccController extends Controller
{
	public function qccAdd() {

        // $org = User::getFay1(Session::get('user'));
        // if($org == ''){
        //     $org = User::getLong(Session::get('user')); //ถ้า org = null ให้ call getlong แล้วเอาค่ามาใส่ null
        // }
        // $org = 'รวห.';
        $org = Session::get('user_long');
        $v_groupid = Qcc::genGroupID($org);
        // // $currentYear = 2020;
        // // $v_groupid = 'GTr-S-1904-086';
        Qcc::qccAdd($v_groupid); //เพื่อ save data to DB
        // return true;
        // $data['dis'] = 'Y';

        // For put data from DB into Input Field เด๋วหาวิธีส่ง group yr ไป
        // $data['qccdetail'] = Qcc::getQccDetail($currentYear, $groupid);

        // return View::make('pages.page-qcc-datatable')->with('data', $data);

        // For Dependent Dropdown
        $data['longno'] = QccUsers::getLongno();
        // For Dropdown from DB
        $data['actcat'] = Qcc::getActCat();
        // For QCC Table Content
        $data['qcclist'] = Qcc::showQccList();

        $breadcrumbs = [
            ['link' => "page-home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "QCC Data Table"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.page-qcc-datatable', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('data', $data);
    // echo $v_groupid;
    }

    public function qccEdit() {
        // echo "qcc edit controller";
        // Method post ใช้ $data ไม่ได้
        $groupyear = Request::input('v_group_yr');
        $groupid = Request::input('v_groupid');

        Qcc::qccEdit($groupyear, $groupid); //เพื่อ save data to DB
        // Qcc::qccEdit(); //เพื่อ save data to DB

        // For Dropdown from DB
        $data['actcat'] = Qcc::getActCat();
        $data['actpurpose'] = Qcc::getActPurpose();
        $data['acttool'] = Qcc::getActTool();
        $data['actprize'] = Qcc::getActPrize();

        // For put data from DB into Input Field
        $data['qccdetail'] = Qcc::getQccDetail($groupyear, $groupid);

        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        // return view('pages.page-qcc-edit', ['pageConfigs' => $pageConfigs])->with('data', $data);
        return redirect()->back()->with('data', $data);
    }
}
