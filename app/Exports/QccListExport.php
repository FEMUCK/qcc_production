<?php

namespace App\Exports;

use App\Qcc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class QccListExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Qcc::all();
        return Qcc::getQccListExport(); // คือ Model ที่ต้องการนำผล query ไป Export Excel
    }

    // สำหรับใส่ชื่อหัวตาราง
    public function headings(): array
    {
        return [
            '#',
            'เลขที่กลุ่ม',
            'ชื่อกระบวนการ/งานที่ถูกปรับปรุง',
            'ประเภทผลงาน',

            'หน่วยงาน',
            'สายรอง',
            'ผู้ประสานงาน',
            'โทร',
            'email',

            'วัตถุประสงค์ในการปรับปรุง',
            'วัตถุประสงค์ในการปรับปรุงอื่น ๆ',
            'เครื่องมือที่ใช้ในการปรับปรุง',
            'เครื่องมือที่ใช้ในการปรับปรุงอื่น ๆ',
            'วันที่เริ่มต้น',
            'วันที่สิ้นสุด',
            'ID ที่ปรึกษา',
            'ที่ปรึกษา',

            'ID หัวหน้ากลุ่ม',
            'หัวหน้ากลุ่ม',
            'ID สมาชิก 1',
            'สมาชิก 1',
            'ID สมาชิก 2',
            'สมาชิก 2',
            'ID สมาชิก 3',
            'สมาชิก 3',
            'ID สมาชิก 4',
            'สมาชิก 4',
            'ID สมาชิก 5',
            'สมาชิก 5',

            'สภาพก่อนปรับปรุงและประเด็นในการปรับปรุง',
            'เป้าหมายหลักที่ต้องการปรับปรุง (ตัวชี้วัด)',
            'กรอบแนวคิดในการปรับปรุง',
            'หลักการ (ทฤษฎี) ที่รองรับกรอบแนวคิด',
            'วิธีการปรับปรุงตามกรอบแนวคิด',

            'ตรวจสอบผลการปรับปรุง',
            'สภาพหลังการปรับปรุง',
            'ผลที่ได้เทียบกับเป้าหมายหลัก',
            'ลดค่าใช้จ่าย(บาท/ปี)',
            'คำอธิบาย(ถ้ามี)',
            'เพิ่มความพร้อมจ่าย(%/ปี)',
            'คำอธิบาย(ถ้ามี)',
            'เพิ่มประสิทธิภาพ(%/ปี)',
            'คำอธิบาย(ถ้ามี)',

            'ผลต่อและผู้มีส่วนได้ส่วนเสีย (องค์กร ผู้ปฏิบัติงาน ลูกค้า สังคม)',
            'ประหยัดค่าวัสดุอุปกรณ์(บาท/ปี)',
            'ประหยัดเวลา/แรงงาน(บาท/ปี)',
            'ประหยัดค่าพลังงาน(บาท/ปี)',
            'ลดอุบัติเหตุด้านบุคคล(ราย/ปี)',
            'ลดความเสียหายทรัพย์สิน(บาท/ปี)',
            'ความพึงพอใจที่เพิ่มขึ้น(%)',
            'สิ่งประดิษฐ์(%)',
            'อื่นๆ(%)',

            'มีกระบวนการทำงานใหม่/ชิ้นงานใหม่/สิ่งประดิษฐ์ใหม่/เครื่องมือใหม่ และ มาตรฐานใหม่',
            'ผลงานมีแนวโน้มต่อยอดเป็นนวัตกรรม',
            'มีแผนงาน และข้อมูลติดตามผลการรักษามาตรฐาน',
            'มีศักยภาพสามารถขยายผลในสายงาน หรือข้ามสายงาน',

            'URL ECP เอกสาร',
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
                $nameCellRange = 'C2:C' . $event->sheet->getDelegate()->getHighestRow();
                $sheet->getStyle($nameCellRange)->getAlignment()->setHorizontal('left');
            },
        ];
    }
}
