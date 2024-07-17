<?php

namespace App\Controllers\Admin;

use App\Models\Laundry_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\I18n\Time;

use App\Controllers\BaseController;

class Pemasukkan extends BaseController
{
    public function __construct()
    {
        $this->laundry = new Laundry_model();
    }
    public function index()
    {
        $data = [
            'title' => 'Laporan Pemasukkan',
            'inventory' => $this->laundry->Income()
        ];
        return view('admin/pemasukkan', $data);
    }

    public function export()
{
    $laundry =  $this->laundry->Income();
$time = Time::now();
    $spreadsheet = new Spreadsheet();
    // tulis header/nama kolom 
    $spreadsheet->setActiveSheetIndex(0)
     ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Invoice')
                ->setCellValue('C1', 'Nama Pelanggan')
                ->setCellValue('D1', 'Layanan')
                ->setCellValue('E1', 'Harga Layanan')
                ->setCellValue('F1', 'Berat')
                ->setCellValue('G1', 'Total')
                ->setCellValue('H1', 'Pembayaran')
                ->setCellValue('I1', 'Kembalian');
    
    $column = 2;
    // tulis data mobil ke cell
    foreach($laundry as $data) {
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, ($column-1))
                    ->setCellValue('B' . $column, $data['invoice'])
                    ->setCellValue('C' . $column, $data['name_customer'])
                    ->setCellValue('D' . $column, $data['name_service'])
                    ->setCellValue('E' . $column, $data['price_service'])
                    ->setCellValue('F' . $column, $data['weight'])
                    ->setCellValue('G' . $column, $data['price'])
                    ->setCellValue('H' . $column, $data['paid'])
                    ->setCellValue('I' . $column, $data['result']);
        $column++;
    }
    $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
    
    $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('f39c12');
    $styleArray = [
        'borders'=>[
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
                ]
                ] 
                ];
                $spreadsheet->getActiveSheet()->getStyle('A1:I'. ($column-1))->applyFromArray($styleArray);
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    // tulis dalam format .xlsx
    $writer = new Xlsx($spreadsheet);

    // Redirect hasil generate xlsx ke web client
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename=Laporan Pemasukkan ' .$time.'.xlsx');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit();
}
}
