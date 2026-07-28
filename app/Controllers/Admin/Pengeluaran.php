<?php

namespace App\Controllers\Admin;

use App\Models\Inventory_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Pengeluaran extends BaseController
{
    protected $inventory;
    public function __construct()
    {
        $this->inventory = new Inventory_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Pengeluaran',
            'inventory' => $this->inventory->approvalInventory()
        ];
        return view('admin/pengeluaran', $data);
    }
    public function export()
    {
        $laundry =  $this->inventory->approvalInventory();
        $time = Time::now();
        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Invoice')
            ->setCellValue('C1', 'Nama Barang')
            ->setCellValue('D1', 'Harga Satuan')
            ->setCellValue('E1', 'Jumlah')
            ->setCellValue('F1', 'Total')
            ->setCellValue('G1', 'Catatan');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($laundry as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, ($column - 1))
                ->setCellValue('B' . $column, $data['invoice'])
                ->setCellValue('C' . $column, $data['name'])
                ->setCellValue('D' . $column, $data['price'])
                ->setCellValue('E' . $column, $data['qty'])
                ->setCellValue('F' . $column, $data['total'])
                ->setCellValue('G' . $column, $data['note']);
            $column++;
        }
        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('f39c12');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1:G' . ($column - 1))->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=Laporan Pengeluaran ' . $time . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
