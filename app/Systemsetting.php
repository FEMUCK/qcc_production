<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class Systemsetting extends Model
{
    protected $table = 'systemsetting';

    // protected $fillable = ['paramno', 'paramtype', 'paramval'];
    protected $fillable = ['paramval'];

    // Module Management VIEW : page-qcc-system-setting
    public static function getSystemSettingData()
    {
        $systemsettingdata = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->select('paramno', 'paramtype', 'paramval')
            ->get();
        return $systemsettingdata;
    }

    public static function getQccSystemSettingYear()
    {
        $paramyears = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'SYSYEAR')
            ->select('paramval')
            ->get();

        // ใช้ foreach เพื่อเอาเฉพาะค่าที่ต้องการใช้ออกมาจาก Array
        foreach ($paramyears as $paramyear) {
            $qccsystemyear = $paramyear->paramval;
        }
        return $qccsystemyear;
    }

    public static function getQccSystemStrtDate()
    {
        $paramstrtdate = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'STRTDATE')
            ->select('paramval')
            ->get();

        // ใช้ foreach เพื่อเอาเฉพาะค่าที่ต้องการใช้ออกมาจาก Array
        foreach ($paramstrtdate as $paramstrtdates) {
            $qccsystemstrtdate = $paramstrtdates->paramval;
        }
        return $qccsystemstrtdate;
    }

    public static function getQccSystemEndDate()
    {
        $paramenddate = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'ENDDATE')
            ->select('paramval')
            ->get();

        // ใช้ foreach เพื่อเอาเฉพาะค่าที่ต้องการใช้ออกมาจาก Array
        foreach ($paramenddate as $paramenddates) {
            $qccsystemenddate = $paramenddates->paramval;
        }
        return $qccsystemenddate;
    }

    //*! START update module status VIEW : page-qcc-system-setting
    public static function updateAnnouncementModuleStatus()
    {
        $modulestatus = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'ANNOUNCEMENT')
            ->update([
                'paramval' => Request::input('announcement_module'),
            ]);
        return true;
    }

    public static function updateCreateModuleStatus()
    {
        $modulestatus = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'ADD')
            ->update([
                'paramval' => Request::input('create_module'),
            ]);
        return true;
    }

    public static function updateEditModuleStatus()
    {
        $modulestatus = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'EDIT')
            ->update([
                'paramval' => Request::input('edit_module'),
            ]);
        return true;
    }

    public static function updateDeleteModuleStatus()
    {
        $modulestatus = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'REMOVE')
            ->update([
                'paramval' => Request::input('delete_module'),
            ]);
        return true;
    }

    public static function updatePresentationRoundModuleStatus()
    {
        $modulestatus = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'PRESENT')
            ->update([
                'paramval' => Request::input('presentation_round_module'),
            ]);
        return true;
    }

    public static function updatePrizeResultsModuleStatus()
    {
        $modulestatus = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'PRIZE')
            ->update([
                'paramval' => Request::input('prize_results_module'),
            ]);
        return true;
    }

    public static function updateMaintenanceModuleStatus()
    {
        $modulestatus = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'MAINTENANCE')
            ->update([
                'paramval' => Request::input('site_maintenance_module'),
            ]);
        return true;
    }
    //*! END update module status VIEW : page-qcc-system-setting

    // เพื่อดึงค่า Maintenance Module Status ไปเก็บไว้ใน session เนื่องจากต้องใช้ตรวจตอน Login โดย Login Middleware
    public static function getMaintenanceModuleStatus(){
        $maintenancemodulestatus_array = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'MAINTENANCE')
            ->select('paramval')
            ->get();
        // ใช้ foreach เพื่อเอาเฉพาะค่าที่ต้องการใช้ออกมาจาก Array ไม่งั้นค่าจะออกมาเป็น {{KEY:VALUE}}
        foreach ($maintenancemodulestatus_array as $maintenancemodulestatus_item) {
            $maintenancemodulestatus = $maintenancemodulestatus_item->paramval;
        }
        return $maintenancemodulestatus;
    }

    //*! START update QCC System Date VIEW : page-qcc-system-setting
    public static function updateQccSystemYear()
    {
        $qccsystemyear = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'SYSYEAR')
            ->update([
                'paramval' => Request::input('v_sysyear'),
            ]);
        return true;
    }

    public static function updateQccSystemStrtDate()
    {
        $qccsystemstrtdate = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'STRTDATE')
            ->update([
                'paramval' => Request::input('v_sys_startdate'),
            ]);
        return true;
    }

    public static function updateQccSystemEndDate()
    {
        $qccsystemenddate = DB::table('systemsetting')
            ->where('paramno', 'S012')
            ->where('paramtype', 'ENDDATE')
            ->update([
                'paramval' => Request::input('v_sys_enddate'),
            ]);
        return true;
    }
    //*! END update QCC System Date VIEW : page-qcc-system-setting
}
