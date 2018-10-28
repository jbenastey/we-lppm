<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 10/19/2018
 * Time: 21:40
 */

namespace LPPMKP\Office\Controllers;
use LPPMKP\Lppm\Models\Pengguna;

class PenggunaController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->halaman = 'Halaman Pengguna';
        $pengguna = Pengguna::find(['order' => 'id_pengguna DESC']);
        if (!$pengguna) {
            $response = new Phalcon\Http\Response();
            $response->setStatusCode('404', 'Not Found');
        }
        $this->view->pengguna = $pengguna;
    }
    public function addAction()
    {
        $this->view->halaman = 'Tambah Data Pengguna';
        if ($this->request->isPost()) {
            $pengguna = new Pengguna();
            $pengguna->nama = $this->request->getPost('nama');
            $pengguna->password = md5( $this->request->getPost('password'));
            $pengguna->nip = $this->request->getPost('nipnik');
            $pengguna->email = $this->request->getPost('email');
            $pengguna->konfirmasi_email = 'Y';
            $pengguna->hak_akses = $this->request->getPost('hakakses');
            $pengguna->foto = 'no-image.jpg';
            if ($pengguna->save()) {
                $this->view->disable();
                $this->flashSession->success('Berhasil Menyimpan Data');
                $this->response->redirect('office/pengguna');
            } else {
                $this->view->disable();
                $this->flashSession->error('Gagal Menyimpan Data');
                $this->response->redirect('office/pengguna');
            }
        }
    }

    public function updateAction($nip)
    {
//        $nip = $this->request->getPost("nip");
        $this->view->halaman = 'Data Pengguna Edit';
        $pengguna = Pengguna::findFirstByNip($nip);
        if ($this->request->isPost()) {
            $pengguna->nip = $nip;
            $pengguna->nama = $this->request->getPost("nama");
            $pengguna->email = $this->request->getPost("email");
            $pengguna->hak_akses = $this->request->getPost("hak_akses");
            $pengguna->password =  md5($this->request->getPost("password"));
            $pengguna->konfirmasi_email = $this->request->getPost("konfirmasi_email");
            if ($pengguna->save()) {
                $this->view->disable();
                $this->flashSession->success('Update Berhasil');
                $this->response->redirect('office/pengguna');
            } else {
                $this->view->disable();
                $this->flashSession->success('Update Gagal!');
                $this->response->redirect('office/pengguna');
            }
        }
        $this->view->pengguna = $pengguna;
    }

    public function deleteAction($nip){
        $pengguna = Pengguna::findFirstByNip($nip);
        if($pengguna->delete()){
            $this->view->disable();
            $this->flashSession->success('Delete Berhasil');
            $this->response->redirect('office/pengguna');
        } else{
            $this->view->disable();
            $this->flashSession->success('Delete Gagal!');
            $this->response->redirect('office/pengguna');
        }
    }
}