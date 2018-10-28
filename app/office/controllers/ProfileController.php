<?php
namespace LPPMKP\Office\Controllers;
use LPPMKP\Lppm\Models\Pengguna;
use LPPMKP\Forms\Ganti;
class ProfileController extends ControllerBase
{

    public function profileAction()
    {

        $halaman = 'Profile';
        $this->view->halaman = $halaman;
        if ($this->request->isPost()) {
            $id = $this->request->getPost('nip');
            $user = Pengguna::findFirstByNip($id);

            $user->nama = $this->request->getPost('nama');
            $user->email = $this->request->getPost('email');

            if ($user->save()) {

                $this->flashSession->success('Berhasil Mengubah Data');
                $this->session->set('nip', $user->nip);
                $this->session->set('hak_akses', $user->hak_akses);
                $this->session->set('password', $user->password);
                $this->session->set('foto', $user->foto);
                $this->session->set('nama', $user->nama);
                $this->session->set('email', $user->email);
            }
            else {
                $this->flashSession->error('Gagal');
            }
            $this->response->redirect('office/profile');
        }
    }

    public function gantiAction($nip){
        $halaman = 'Ganti Password';
        $this->view->halaman = $halaman;
        $form = new Ganti(null);
        $this->view->form = $form;
        $pengguna = Pengguna::findFirstByNip($nip);

        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {
                $password = md5($this->request->getPost('password'));
                $passwordbaru = md5($this->request->getPost('passwordbaru'));
                $passwordlama= $pengguna->password;

                if($passwordlama != $password){
                    $this->view->disable();
                    $this->flashSession->error('ganti password anda gagal');
                    $this->response->redirect('/office/profile');
                }
                else {
                    $pengguna->password = $passwordbaru;
                    if ($pengguna->save()) {
                        $this->flashSession->success('ganti password anda berhasil');
                        $this->response->redirect('/office/profile');
                    }
                }


            }
        }
    }

    public function fotoAction($nip)
    {
        $halaman = 'Ganti Foto';
        $this->view->halaman = $halaman;
        $user = Pengguna::findFirstByNip($nip);
        $this->session->set('foto', $user->foto);
        if ($this->request->isPost()) {

            $foto = $this->request->getUploadedFiles()[0];
            $name = $foto->getName();
            $pindahkan = $foto->moveTo('img/foto_user/' . $name);

            $user->foto = $name;


            if ($user->save() && $pindahkan ==true) {
                $this->flashSession->success('Berhasil Mengubah Data');
                $this->session->set('foto', $user->foto);
            }
            else {
                $this->flashSession->error('Gagal');
            }
            $this->response->redirect('office/profile');
        }
    }

}

