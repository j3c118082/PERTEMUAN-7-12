<?php

namespace App\Controllers;

use App\Models\Agama_Model;
use phpDocumentor\Reflection\PseudoTypes\True_;

class Agama extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();

        $this->agama = new Agama_Model($db);
    }

    public function index()
    {
        $data['session'] = $this->session->getFlashdata('response');
        $data['isLogin'] = $this->session->get('username');
        $data['dataAgama'] = $this->agama->findAll();

        echo view('header_v');
        echo view('agama_v', $data);
        echo view('footer_v');
    }

    public function add()
    {
        echo view('header_v');
        echo view('agama_form_v');
        echo view('footer_v');
    }

    public function edit($id)
    {
        $data['dataAgama'] = $this->agama->find($id);

        echo view('header_v');
        echo view('agama_form_v', $data);
        echo view('footer_v');
    }

    public function save()
    {
        $data = [
            'kode_agama' => $this->request->getPost('kode'),
            'agama' => $this->request->getPost('nama'),
        ];

        $id = $this->request->getPost('id');

        if (empty($id)) {
            //Insert Data
            $response = $this->agama->insert($data);

            if ($response) {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data berhasil disimpan.']);
            } else {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data gagal disimpan.']);
            }
        } else { //Update Data
            $response = $this->agama->update($id, $data);

            if ($response) {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data berhasil disimpan.']);
            } else {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data gagal disimpan.']);
            }
        }

        return redirect()->to(site_url('Agama'));
    }

    public function delete($id)
    {
        $where = ['kode_agama' => $id];

        $response = $this->agama->delete($where);

        if ($response->resultID) {
            $this->session->setFlashdata('response', ['status' => $response->resultID, 'message' => 'Data Berhasil Dihapus.']);
        } else {
            $this->session->setFlashdata('response', ['status' => $response->resultID, 'message' => 'Data Gagal Dihapus. ' . $response->connID->error]);
        }

        return redirect()->to(site_url('Agama'));
    }
}
