<?php

namespace App\Http\Controllers;

class MiscController extends Controller
{
    //*! ใช้สำหรับตอนเปิด QCC Maintenance **/
    public function QccMaintenancePage(){
        // custome class and customizer remove
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image', 'isCustomizer' => false];
        return view('pages.page-qcc-maintenance', ['pageConfigs' => $pageConfigs]);
    }
    //*! ใช้สำหรับป้องกันการ force url เข้าในส่วนของ admin **/
    public function Qcc403Page(){
        // custome class and customizer remove
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image', 'isCustomizer' => false];

        return view('pages.page-qcc-403', ['pageConfigs' => $pageConfigs]);
    }
    //*! ใช้สำหรับ Handle การ login ของ user ที่ไม่มีสิทธิ์เข้าระบบ **/
    public function QccAccessDenied(){
        // custome class and customizer remove
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image', 'isCustomizer' => false];

        return view('pages.page-qcc-access-denied', ['pageConfigs' => $pageConfigs]);
    }
}
