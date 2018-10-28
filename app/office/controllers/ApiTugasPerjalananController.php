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

class ApiTugasPerjalananController extends ControllerBase
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

            $response = [
                "pesan" => "Succes",
                "data" => $isisurat,
            ];
        } else {
            $response = [
                "pesan" => "Error",
                "data" => false,
            ];
        }
        return json_encode($response);


    }

    public function formAction()
    {
        $response = null;
        $nama = Kepegawaian::find();
        $response = [
            "pesan" => "Succes",
            "data" => $nama,
        ];
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
                    $response = [
                        "pesan" => "Berhasil Menyimpan Data",

                    ];
                } else {
                    $response = [
                        "pesan" => "Gagal Menyimpan Data",

                    ];
                }

            }
            return json_encode($response);
        }
        return json_encode($response);


    }

    public function disposisiAction($id, $key2)
    {
        $response = null;
        $pengajuan = Pengajuansurat::find([
            'conditions' => "id_pengaju like'$id'"
        ]);
        if ($pengajuan != null) {


            $isi = json_decode($pengajuan[0]->isi_surat);
            $surattugas[] = $isi->surattugas;
            $tanggal = date('d/m/y');
            $surattugas[0][$key2]->StpTglAcc = $tanggal;
            $pengajuan = Pengajuansurat::findFirst($id);
            $pengajuan->isi_surat = json_encode($isi);
            $pengajuan->save();
            if ($pengajuan) {
                $response = [
                    "pesan" => "Berhasil Menyimpan Data",

                ];
            } else {
                $response = [
                    "pesan" => "Gagal Menyimpan Data",

                ];
            }

        } else {
            $response = [
                "pesan" => "ERROR",

            ];
        }
        return json_encode($response);
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
        $isisurat = $isisurat[$key];

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