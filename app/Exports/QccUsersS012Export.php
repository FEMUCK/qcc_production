<?php

namespace App\Exports;

use App\QccUsers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class QccUsersS012Export implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return QccUsers::all();
        return QccUsers::getQccUsersListExport(); // คือ Model ที่ต้องการนำผล query ไป Export Excel
    }

    // สำหรับใส่ชื่อหัวตาราง
    public function headings(): array
    {
        return [
            '#',
            'รหัสพนักงาน',
            'ชื่อ-สกุล',
            'ตำแหน่ง',
            'แผนก',
            'กอง',
            'หน่วยงาน',
            'สายงาน',
            'โทร',
            'email',
            'สิทธิ์',
            'status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $cellRange = 'A1:' . $sheet->getHighestColumn() . $sheet->getHighestDataRow(); //https://stackoverflow.com/questions/41394123/how-to-generate-dynamic-columns-using-maatwebsite-excel-in-laravel-5-1

                // Sets all font
                $sheet->getStyle($cellRange)->getFont()->setName('TH Sarabun New')->setSize(14);

                $headerCellRange = 'A1:' . $sheet->getHighestColumn() . '1'; // All headers (A better and dynamic solution for the cellRange would be)
                // Sets BOLD Header
                $sheet->getStyle($headerCellRange)->getFont()->setBold(true)->getColor()->setARGB('FFCC00');
                $sheet->getStyle($headerCellRange)->getFill()->setFillType('solid')->getStartColor()->setARGB('808080'); //https://github.com/Maatwebsite/Laravel-Excel/issues/460

                // Sets all borders
                $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle('thin');
                $sheet->getStyle($cellRange)->getAlignment()->setHorizontal('center');
                $sheet->getStyle($cellRange)->getAlignment()->setVertical('center');
                $nameCellRange = 'E2:F' . $event->sheet->getDelegate()->getHighestRow();
                $sheet->getStyle($nameCellRange)->getAlignment()->setHorizontal('left');
            },
        ];
    }
}
