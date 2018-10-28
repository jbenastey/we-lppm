<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 28/10/2018
 * Time: 0:48
 */

namespace LPPMKP\Office\Controllers;

use LPPMKP\Lppm\Models\Pengguna;
use LPPMKP\Office\Models\Pengajuansurat;

require_once BASE_PATH . '/vendor/autoload.php';

class ApiIzinPengabdianController extends ControllerBase
{
    public function initialize()
    {
        $ses_nip_nik = $this->session->get('nip');
        if (!empty($ses_nip_nik)) {
            $this->response->redirect('');
        }
    }

    public function indexAction()
    {

        $response = null;
        $nip = $this->session->get('nip');
        if ($nip != null) {
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
                $isisurat[] = $suratpengabdians->izinpengabdian;
            }
            $response = [
                "pesan" => "Succes",
                "data" => $isisurat,
            ];
        } else {
            $response = [
                "pesan" => "Error",
                "data" => false,
            ];
        }return json_encode($response);

    }

    public function formAction()
    {

        $response = null;
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
                    "izinpengabdian" => [[
                        "SipId" => 1,
                        "SipKetNam" => $this->request->getPost('SipKetNam'),
                        "SipAngNam" => $this->request->getPost('SipAngNam'),
                        "SipJud" => $this->request->getPost('SipJud'),
                        "SipTglKeg" => $this->request->getPost('SipTglKeg'),
                        "SipLok" => $this->request->getPost('SipLok'),
                        "SipInsTuj" => $this->request->getPost('SipInsTuj'),
                        "SipKabKot" => $this->request->getPost('SipKabKot'),
                        "SipTglSratKel" => $tanggal,
                        "SipTglAcc" => "",
                    ]],
                    "izinpenelitian" => [],
                    "FGD" => [],
                    "surattugas" => [],
                ];

                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju = $this->session->get('user')->nip;
                $pengajuan->tahun = date('y');
                $pengajuan->isi_surat = json_encode($isi);
                $pengajuan->save();
                if ($pengajuan->save() == true) {
                    $response = [
                        "pesan" => "Berhasil Menyimpan Data",

                    ];

                } else {

                    $response = [
                        "pesan" => "Gagal Menyimpan Data",

                    ];

                }


            } else {

                $cek1 = Pengajuansurat::find([
                    'conditions' => 'nip_pengaju like ' . $this->session->get('user')->nip,
                    'conditions' => 'tahun like ' . $tahunini['year'],

                ]);

                $id_pengajuan = $cek1[0]->id_pengaju;

                //id baru
                $isilama = json_decode($cek1[0]->isi_surat);

                $idakhir = end($isilama->izinpengabdian);

                $idlama = $idakhir->SipId;
                $idbaru = $idlama + 1;
                $isi = [
                    "SipId" => $idbaru,
                    "SipKetNam" => $this->request->getPost('SipKetNam'),
                    "SipAngNam" => $this->request->getPost('SipAngNam'),
                    "SipJud" => $this->request->getPost('SipJud'),
                    "SipTglKeg" => $this->request->getPost('SipTglKeg'),
                    "SipLok" => $this->request->getPost('SipLok'),
                    "SipInsTuj" => $this->request->getPost('SipInsTuj'),
                    "SipKabKot" => $this->request->getPost('SipKabKot'),
                    "SipTglSratKel" => $tanggal,
                    "SipTglAcc" => "",

                ];

                //id baru

                array_push($isilama->izinpengabdian, $isi);


                $simpan = Pengajuansurat::findFirst($id_pengajuan);
                $simpan->isi_surat = json_encode($isilama);
                $simpan->save();
                if ($simpan) {
                    $response= [
                        "pesan"=>"Berhasil Menyimpan Data",
                    ];
                } else {

                    $response= [
                        "pesan"=>"Gagal Menyimpan Data",

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

    public function disposisiAction($id, $key2)
    {
        $response = null;
        $pengajuan = Pengajuansurat::find($id);
        if($pengajuan!=null){
            $tanggal = date('d/m/y');

            $isi = json_decode($pengajuan[0]->isi_surat);

            $suratPengabdian[] = $isi->izinpengabdian;

            $suratPengabdian[0][$key2]->SipTglAcc = $tanggal;

            $pengajuan = Pengajuansurat::findFirst($id);

            $pengajuan->isi_surat = json_encode($isi);

            $pengajuan->save();
            if($pengajuan){
                $response= [
                    "pesan"=>"Berhasil Menyimpan Data",

                ];
            }else{
                $response= [
                    "pesan"=>"Gagal Menyimpan Data",

                ];
            }

        }else{
            $response= [
                "pesan"=>"ERROR",

            ];
        }
        return json_encode($response);

    }

    public function printAction($nip, $key1, $key2)
    {
        $pengajuan = Pengajuansurat::find([
            'conditions' => "id_pengaju like'$nip'"
        ]);
        $kepala = Pengguna::find([
            'conditions' => "hak_akses like 'kepala'"
        ]);
        $suratPenelitian = $pengajuan[0]->isi_surat;
        $isisurat = json_decode($suratPenelitian);
        $isisurat = $isisurat->izinpengabdian;
        $isisurat = $isisurat[$key2];

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $document = $phpWord->loadTemplate('surat/SuratIzinPengabdian.docx');
        $document->setValue('SipTglAcc', $isisurat->SipTglAcc);
        $document->setValue('SipInsTuj', $isisurat->SipInsTuj);
        $document->setValue('SipKabKot', $isisurat->SipKabKot);
        $document->setValue('SipKetNam', $isisurat->SipKetNam);
        $document->setValue('SipTglKeg', $isisurat->SipTglKeg);
        foreach ($isisurat->SipAngNam as $anggota):
            $document->setValue('SipAngNam', $anggota);
        endforeach;

        $document->setValue('SipJud', $isisurat->SipJud);
        $document->setValue('SipLok', $isisurat->SipLok);

        $document->setValue('ketua', $kepala[0]->nama);

        $document->setValue('ketuanip', $kepala[0]->nip);
        $tgl = str_replace('/', '-', $isisurat->SipTglAcc);

        $filename = "surat izin Pengabdian " . $isisurat->SipKetNam . " " . $tgl . ".docx";
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