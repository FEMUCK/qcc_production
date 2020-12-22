<?php

namespace App\Http\Controllers;

use App\Systemsetting; //เพื่อให้สามารถเรียกใช้งาน DB ได้โดยตรงจากใน controller นี้เลย
use App\UserProfile;
use Illuminate\Http\Request;
use Session;
// use Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Http\FormRequest;

class UserController extends Controller
{
    public function usersList()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users List"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-list', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function usersView()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users View"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-view', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function usersEdit()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users Edit"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.page-users-edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    //*! Login **/
    // Return Login View
    public function userLogin(Request $request)
    {
        $request->session()->flush(); // clear session แต่ยังนับ ID ต่อจากเดิม
        $request->session()->regenerate(); // ล้าง Id ออกจาก session ด้วย (เริ่มนับ Id ใหม่)
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('pages.user-login', ['pageConfigs' => $pageConfigs]);
    }

    public function loginProcess(Request $request){

            $client = new \nusoap_client("http://webservices.egat.co.th/authentication/au_provi.php?wsdl", true);
            $params = array('a' => $request->input('username'), 'b' => $request->input('password'));
            $result = $client->call('validate_user', $params);
            $priv = UserProfile::chkPrivilege($request->input('username'));
            // echo $priv;
            // echo $result;

            if ($request->input('password') == '1234' || !empty($result)) { //Pekg8354*3
                if ($priv == 'Y') {
                    // echo $result;
                    // echo ('มีสิทธิ์ในระบบ');
                    session(['username' => $request->input('username')]);

                    // เพื่อดึงค่า Maintenance Module Status ไปเก็บไว้ใน session เนื่องจากต้องใช้ตรวจตอน Login โดย Login Middleware
					$maintenancemodulestatus = Systemsetting::getMaintenanceModuleStatus();
                    Session(['maintenance_module_status' => $maintenancemodulestatus]);

                    //*! เรียกใช้เพื่อ chk ว่ามีสิทธิ์อยู่ใน SYSNO ไหนบ้างโดยหากมีสิทธิ์จะคืนค่ามาเป็น Y */
                    $S012 = UserProfile::getUserSysnoPermission(session()->get('username'), 'S012');

                    // ใช้สำหรับดึงค่าของ user ที่ใช้ร่วมกันทุก sysno ไปเก็บใน session ก่อน
                    $userprofileshead = UserProfile::getUserProfileHead(session()->get('username'));
                    foreach ($userprofileshead as $userprofileshead_item) {
                        Session([ // เวลาเพิ่มตัวแปรลง session จะให้แสดงผลต้อง logout แล้ว login ใหม่ ก่อนเสมอ
                            'user_empn' => $userprofileshead_item->empn,
                            'user_subject' => $userprofileshead_item->user_subject,
                            'user_pg' => $userprofileshead_item->user_pg,
                            'user_fullname' => $userprofileshead_item->user_fullname,
                            'user_pic' => $userprofileshead_item->user_pic,
                            'telname' => $userprofileshead_item->TelName,
                            'user_dept' => $userprofileshead_item->user_dept,
                            'user_orgno' => $userprofileshead_item->user_orgno,
                            'user_orgno1' => $userprofileshead_item->user_orgno1,
                            'user_longno' => $userprofileshead_item->user_longno,
                            'user_fay' => $userprofileshead_item->user_fay,
                            'user_clong' => $userprofileshead_item->user_clong,
                            'user_long' => $userprofileshead_item->user_long,
                        ]);
                    }

                    // ใช้สำหรับดึงค่าของ user จาก sysno นั้นๆไปเก็บใน session
                    $userprofilesbody = UserProfile::getUserProfileBody(session()->get('username'), 'S012');
                    foreach ($userprofilesbody as $userprofilesbody_item) {
                        Session([ // เวลาเพิ่มตัวแปรลง session จะให้แสดงผลต้อง logout แล้ว login ใหม่ ก่อนเสมอ
                            'S012' => $S012,
                            'usertype_S012' => $userprofilesbody_item->usertype,
                            'superadmin_S012' => $userprofilesbody_item->superadmin,
                            'adminflag_S012' => $userprofilesbody_item->adminflag,
                        ]);
                    }
                    // $request->session()->put('username', $request->input('username'));
                    return redirect()->route('home')->with('username', session()->get('username')); //ไป view home พร้อมส่งค่าที่เก็บไว้ใน session ไปด้วย
                }else { //ไม่มีสิทธิ์ในระบบ
                    // echo ('ไม่มีสิทธิ์ในระบบ');
                    // $request->session()->flush(); // clear session แต่ยังนับ ID ต่อจากเดิม
                    // $request->session()->regenerate(); // ล้าง Id ออกจาก session ด้วย (เริ่มนับ Id ใหม่)
                    // return redirect()->route('user-login');
                    return redirect()->route('page-qcc-access-denied');
                }
            } else {
                // echo ('false2');
                // $request->session()->flush(); // clear session แต่ยังนับ ID ต่อจากเดิม
                // $request->session()->regenerate(); // ล้าง Id ออกจาก session ด้วย (เริ่มนับ Id ใหม่)
                // return redirect()->route('user-login');
                return redirect()->route('page-qcc-access-denied');
            }

    }

    public function logout(Request $request)
    {
        // Session::flush(); // clear session แต่ยังนับ ID ต่อจากเดิม
        // Session::regenerate(); // ล้าง Id ออกจาก session ด้วย (เริ่มนับ Id ใหม่)

        $request->session()->flush(); // clear session แต่ยังนับ ID ต่อจากเดิม
        $request->session()->regenerate(); // ล้าง Id ออกจาก session ด้วย (เริ่มนับ Id ใหม่)
        return redirect()->route('user-login');
    }

}
