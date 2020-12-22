<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request; // https://laravel.com/docs/6.x/upgrade#the-input-facade , https://nelisys.com/tutorials/laravel-7-using-model-to-create-and-read

class QccUsers extends Model
{
    protected $table = 'hrdperson.hrdreport_userlogon';
    protected $fillable = ['userid', 'dept', 'sectno', 'divno', 'sysno', 'usertype', 'keyflag', 'adminflag','superadmin', 'longno', 'fay', 'telname', 'crby', 'updby', 'crdate', 'upddate', 'note'];
    const CREATED_AT = 'crdate';
    const UPDATED_AT = 'upddate';

    public static function addQccAuth()
    {
        $usertypeinput = Request::input('usertype');
        if($usertypeinput == 'Superadmin'){
            $usertype = 'A';
            $adminflag = 'Y';
            $superadmin = 'Y';
        }elseif($usertypeinput == 'A'){
            $usertype = 'A';
            $adminflag = 'Y';
            $superadmin = null;
        }elseif($usertypeinput == 'R'){
            $usertype = $usertypeinput;
            $adminflag = null;
            $superadmin = null;
        }
        QccUsers::create([
            'userid' => Request::input('idinput'),
            'usertype' => $usertype,
            'adminflag' => $adminflag,
            'superadmin' => $superadmin,
            'sysno' => 'S012',
            'crby' => session()->get('username'),
            'crdate' => now(),
            'upddate' => now()
        ]);
        return true;
    }

    public static function deleteQccAuth($userid)
    {
        DB::table('hrdperson.hrdreport_userlogon')
            // ->where('sysno', '=', config('siteconfig.sysno'))
            ->where('sysno', '=', 'S012')
            ->where('userid', '=', $userid)
            ->delete();
        return true;
    }

    // ใช้แสดงข้อมูล Coordinator ใน VIEW page-home
    public static function getCoordinatorList()
    {
        $coordinatorlistdata = DB::table('hrdperson.hrdreport_userlogon')
            ->where('sysno', '=', 'S012')
            ->whereIn('userid',[590610,590948,596925,597113])
            ->join('hrdperson.employeedata', 'hrdperson.hrdreport_userlogon.USERID', '=', 'hrdperson.employeedata.EMPN')
            ->whereNull('employeedata.empstatus')
            ->select(
                'userid',
                'sysno',
                'usertype',
                DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where employeedata.EMPN=hrdreport_userlogon.USERID) AS users_fullname"),
                'hrdperson.employeedata.pabbr',
                'hrdperson.employeedata.longno',
                'hrdperson.employeedata.fay',
                'hrdperson.employeedata.gong',
                'hrdperson.employeedata.pnang',
                'hrdperson.employeedata.telname',
                'hrdperson.employeedata.email',
                'hrdperson.employeedata.ImageWeb AS users_pic',
                'hrdperson.employeedata.stras',
            )
        // ->orderBy(DB::raw('cast(courseid as unsigned)')) //เพื่อเปลี่ยน courseid จาก varchar เป็น int
            ->get();
        return $coordinatorlistdata;
    }

    // ใช้แสดงข้อมูล Users ใน VIEW page-qcc-users-list
    public static function getUsersList()
    {
        $userslistdata = DB::table('hrdperson.hrdreport_userlogon')
            ->where('sysno', '=', 'S012')
            ->join('hrdperson.employeedata', 'hrdperson.hrdreport_userlogon.USERID', '=', 'hrdperson.employeedata.EMPN')
            // ->whereNull('employeedata.empstatus')
            // ->join('employee_pic', 'hrdreport_userlogon.USERID', '=', 'employee_pic.empno')
            ->select(
                'userid',
                'sysno',
                'usertype',
                'adminflag',
                'superadmin',
                // 'keyflag',
                'crby',
                'crdate',
                'updby',
                'upddate',
                DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where employeedata.EMPN=hrdreport_userlogon.USERID) AS users_fullname"),
                'hrdperson.employeedata.pabbr',
                'hrdperson.employeedata.longno',
                'hrdperson.employeedata.fay',
                'hrdperson.employeedata.gong',
                'hrdperson.employeedata.pnang',
                'hrdperson.employeedata.telname',
                'hrdperson.employeedata.email',
                'hrdperson.employeedata.ImageWeb AS users_pic',
                'hrdperson.employeedata.empstatus',
                DB::raw("(case when hrdperson.employeedata.empstatus IS NULL then 'Active'
                else 'Retired' end) AS empstatus "),
                // DB::raw("(select employee_pic.picpath from hrdperson.employee_pic where empno=hrdreport_userlogon.USERID) AS users_pic")

                // 'targetlist',
                // DB::raw("(select count(*) from hrdsummary_course_train_quota where COURSEYEAR=$courseyear and courseid=hrdsummary_course.courseid) cnt_quota"), //ใช้สำหรับเปลี่ยนสีปุ่ม Quota(กลุ่มเป้าหมาย) หน้า showplanlist
                // DB::raw("(select count(*) from hrdsummary_courseoutline where COURSEYEAR=$courseyear and courseid=hrdsummary_course.courseid) cnt_courseoutline") //ใช้สำหรับเปลี่ยนสีปุ่ม Course Outline หน้า showplanlist
            )
        // ->orderBy(DB::raw('cast(courseid as unsigned)')) //เพื่อเปลี่ยน courseid จาก varchar เป็น int
            ->get();
        return $userslistdata;
    }

    public static function getLongno() // For Dependent Dropdown View page-qcc-users-list
    {
        $longno = DB::table('hrdperson.hrdsummary_organization_trainneed')
            ->where('orgstatus', '=', 'A')
            ->whereNull('orgno1')
            ->select(
                'orgabbr',
                'longno',
                'orgno'
            )
            ->get();
        return $longno;
    }

    public static function getFayList($longno) // For Dependent Dropdown View page-qcc-users-list
    {
        $orgno = DB::table('hrdperson.hrdsummary_organization_trainneed')
            ->where('ORGSTATUS', '=', 'A')
            ->where('longno', '=', $longno)
        // ->whereNotNull('ORGNO1')
            ->select(
                'ORGNO',
                'ORGABBR'
            )
            ->get();
        return $orgno;
    }
    // ใช้สำหรับแสดงข้อมูลตอน onkeyup 'addQccAuthForm' VIEW : page-qcc-users-list
    public static function getUsersData($userid)
    {
        $usersdata = DB::table('hrdperson.employeedata')
            ->join('hrdperson.hrdsummary_organization_trainneed', 'hrdperson.hrdsummary_organization_trainneed.orgabbr', '=', 'hrdperson.employeedata.fay')
            ->where('hrdperson.hrdsummary_organization_trainneed.orgstatus', '=', 'A')
            ->where('EMPN', '=', $userid)
            ->whereNull('hrdperson.employeedata.empstatus');
            $usersdata->select(
                'hrdperson.employeedata.empn',
                DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where hrdperson.employeedata.EMPN=$userid) AS users_fullname"),
                'hrdperson.employeedata.pabbr',
                'hrdperson.employeedata.pnang',
                'hrdperson.employeedata.gong',
                'hrdperson.employeedata.telname',
                'hrdperson.employeedata.email',
                'hrdperson.employeedata.imageweb AS users_pic',
                DB::raw("(select CONCAT (pnang, ' ' ,gong, ' ' ,fay, '  ' ,clong, '  ' ,longno) from hrdperson.employeedata where hrdperson.employeedata.EMPN=$userid) AS user_subject"),
                DB::raw("(select count(userid) from hrdperson.hrdreport_userlogon where hrdperson.hrdreport_userlogon.userid=hrdperson.employeedata.EMPN and hrdperson.hrdreport_userlogon.sysno='S012') AS cnt_S012_privs"), // ใช้สำหรับนับว่ามีสิทธ์ใน S012 แล้วรึยังเพื่อใช้ป้องกันการเพิ่มสิทธิ์ซ้ำแล้ว SQL error
                // 'fay',
                // 'dept',
                // 'ladumnum',
                // 'hrdperson.hrdsummary_organization_trainneed.longno as long',
                // 'hrdperson.hrdsummary_organization_trainneed.orgno',
                // 'nq_level',
            );
        $usersdata = $usersdata->get();
        return $usersdata;
    }

    // สำหรับ Export Excel VIEW : page-qcc-users-list (S012)
    public static function getQccUsersListExport()
    {
        // SOURCE : https://stackoverflow.com/questions/23408091/laravel-how-do-i-get-the-row-number-of-an-object-using-eloquent , https://www.mysqltutorial.org/mysql-row_number/#:~:text=MySQL%20ROW_NUMBER%20%E2%80%93%20adding%20a%20row%20number%20for%20each%20row&text=In%20this%20example%3A,by%20one%20for%20each%20row.
        // DB::statement(DB::raw('set @row:=0')); // ใช้เพิ่ม rownum โดยมีตั้งค่า row = 0 ก่อน

        // $qccuserslistexport = DB::table('hrdperson.hrdreport_userlogon')
        //     ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'hrdperson.hrdreport_userlogon.userid')
        //     ->whereNotIn('hrdperson.hrdreport_userlogon.userid', [590835, 593595]) // ซ่อนสิทธิ์ พี่มด,Bank ('id', [val1,val2,...])
        //     ->where('hrdperson.hrdreport_userlogon.sysno', '=', 'S012')
        //     ->select(
        //         DB::raw('@row:=@row+1 as row'), // ใช้เพิ่ม rownum ให้ row + 1 ไปเรื่อยๆสำหรับทุกแถวของการ query
        //         'userid',
		// 		DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where employeedata.EMPN=hrdreport_userlogon.USERID) AS users_fullname"),
		// 		'hrdperson.employeedata.pabbr',
		// 		'hrdperson.employeedata.pnang',
        //         'hrdperson.employeedata.gong',
		// 		'hrdperson.employeedata.fay',
		// 		'hrdperson.employeedata.longno',
		// 		'hrdperson.employeedata.telname',
		// 		'hrdperson.employeedata.email',
		// 		DB::raw("(case when hrdperson.hrdreport_userlogon.usertype = 'A' then 'Admin'
		// 		when hrdperson.hrdreport_userlogon.usertype = 'R' then 'User'
        //         end) AS role "),
        //         DB::raw("(case when hrdperson.employeedata.empstatus IS NULL then 'Active'
        //         else 'Retired' end) AS status ")
        //     )
        //     ->orderBy('longno', 'asc')->orderBy('fay', 'asc')->orderBy('pabbr', 'asc')
        //     ->get();

        // จะใช้แบบนี้ได้ต้องไป turn off the strict mode ที่ config/database.php SOURCE : https://stackoverflow.com/questions/49846961/syntax-error-or-access-violation-1140-mixing-of-group-columns-laravel
        $qccuserslistexport = DB::table('hrdperson.hrdreport_userlogon')
            ->join('hrdperson.employeedata', 'hrdperson.employeedata.empn', '=', 'hrdperson.hrdreport_userlogon.userid')
            ->whereNotIn('hrdperson.hrdreport_userlogon.userid', [590835, 593595]) // ซ่อนสิทธิ์ พี่มด,Bank ('id', [val1,val2,...])
            ->where('hrdperson.hrdreport_userlogon.sysno', '=', 'S012')
            ->select(
                DB::raw("ROW_NUMBER() OVER ( ORDER BY longno ASC, fay ASC, pabbr ASC ) AS ROW"),
                'userid',
				DB::raw("(select CONCAT (hrdperson.employeedata.title,hrdperson.employeedata.name) from hrdperson.employeedata where employeedata.EMPN=hrdreport_userlogon.USERID) AS users_fullname"),
				'hrdperson.employeedata.pabbr',
				'hrdperson.employeedata.pnang',
                'hrdperson.employeedata.gong',
				'hrdperson.employeedata.fay',
				'hrdperson.employeedata.longno',
				'hrdperson.employeedata.telname',
				'hrdperson.employeedata.email',
				DB::raw("(case when hrdperson.hrdreport_userlogon.usertype = 'A' then 'Admin'
				when hrdperson.hrdreport_userlogon.usertype = 'R' then 'User'
                end) AS role "),
                DB::raw("(case when hrdperson.employeedata.empstatus IS NULL then 'Active'
                else 'Retired' end) AS status ")
            )
            ->orderBy('longno', 'asc')->orderBy('fay', 'asc')->orderBy('pabbr', 'asc')
            ->get();
        return $qccuserslistexport;
    }

}
