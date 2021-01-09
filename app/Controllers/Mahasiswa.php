<?php

namespace App\Controllers;

use CodeIgniter\Database\ConnectionInterface;

use App\Models\Mahasiswa_Model;
use App\Models\Agama_Model;
use App\Models\Hobi_Model;
use App\Models\Hobi_Mahasiswa_Model;

class Mahasiswa extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();

        $this->mahasiswa = new Mahasiswa_Model();
        $this->hobiMahasiswa = new Hobi_Mahasiswa_Model();
        $this->agama = new Agama_Model();
        $this->hobi = new Hobi_Model();
    }

    public function index()
    {
        $data['session'] = $this->session->getFlashdata('response');
        $data['isLogin'] = $this->session->get('username');
        $data['dataMahasiswa'] = $this->mahasiswa->get($this->db)->getResult();

        echo view('header_v');
        echo view('mahasiswa_v', $data);
        echo view('footer_v');
    }

    public function add()
    {
        $data['dataAgama'] = $this->agama->findAll();
        $data['dataHobi'] = $this->hobi->findAll();

        echo view('header_v');
        echo view('mahasiswa_form_v', $data);
        echo view('footer_v');
    }

    public function edit($id)
    {
        $data['dataAgama'] = $this->agama->findAll();
        $data['dataHobi'] = $this->hobi->findAll();
        $data['dataMahasiswa'] = $this->mahasiswa->find($id);

        foreach ($this->hobimahasiswaModel->where('nim', $id)->findAll() as $row) :
            $data['dataHobiMahasiswa'][] = $row->kode_hobi;
        endforeach;

        echo view('header_v');
        echo view('mahasiswa_form_v', $data);
        echo view('footer_v');
    }

    public function save()
    {
        $this->db->transStart();

        $nim = $this->request->getPost('nim');

        $data = [
            'nim' => $nim,
            'nama_mahasiswa' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'kode_agama' => $this->request->getPost('kode_agama'),
            'alamat' => $this->request->getPost('alamat'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'foto' => 'blank.png'
        ];

        $id = $this->request->getPost('id');

        if (empty($id)) { //Insert

            $this->mahasiswa->insert($data);

            $data = [];

            $hobi = $this->request->getPost('hobi');

            for ($i = 0; $i < count($hobi); $i++) {
                $data = [
                    'kode_hobi' => $hobi[$i],
                    'nim' => $nim
                ];

                $this->hobiMahasiswa->insert($data);
            }


            $this->db->transComplete();

            $response = $this->db->transStatus();

            if ($response === FALSE) {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data gagal disimpan.']);
            } else {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data berhasil disimpan.']);
            }
        } else { // Update
            $where = ['nim' => $id];

            $this->mahasiswa->update($where, $data);

            $this->hobiMahasiswa->where($where)->delete();

            $data = [];

            $hobi = $this->request->getPost('hobi');

            for ($i = 0; $i < count($hobi); $i++) {
                $data = [
                    'kode_hobi' => $hobi[$i],
                    'nim' => $nim
                ];

                $this->hobiMahasiswa->insert($data);
            }

            $this->db->transComplete();

            $response = $this->db->transStatus();

            if ($response) {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data berhasil disimpan.']);
            } else {
                $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data gagal disimpan.']);
            }
        }

        return redirect()->to(site_url('Mahasiswa'));
    }

    public function delete($id)
    {
        $response = $this->mahasiswa->delete($id);

        if ($response) {
            $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data berhasil dihapus.']);
        } else {
            $this->session->setFlashdata('response', ['status' => $response, 'message' => 'Data gagal dihapus.']);
        }

        return redirect()->to(site_url('Mahasiswa'));
    }
}
