<?php

namespace App\Http\Controllers;

use App\Exports\QccUsersS012Export;
use App\Exports\QccListExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    public function QccUsersS012ListExport()
    {
        return Excel::download(new QccUsersS012Export(), 'S012-Qcc-Users.xlsx');
    }

    public function QccDataListExport()
    {
        return Excel::download(new QccListExport(), 'Qcc-Data-List.xlsx');
    }
}
