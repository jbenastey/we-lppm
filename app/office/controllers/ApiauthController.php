<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 15:20
 */

namespace LPPMKP\Office\Controllers;

use LPPMKP\Lppm\Models\Pengguna;
use LPPMKP\Forms\Registrasi;
use LPPMKP\Library\Mail;

class ApiauthController extends ControllerBase
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
        $response=null;
        $nip_nik = $this->request->getPost('nipNik');
        $password = $this->request->getPost('password');
        $password = md5($password);
        $pengguna = Pengguna::findFirstByNip($nip_nik);
        if ($pengguna) {
            if ($pengguna->konfirmasi_email == 'N') {
                if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                    $response= [
                        "pesan"=>"Akun Anda Tidak Aktif, Cek Email untuk konfirmasi atau hubungi admin LPPM",
                        "data"=>false,
                    ];
                } else{
                    $response= [
                        "pesan"=>"AAkun Anda Tidak Aktif, Cek Email untuk konfirmasi atau hubungi admin LPPM",
                        "data"=>false,
                    ];
                }
            }
            elseif ($nip_nik == $pengguna->nip && $password == $pengguna->password) {
                $this->session->set('id_pengguna', $pengguna->id_pengguna);
                $this->session->set('nip', $pengguna->nip);
                $this->session->set('hak_akses', $pengguna->hak_akses);
                $this->session->set('foto', $pengguna->foto);
                $this->session->set('nama', $pengguna->nama);
                $this->session->set('email', $pengguna->email);
                //TODO tambahan redirect sesuai asal login dan tambahan simpan session login

                $this->session->set('user', $pengguna);
                $response= [
                    "pesan"=>"success",
                    "data"=>$pengguna,
                ];

            }
            elseif ($nip_nik != $pengguna->nip || $password != $pengguna->password) {
                $response= [
                    "pesan"=>"username dan Password salah",
                    "data"=>false,
                ];
            }
        }

        else {
            $response= [
                "pesan"=>"username dan Password tidak ada",
                "data"=>false,
            ];
        }
        return json_encode($response);

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
        $response=null;
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
                        $response= [
                            "pesan"=>"Gagal Menyimpan Data",
                            "data"=>false,
                        ];

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
                        $response= [
                            "pesan"=>"Registrasi Berhasil, Silahkan Cek Email Anda Untuk Konfirmasi akun",

                        ];

                    }

                }
        }
        else{
            $response= [
                "pesan"=>"Error",

            ];
        }
        return json_encode($response);
    }

    public function lupaAction()
    {
        $respons =null;
        if ($this->request->isPost()) {
        $body = $this->config->web."reset/". $this->request->getPost('nip');
        $email = $this->request->getPost('email');
        $pengguna = Pengguna::findFirstByEmail($email);

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
                             <a href="' . $body . '">Reset Email Anda Berhasil,</a>
                             
                            <p>Reset Password Berhasil Dilakukan, Password Adalah Default dengan nim 
                            anda </p>
                            '
            ]
        );

        $this->flashSession->success("Cek Email Anda Untuk Melakukan Reset Password");
        $this->response->redirect('');

        \Phalcon\Tag::resetInput();
    }
    }


}