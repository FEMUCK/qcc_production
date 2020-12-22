<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserProfile extends Model
{
    // protected $table = 'hrdperson.employeedata';
    // เช็คสิทธิ์ว่ามีอยู่ใน S002 table hrdreport_userlogon หรือไม่
    public static function chkPrivilege($username)
    {
        $privs = DB::table('hrdperson.employeedata')
            ->join('hrdperson.hrdreport_userlogon', 'hrdperson.employeedata.empn', '=', 'hrdperson.hrdreport_userlogon.userid')
            ->whereNull('hrdperson.employeedata.empstatus')
            ->where('hrdperson.employeedata.empn', '=', $username)
            // ->where('sysno', '=', config('siteconfig.sysno'))
            ->where('hrdperson.hrdreport_userlogon.sysno', '=',"S012")
            // ->whereIn('sysno', ['S002', 'S003'])
            ->value('hrdperson.hrdreport_userlogon.userid');

        if ($privs == '') {
            $priv = 'N';
        } else {
            $priv = 'Y';
        }

        return $priv;
    }

    // ใช้สำหรับดึงค่าของ user ที่ใช้ร่วมกันทุก sysno ไปเก็บใน session
    public static function getUserProfileHead($username)
    {
        $userprofileshead = DB::table('hrdperson.employeedata')
            ->whereNull('hrdperson.employeedata.empstatus')
            ->where('hrdperson.employeedata.empn', '=', $username)
            ->select('hrdperson.employeedata.empn',
                // 'employeedata.telname',
                'hrdperson.employeedata.dept as user_dept',
                'hrdperson.employeedata.fay as user_fay',
                'hrdperson.employeedata.clong as user_clong',
                'hrdperson.employeedata.longno as user_long',
                'hrdperson.employeedata.TelName',
                DB::raw("(select CONCAT (pnang, ' ' ,gong, ' ' ,fay, '  ' ,clong, '  ' ,longno) from hrdperson.employeedata where hrdperson.employeedata.EMPN=$username) AS user_subject"),
                DB::raw("(select CONCAT (pnang, ' ' ,gong) from hrdperson.employeedata where hrdperson.employeedata.empn=$username) AS user_pg"),
                DB::raw("(select CONCAT (title,name) from hrdperson.employeedata where hrdperson.employeedata.empn=$username) AS user_fullname"),
                // DB::raw("(select picpath from hrdperson.employee_pic where empno=$empno) AS user_pic"),
                DB::raw("(select ImageWeb from hrdperson.employeedata where hrdperson.employeedata.empn=$username) AS user_pic"),
                DB::raw("(select orgno from hrdperson.hrdsummary_organization_trainneed where hrdperson.employeedata.fay = hrdperson.hrdsummary_organization_trainneed.orgabbr and hrdperson.hrdsummary_organization_trainneed.orgstatus = 'A') AS user_orgno"), //ใว้ใช้ตอน trnneed_quota
                DB::raw("(select orgno1 from hrdperson.hrdsummary_organization_trainneed where hrdperson.employeedata.fay = hrdperson.hrdsummary_organization_trainneed.orgabbr and hrdperson.hrdsummary_organization_trainneed.orgstatus = 'A') AS user_orgno1"), //ใว้ใช้ตอน trnneed_quota
                DB::raw("(select longno from hrdperson.hrdsummary_organization_trainneed where hrdperson.employeedata.fay = hrdperson.hrdsummary_organization_trainneed.orgabbr and hrdperson.hrdsummary_organization_trainneed.orgstatus = 'A') AS user_longno"), //ใว้ใช้ตอน trnneed_quota
            )
            ->get();
        return $userprofileshead;
    }

    // เพื่อแยกว่ามีสิทธิ์อยู่ใน SYSNO ไหนบ้าง แล้วต้องใช้ foreeach แตกค่าออก เอาตัวแปรมารับ มาเหมือน module systemsetting
    public static function getUserSysnoPermission($username, $sysno)
    {
        $syspermission = DB::table('hrdperson.employeedata')
            ->join('hrdperson.hrdreport_userlogon', 'hrdperson.employeedata.empn', '=', 'hrdperson.hrdreport_userlogon.userid')
            ->whereNull('hrdperson.employeedata.empstatus')
            ->where('hrdperson.employeedata.empn', '=', $username)
            ->where('hrdperson.hrdreport_userlogon.sysno', '=',"$sysno")
            ->select(
                DB::raw("IFNULL((select 'Y' from hrdperson.hrdreport_userlogon where hrdperson.hrdreport_userlogon.userid=$username and hrdperson.hrdreport_userlogon.sysno='$sysno'),'N') 'sysno'")
            )->get();
		$syspermission_value = 'N'; // default var ในกรณีไม่มีข้อมูล แล้วไม่เข้า foreach
        foreach ($syspermission as $syspermission_item) {
            $syspermission_value = $syspermission_item->sysno;
        }
        return $syspermission_value;
    }

    // ใช้สำหรับดึงค่าของ user จาก sysno นั้นๆไปเก็บใน session
    public static function getUserProfileBody($username, $sysno){
        $userprofilesbody = DB::table('hrdperson.employeedata')
        ->join('hrdperson.hrdreport_userlogon', 'hrdperson.employeedata.empn', '=', 'hrdperson.hrdreport_userlogon.userid')
        ->where('hrdperson.employeedata.empn', '=', $username)
        ->where('hrdperson.hrdreport_userlogon.sysno', '=',"$sysno")
        ->whereNull('hrdperson.employeedata.empstatus')
        ->select(
            'hrdperson.employeedata.EMPN',
            'hrdperson.hrdreport_userlogon.usertype',
            'hrdperson.hrdreport_userlogon.superadmin',
            'hrdperson.hrdreport_userlogon.adminflag'
        )
        ->get();
        return $userprofilesbody;
    }
}
