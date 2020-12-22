<?php

namespace App\Http\Controllers;

use App\Systemsetting;
use Illuminate\Http\Request;

class SystemsettingController extends Controller
{
    // S012
    public function updateAnnouncementModuleStatus()
    {
        Systemsetting::updateAnnouncementModuleStatus();
        return back();
    }

    // S012
    public function updateCreateModuleStatus()
    {
        Systemsetting::updateCreateModuleStatus();
        return back();
    }

    // S012
    public function updateEditModuleStatus()
    {
        Systemsetting::updateEditModuleStatus();
        return back();
    }

    // S012
    public function updateDeleteModuleStatus()
    {
        Systemsetting::updateDeleteModuleStatus();
        return back();
    }

    // S012
    public function updatePresentationRoundModuleStatus()
    {
        Systemsetting::updatePresentationRoundModuleStatus();
        return back();
    }

    // S012
    public function updatePrizeResultsModuleStatus()
    {
        Systemsetting::updatePrizeResultsModuleStatus();
        return back();
    }

    // S012 Site Maintenance Module
    public function updateMaintenanceModuleStatus()
    {
        Systemsetting::updateMaintenanceModuleStatus();
        return back();
    }

    // S012
    public function updateQccSystemYear()
    {
        Systemsetting::updateQccSystemYear();
        return back();
    }

    // S012
    public function updateQccSystemStrtDate()
    {
        Systemsetting::updateQccSystemStrtDate();
        return back();
    }

    // S012
    public function updateQccSystemEndDate()
    {
        Systemsetting::updateQccSystemEndDate();
        return back();
    }
}
