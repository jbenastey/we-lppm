<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 10/15/2018
 * Time: 16:57
 */

namespace LPPMKP\Office\Controllers;


use LPPMKP\Lppm\Models\Pengguna;
use LPPMKP\Office\Models\Pengajuansurat;


require_once BASE_PATH . '/vendor/autoload.php';

class IzinPenelitianController extends ControllerBase
{

    public function indexAction()
    {

        $this->view->halaman = 'List Surat Izin Penelitian';
        $tahunini = getdate();
        $nip = $this->session->get('nip');
        if ($this->session->get('hak_akses') == 'dosen') {
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
            $isisurat[] = $suratpengabdians->izinpenelitian;
        }

        $this->view->data = $isisurat;
        $this->view->pengajuan = $pengajuan;

    }

    public function formAction()
    {
        $this->view->halaman = 'Form Surat Izin Penelitian';

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
                    "izinpenelitian" => [
                        [
                            "SitId" => 1,
                            "SitEml" => $this->request->getPost('SitEml'),
                            "SitKetNam" => $this->request->getPost('SitKetNam'),
                            "SitAngNam" => $this->request->getPost('SitAngNam'),
                            "SitJud" => $this->request->getPost('SitJud'),
                            "SitTglKeg" => $this->request->getPost('SitTglKeg'),
                            "SitLok" => $this->request->getPost('SitLok'),
                            "SitInsTuj" => $this->request->getPost('SitInsTuj'),
                            "SitNomKtp" => $this->request->getPost('SitNomKtp'),
                            "SitFotKtp" => $this->request->getPost('SitFotKtp'),
                            "SitNom" => $this->request->getPost('SitNom'),
                            "SitTglSratKel" => $tanggal,
                            "SitTglAcc" => "",
                        ]
                    ],
                    "FGD" => [],
                    "surattugas" => [],
                ];
                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju = $this->session->get('user')->nip;
                $pengajuan->tahun = date('y');


//                $foto = $this->request->getUploadedFiles()[0];
//                $name = $foto->getName();
//                $pindahkan = $foto->moveTo('img/foto_ktp/' . $name);

                // Check if the user has uploaded files
                if ($this->request->hasFiles() == true) {
                    // Print the real file names and their sizes
                    foreach ($this->request->getUploadedFiles() as $file) {
                        echo $file->getName(), " ", $file->getSize(), "\n";
                        $pindahkan = $file->moveTo('img/foto_ktp/');
                    }
                }

                $pengajuan->isi_surat = json_encode($isi);
                $pengajuan->save();
                if ($pengajuan && $pindahkan == true) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');

                }


            } else {
                $nip = $this->session->get('nip');
                $cek1 = Pengajuansurat::find([
                    'conditions' => "nip_pengaju like'$nip' and tahun like '$tahunini[year]'"

                ]);

                $id_pengajuan = $cek1[0]->id_pengaju;

                //id baru
                $isilama = json_decode($cek1[0]->isi_surat);

                $idakhir = end($isilama->izinpenelitian);

                $foto = $this->request->getUploadedFiles()[0];
                $name = $foto->getName();

                $fileName = $_FILES['gambar']['name'];
                $pindahkan = $foto->moveTo('img/foto_ktp/' . $name);

                $idlama = $idakhir->SitId;
                $idbaru = $idlama + 1;
                $isi = [
                    "SitId" => $idbaru,
                    "SitEml" => $this->request->getPost('SitEml'),
                    "SitKetNam" => $this->request->getPost('SitKetNam'),
                    "SitAngNam" => $this->request->getPost('SitAngNam'),
                    "SitJud" => $this->request->getPost('SitJud'),
                    "SitTglKeg" => $this->request->getPost('SitTglKeg'),
                    "SitLok" => $this->request->getPost('SitLok'),
                    "SitInsTuj" => $this->request->getPost('SitInsTuj'),
                    "SitNomKtp" => $this->request->getPost('SitNomKtp'),
                    "SitFotKtp" => $name,
                    "SitNom" => $this->request->getPost('SitNom'),
                    "SitTglSratKel" => $tanggal,
                    "SitTglAcc" => "",

                ];

                //id baru

                array_push($isilama->izinpenelitian, $isi);

                $simpan = Pengajuansurat::findFirst($id_pengajuan);
                $simpan->isi_surat = json_encode($isilama);
                $simpan->save();
                if ($simpan && $pindahkan == true) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');

                }
            }

        }
    }

    public function disposisiAction($id,$key2)
    {
        $pengajuan = Pengajuansurat::find([
            'conditions' => "id_pengaju like'$id'"
        ]);
        $isi = json_decode($pengajuan[0]->isi_surat);
        $penelitian[] = $isi->izinpenelitian;

        $tanggal = date('d/m/y');


        $penelitian[0][$key2]->SitTglAcc = $tanggal;

        $pengajuan = Pengajuansurat::findFirst($id);

        $pengajuan->isi_surat = json_encode($isi);

        $pengajuan->save();
        $this->flashSession->success('Berhasil Disposisi Data');
        $this->response->redirect('office/list-izinpenelitian');
    }

    public function printAction($nip, $key)
    {


        $pengajuan = Pengajuansurat::find([
            'conditions' => "nip_pengaju like'$nip'"
        ]);

        $suratPenelitian = $pengajuan[0]->isi_surat;
        $isisurat = json_decode($suratPenelitian);
        $isisurat = $isisurat->izinpenelitian;

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $document = $phpWord->loadTemplate('surat/SuratIzinPenelitian2.docx');
        $document->setValue('SitTglAcc', $isisurat[$key]->SitTglAcc);
        $document->setValue('SitTglKeg', $isisurat[$key]->SitTglKeg);
        $document->setValue('SitKetNam', $isisurat[$key]->SitKetNam);
        $document->setValue('SitJud', $isisurat[$key]->SitJud);
        $document->setValue('SitInsTuj', $isisurat[$key]->SitInsTuj);

        $tgl = str_replace('/', '-', $isisurat[$key]->SitTglAcc);

        $filename = "surat izin Penelitian " . $isisurat[$key]->SitKetNam . " " . $tgl . ".docx";
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