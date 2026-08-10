<?php

namespace App\Validators;

class TransactionValidator
{
    public function create()
    {
        return [
            'customer_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pelanggan wajib dipilih.'
                ]
            ],
            // 'invoice' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Invoice anda kosong.'
            //     ]
            // ],
            // 'total_amount' => [
            //     'rules' => 'required|decimal',
            //     'errors' => [
            //         'required' => 'Jumlah total anda kosong.',
            //         'numeric'  => 'Jumlah total harus berupa angka.'
            //     ]
            // ],
            // 'paid_amount' => [
            //     'rules' => 'required|decimal',
            //     'errors' => [
            //         'required' => 'Jumlah pembayaran anda kosong.',
            //         'numeric'  => 'Jumlah pembayaran harus berupa angka.'
            //     ]
            // ],
            // 'payment_status' => [
            //     'rules' => 'required|in_list[Unpaid,Partial,Paid]',
            //     'errors' => [
            //         'required' => 'Status pembayaran anda kosong.',
            //         'in_list'  => 'Status pembayaran tidak valid.'
            //     ]
            // ],
            'details' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Detail transaksi wajib diisi.'
                ]
            ],
            'details.*.service_id' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Layanan wajib dipilih.',
                    // 'integer'  => 'ID layanan harus berupa angka.'
                ]
            ],
            'details.*.weight' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Berat wajib diisi.',
                    'decimal'  => 'Berat harus berupa angka.'
                ]
            ],
            'details.*.qty' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Jumlah wajib diisi.',
                    'decimal'  => 'Jumlah harus berupa angka.'
                ]
            ],
            // 'details.*.status' => [
            //     'rules' => 'required|in_list[Process,Finishing,Taken]',
            //     'errors' => [
            //         'required' => 'Status wajib dipilih.',
            //         'in_list'  => 'Status tidak valid.'
            //     ]
            // ]
        ];
    }
}
