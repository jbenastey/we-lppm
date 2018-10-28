<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 24-Oct-18
 * Time: 11:08
 */

namespace LPPMKP\Office\Controllers;

use LPPMKP\Lppm\Models\Pengguna;
use LPPMKP\Office\Models\Kepegawaian;
use LPPMKP\Office\Models\Pengajuansurat;

require_once BASE_PATH . '/vendor/autoload.php';

class TugasPerjalananController extends ControllerBase
{

    public function indexAction()
    {

        $this->view->halaman = 'List Surat Izin Penelitian';
        $tahunini = getdate();
        $nip = $this->session->get('nip');
        if ($this->session->get('hak_akses') == 'staff') {
            $pengajuan = Pengajuansurat::find([
                'conditions' => "nip_pengaju like'$nip'"
            ]);
        } elseif ($this->session->get('hak_akses') == 'kepala') {
            $pengajuan = Pengajuansurat::find();
        }

        foreach ($pengajuan as $pengajuans) {
            $suratPengabdian[] = json_decode($pengajuans->isi_surat);
        }
        foreach ($suratPengabdian as $suratpengabdians) {
            $isisurat[] = $suratpengabdians->surattugas;
        }

        $this->view->data = $isisurat;
        $this->view->pengajuan = $pengajuan;


    }

    public function formAction()
    {
        $this->view->halaman = 'Form Surat Tugas Perjalanan';

        $nama = Kepegawaian::find();

        $this->view->nama = $nama;

        if ($this->request->isPost()) {
            $isi = null;
            $tahunini = getdate();
            $nip = $this->session->get('nip');
            $cek = Pengajuansurat::find([
                'conditions' => "nip_pengaju like'$nip' and tahun like '$tahunini[year]'"
            ]);


            $tanggal = date('d/m/y');


            if (count($cek) == null) {
                $isi = [
                    "izinpengabdian" => [],
                    "izinpenelitian" => [],
                    "FGD" => [],
                    "surattugas" => [
                        [
                            "StpId" => 1,
                            "StpKetNam" => $this->request->getPost('StpKetNam'),
                            "StpNipNik" => $this->request->getPost('StpNipNik'),
                            "StpGol" => $this->request->getPost('StpGol'),
                            "StpAngNam" => $this->request->getPost('StpAngNam'),
                            "StpJud" => $this->request->getPost('StpJud'),
                            "StpKlu" => $this->request->getPost('StpKlu'),
                            "StpTglKeg" => $this->request->getPost('StpTglKeg'),
                            "StpLok" => $this->request->getPost('StpLok'),
                            "StpJen" => $this->request->getPost('StpJen'),
                            "StpNom" => $this->request->getPost('StpNom'),
                            "StpTglSratKel" => $tanggal,
                            "StpTglAcc" => "",
                        ]
                    ],
                ];

                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju = $this->session->get('user')->nip;
                $pengajuan->tahun = date('y');
                $pengajuan->isi_surat = json_encode($isi);
                $pengajuan->save();
                if ($pengajuan->save() == true) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');

                }


            } else {

                $cek1 = Pengajuansurat::find([
                    'conditions' => "nip_pengaju like'$nip' and tahun like '$tahunini[year]'"
                ]);

                $id_pengajuan = $cek1[0]->id_pengaju;

                //id baru
                $isilama = json_decode($cek1[0]->isi_surat);

                $idakhir = end($isilama->surattugas);

                $idlama = $idakhir->StpId;
                $idbaru = $idlama + 1;
                $isi = [
                    "StpId" => $idbaru,
                    "StpKetNam" => $this->request->getPost('StpKetNam'),
                    "StpNipNik" => $this->request->getPost('StpNipNik'),
                    "StpGol" => $this->request->getPost('StpGol'),
                    "StpAngNam" => $this->request->getPost('StpAngNam'),
                    "StpJud" => $this->request->getPost('StpJud'),
                    "StpKlu" => $this->request->getPost('StpKlu'),
                    "StpTglKeg" => $this->request->getPost('StpTglKeg'),
                    "StpLok" => $this->request->getPost('StpLok'),
                    "StpJen" => $this->request->getPost('StpJen'),
                    "StpNom" => $this->request->getPost('StpNom'),
                    "StpTglSratKel" => $tanggal,
                    "StpTglAcc" => "",

                ];

                //id baru

//                $simpan = new Pengajuansurat();
//                $simpan->nip_pengaju = $this->session->get('user')->nip;
//                $simpan->tahun = date('y');
//                $pengajuan->isi_surat = json_encode($isi);
//                $pengajuan->save();


                array_push($isilama->surattugas, $isi);

//
                $simpan = Pengajuansurat::findFirst($id_pengajuan);
                $simpan->isi_surat = json_encode($isilama);
                $simpan->save();
                if ($simpan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');

                }

            }

        }

    }

    public function disposisiAction($id, $key2)
    {
        $pengajuan = Pengajuansurat::find([
            'conditions' => "id_pengaju like'$id'"
        ]);

        $isi = json_decode($pengajuan[0]->isi_surat);
        $surattugas[] = $isi->surattugas;
        $tanggal = date('d/m/y');
        $surattugas[0][$key2]->StpTglAcc = $tanggal;
        $pengajuan = Pengajuansurat::findFirst($id);
        $pengajuan->isi_surat = json_encode($isi);
        $pengajuan->save();
        $this->flashSession->success('Berhasil Disposisi Data');
        $this->response->redirect('office/list-tugasperjalanan');
    }

    public function printAction($nip, $key)
    {

        $pengajuan = Pengajuansurat::find([
            'conditions' => "id_pengaju like'$nip'"
        ]);
        $kepala = Pengguna::find([
            'conditions' => "hak_akses like 'kepala'"
        ]);
        $surattugas = $pengajuan[0]->isi_surat;
        $isisurat = json_decode($surattugas);
        $isisurat = $isisurat->surattugas;
        $isisurat= $isisurat[$key];

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $document = $phpWord->loadTemplate('surat/SuratPerjalananDinas.docx');
        $document->setValue('StpKetNam', $isisurat->StpKetNam);
        $document->setValue('StpNipNik', $isisurat->StpNipNik);
        $document->setValue('StpTglAcc', $isisurat->StpTglAcc);
        $document->setValue('StpGol', $isisurat->StpGol);
        $document->setValue('StpJen', $isisurat->StpJen);
        $document->setValue('StpJud', $isisurat->StpJud);
        $document->setValue('StpLok', $isisurat->StpLok);
        $document->setValue('StpTglKeg', $isisurat->StpTglKeg);
        $tgl = str_replace('/', '-', $isisurat->StpTglAcc);

        $filename = "surat tugas perjalanan " . $isisurat->StpKetNam . " " . $tgl . ".docx";
        $name = "$filename";
        $document->saveAs($name);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        flush();
        readfile($filename);
        unlink($filename); // deletes the temporary file
        exit;
        die;


    }
}