<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Activity_model;

class Activity extends BaseController
{
    public function __construct()
    {
        $this->activity = new Activity_model();
    }
    public function index()
    {
        $data  = [
            'title' =>  'Aktivitas',
            'activity' => $this->activity->getActivity(),
        ];
        return view('admin/activity/index', $data);
    }

    public function addActivity()
    {
        if (!$this->validate([
            'name'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Nama Aktivitas.'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
            $data = array(
                'name'     => $this->request->getPost('name'),
            );
            $save = $this->activity->insertActivity($data);
            if ($save) {
                session()->setFlashdata('success', 'Aktivitas Baru telah ditambahkan');
                return redirect()->to(base_url('activity'));
            }
        }
    }

    public function updateActivity($id)
    {
        $data = array(
            'name'   => $this->request->getPost('name'),
        );

        $save = $this->activity->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Data Aktivitas berhasil diubah');
            return redirect()->to(base_url('activity'));
        }
    }

    public function deleteActivity($id)
    {
        $this->activity->where('id', $id)->delete();
        session()->setFlashdata('success', 'Aktivitas berhasil dihapus!');
        return redirect()->to(base_url('activity'));
    }
}
