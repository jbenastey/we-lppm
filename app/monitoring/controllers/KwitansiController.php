<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 27-Oct-18
 * Time: 18:39
 */

namespace LPPMKP\Monitoring\Controllers;


use LPPMKP\Lppm\Models\Pengguna;

use LPPMKP\Monitoring\Models\Kwitansi;
use LPPMKP\Monitoring\Models\Pengajuansurat;

class KwitansiController extends ControllerBase
{
    public function indexAction(){
        $this->view->halaman = 'List Kwitansi';
    }

    public function suratAction(){
        $this->view->halaman = 'List Surat Tugas Perjalanan';
        $pengajuan = Pengajuansurat::find();
        foreach ($pengajuan as $pengajuan1):
            $data[] = json_decode($pengajuan1->isi_surat);
        endforeach;
        foreach ($data as $data1):
            $data2[] = $data1->surattugas;
        endforeach;
        $suratTugas = $pengajuan[0]->isi_surat;

        $isisurat = json_decode($suratTugas);
        $isisurat = $isisurat->surattugas;
        $this->view->data = $data2;

        $this->view->pengajuan = $pengajuan;
    }

    public function formAction($id,$key)
    {
        $this->view->halaman = 'Form Kwitansi';

        $pengajuan = Pengajuansurat::find([
            'conditions' => "id_pengaju like'$id'"
        ]);
        $isi = json_decode($pengajuan[0]->isi_surat);
        $surattugas[] = $isi->surattugas;

        $nama = $surattugas[0][$key]->StpKetNam;
        $nip = $surattugas[0][$key]->StpNipNik;
        $lokasi = $surattugas[0][$key]->StpLok;
        $tanggal = $surattugas[0][$key]->StpTglKeg;
        $judul = $surattugas[0][$key]->StpJud;
        $jenis = $surattugas[0][$key]->StpJen;

        $this->view->nama = $nama;
        $this->view->nip = $nip;
        $this->view->lokasi = $lokasi;
        $this->view->tanggal = $tanggal;
        $this->view->judul = $judul;
        $this->view->jenis = $jenis;


        if ($this->request->isPost()) {
            $isi = null;
            $tahunini = getdate();
            $nip = $this->session->get('nip');
            $cek = Kwitansi::find([
                'conditions' => "kwitansiNIP like'$nip' and kwitansiTahun like '$tahunini[year]'"
            ]);


            $tanggal = date('d/m/y');


            if (count($cek) == null) {

                $isi = [
                    "kwitansi" => [
                        [
                            "KwiId" => 1,
                            "KwiNam" => $this->request->getPost('KwiNam'),
                            "KwiNip" => $this->request->getPost('KwiNip'),
                            "KwiJen" => $this->request->getPost('KwiJen'),
                            "KwiJud" => $this->request->getPost('KwiJud'),
                            "KwiLok" => $this->request->getPost('KwiLok'),
                            "KwiTglKeg" => $this->request->getPost('KwiTglKeg'),
                            "KwiNomSpb" => $this->request->getPost('KwiNomSpb'),
                            "KwiRin" => [
                                "KwiDes" => $this->request->getPost('KwiDes'),
                                "KwiDur" => $this->request->getPost('KwiDur'),
                                "KwiBya" => $this->request->getPost('KwiBya'),
                                "KwiKet" => $this->request->getPost('KwiKet'),
                            ],
                            "KwiRinRil" => [
                                "KwiDesRil" => $this->request->getPost('KwiDesRil'),
                                "KwiDurRil" => $this->request->getPost('KwiDurRil'),
                                "KwiByaRil" => $this->request->getPost('KwiByaRil'),
                            ],
                            "KwiTglKel" => $tanggal,
                        ]
                    ],
                ];

                $kwitansi = new Kwitansi();
                $kwitansi->kwitansiNIP = $this->session->get('user')->nip;
                $kwitansi->kwitansiTahun = date('Y');
                $kwitansi->kwitansiIsi = json_encode($isi);
                $kwitansi->save();
                if ($kwitansi->save() == true) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('monitoring/list-surat');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('monitoring/list-surat');

                }

            } else {

                $cek1 = Kwitansi::find([
                    'conditions' => "kwitansiNIP like'$nip' and kwitansiTahun like '$tahunini[year]'"
                ]);

                $nip_pengaju = $cek1[0]->kwitansiNIP;

                //id baru
                $isilama = json_decode($cek1[0]->kwitansiIsi);

                $idakhir = end($isilama->kwitansi);

                $idlama = $idakhir->KwiId;
                $idbaru = $idlama + 1;

                $isi = [
                    "KwiId" => $idbaru,
                    "KwiNam" => $this->request->getPost('KwiNam'),
                    "KwiNip" => $this->request->getPost('KwiNip'),
                    "KwiJen" => $this->request->getPost('KwiJen'),
                    "KwiJud" => $this->request->getPost('KwiJud'),
                    "KwiLok" => $this->request->getPost('KwiLok'),
                    "KwiTglKeg" => $this->request->getPost('KwiTglKeg'),
                    "KwiNomSpb" => $this->request->getPost('KwiNomSpb'),
                    "KwiRin" => [
                        "KwiDes" => $this->request->getPost('KwiDes'),
                        "KwiDur" => $this->request->getPost('KwiDur'),
                        "KwiBya" => $this->request->getPost('KwiBya'),
                        "KwiKet" => $this->request->getPost('KwiKet'),
                    ],
                    "KwiRinRil" => [
                        "KwiDesRil" => $this->request->getPost('KwiDesRil'),
                        "KwiDurRil" => $this->request->getPost('KwiDurRil'),
                        "KwiByaRil" => $this->request->getPost('KwiByaRil'),
                    ],
                    "KwiTglKel" => $tanggal,
                ];

var_dump($isilama);
                array_push($isilama->kwitansi, $isi);
 var_dump($isilama);die;
                //var_dump($isilama);die;
                $simpan = Kwitansi::findFirst($nip_pengaju);
                $simpan->kwitansiIsi = json_encode($isilama);

                $simpan->save();

                if ($simpan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('monitoring/list-surat');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('monitoring/list-surat');

                }

            }

        }


    }

}
