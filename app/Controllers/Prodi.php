<?php

namespace App\Models\Prodi_Model;
namespace App\Controllers;

use App\Models\Prodi_Model;

class Prodi extends BaseController
{
    public function __construct() {
        $this->session = \Config\Services::session();
        $db = \Config\Database::connect();
        $this->prodi = new Prodi_Model($db);
    }

    public function index()
    {   
        $data['session'] = $this->session->getFlashdata('response');
        $data['isLogin'] = $this->session->get('username');
        $data['dataProdi'] = $this->prodi->get()->getResult();

        /* Pake view kalau mau bisa kirim data */
        echo view('header_v');
        echo view('prodi_v', $data);
        echo view('footer_v');
    }

    public function add() 
    {
        echo view('header_v');
        echo view('prodi_form_v');
        echo view('footer_v');
    } 
 
    public function edit($id) {
        $where = ['kode_prodi' => $id];

        $data['dataProdi'] = $this->prodi->get($where)->getResult()[0];
        
        echo view('header_v');
        echo view('prodi_form_v', $data);
        echo view('footer_v');        
    }

    public function save() {
        $data = [
            'kode_prodi' => $this->request->getPost('kode'),
            'nama_prodi' => $this->request->getPost('nama'),
            'ketua_program_studi' => $this->request->getPost('ketua')
        ];

        $id = $this->request->getPost('id');

        if(empty($id)) { //Insert Data
            $response = $this->prodi->insert($data);

            if($response->resultID) {
                $this->session->setFlashdata('response', ['status' => $response->resultID, 'message' => 'Data Berhasil Disimpan.']);
            } else {
                $this->session->setFlashdata('response', ['status' => $response->resultID, 'message' => 'Data Gagal Disimpan. '. $response->connID->error]);
            }
            
        } else { //Update Data
            $where = ['kode_prodi' => $id];
            $response = $this->prodi->update($data, $where); 
            
            if($response) {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data Berhasil Disimpan.']);
            } else {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data Gagal Disimpan.']);
            }
        }

        return redirect()->to(site_url('Prodi'));
    }

    public function delete($id) {
        $where = ['kode_prodi' => $id];

        $response = $this->prodi->delete($where);

        if($response->resultID ) {
            $this->session->setFlashdata('response', ['status' => $response->resultID, 'message' => 'Data Berhasil Dihapus.']);
        } else {
            $this->session->setFlashdata('response', ['status' => $response->resultID, 'message' => 'Data Gagal Dihapus. '. $response->connID->error]);
        }
        
        return redirect()->to(site_url('Prodi')); 
    }  

}
?>