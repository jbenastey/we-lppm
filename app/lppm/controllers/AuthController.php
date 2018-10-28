<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 15:20
 */

namespace LPPMKP\Lppm\Controllers;

use LPPMKP\Lppm\Models\Pengguna;
use LPPMKP\Forms\Registrasi;
use LPPMKP\Library\Mail;

class AuthController extends ControllerBase
{

    public function initialize()
    {
        $ses_nip_nik= $this->session->get('nip');
        if (!empty($ses_nip_nik)) {
            $this->response->redirect('');
        }
    }

    public function loginAction()
    {

    }

    public function loginprosesAction()
    {

        $nip_nik = $this->request->getPost('nipNik');
        $password = $this->request->getPost('password');
        $password = md5($password);
        $pengguna = Pengguna::findFirstByNip($nip_nik);


        if ($pengguna) {

            if ($pengguna->konfirmasi_email == 'N') {
                if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                    $this->flashSession->error('Akun Anda Tidak Aktif, Cek Email untuk konfirmasi atau hubungi admin LPPM');
                    $this->response->redirect('monitoring');
                } else{
                    $this->flashSession->error('Akun Anda Tidak Aktif, Cek Email untuk konfirmasi atau hubungi admin LPPM');
                    $this->response->redirect('office');
                }
            }
            elseif ($nip_nik == $pengguna->nip && $password == $pengguna->password) {
                $this->session->set('id_pengguna', $pengguna->id_pengguna);
                $this->session->set('nip', $pengguna->nip);
                $this->session->set('hak_akses', $pengguna->hak_akses);
                $this->session->set('password', $pengguna->password);
                $this->session->set('foto', $pengguna->foto);
                $this->session->set('nama', $pengguna->nama);
                $this->session->set('email', $pengguna->email);
                //TODO tambahan redirect sesuai asal login dan tambahan simpan session login

                $this->session->set('user', $pengguna);

                if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                    $this->response->redirect('monitoring');
                } else{
                    $this->response->redirect('office');
                }
            }
            elseif ($nip_nik != $pengguna->nip || $password != $pengguna->password) {
                if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                    $this->flashSession->error('Username Password Tidak Benar');
                    $this->response->redirect('monitoring');
                } else{
                    $this->flashSession->error('Username Password Tidak Benar');
                    $this->response->redirect('office');
                }
            }
        }

        else {
            if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                $this->flashSession->error('Username Atau Password Tidak Ada');
                $this->response->redirect('monitoring');
            } else{
                $this->flashSession->error('Username Atau Password Tidak Ada');
                $this->response->redirect('office');
            }
        }

    }

    public function konfirmasiAction($id)
    {
        $pengguna = Pengguna::findFirstByNip($id);
        $pengguna->konfirmasi_email = 'Y';
        $pengguna->save();
        $this->flashSession->success('Selamat Email Anda Sudah Dikonfirmasi Silahkan Lakukan Login');
        $this->response->redirect('/daftar');

    }

    /**
     *
     * @throws \exception
     */
    public function daftarAction()
    {
        $form = new Registrasi(null);
        //  $this->view->title = 'Daftar';
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {

                // $user = new Pengguna();
                $body = $this->config->web . "konfirmasi/" . $this->request->getPost('nip');
                $email = $this->request->getPost('email');
                $user = new Pengguna(
                    [
                        'nama'=> $this->request->getPost('nama'),
                        'nip' => $this->request->getPost('nip'),
                        'password' => md5($this->request->getPost('password')),
                        'email' => $this->request->getPost('email'),
                        'hak_akses' => 'dosen',
                        'foto' => 'no-image.jpg',
                        'konfirmasi_email' => 'N',
                    ]);

                if (!$user->save()) {
                    $this->view->disable();
                    $this->flashSession->error('Gagal Menyimpan Data');
                    $this->response->redirect('/daftar');
                } else {
                    $mail = new Mail();
                    $mail->send(
                        $this->config->smtp,
                        $this->config->user,
                        $message = [
                            'to' => $email,
                            'subject' => 'Konfirmasi Email',
                            'body' => '
                                <p>Assalamu\'alaikum</p>
                                 <br>
                                 <a href="' . $body . '">Konfirmasi Email UIN SUSKA Riau</a>
                                 
                                <p>Tekan Link Dibawah ini,Demikian informasi ini dapat disampaikan,, Terimakasih</p>
                                <a href="' . $this->config->web . '">LPPM UIN SUSKA RIAU</a>
                                '
                        ]
                    );
                    $this->view->disable();
                    $this->flashSession->success('Registrasi Berhasil, Silahkan Cek Email Anda Untuk Konfirmasi akun');
                    $this->response->redirect('/daftar');
                }

            }
        }

        $this->view->form = $form;
    }

    public function lupaAction()
    {
        $this->view->halaman = 'lupa';
    }

    public function lupaprosesAction(){
        $nip = $this->request->getPost('nip');
        $pengguna = Pengguna::findFirstByNip($nip);


        if ($pengguna!=false) {
            $nama = $pengguna->nama;
            $email = $pengguna->email;
            $passwordbaru = "";
            $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 10; $i++) {
                $rand = mt_rand(0, $max);
                $passwordbaru .= $characters[$rand];
            }

            $pengguna->password = md5($passwordbaru);
            $mail = new Mail();
            $mail->send(
                $this->config->smtp,
                $this->config->user,
                $message = [
                    'to' => $email,
                    'subject' => 'Konfirmasi Email',
                    'body' => '
                                <p>Assalamu\'alaikum ' . $nama . '</p>
                                 <br>
                                 <!--<a href="">Reset Email Anda Berhasil,</a>-->
                                 <h3>Reset Password Anda Berhasil</h3>
                                 
                                <p>Password anda Adalah <b>' . $passwordbaru . '</b></p>
                                <p>Silahkan  <a href="' . $this->config->web . '">Login</a></p>
                                '
                ]
            );
            $this->flashSession->success("Cek Email Anda Untuk Mendapatkan Password Baru");
            $this->response->redirect('lupa');

        } else {
            $this->flashSession->error("NIK anda salaah");
            $this->response->redirect('lupa');
        }

    }



}