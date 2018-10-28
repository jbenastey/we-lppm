<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 18/10/2018
 * Time: 21:03
 */

namespace LPPMKP\Office\Controllers;

use LPPMKP\Lppm\Models\Pengguna;
use PhpOffice\PhpWord\PhpWord;
use LPPMKP\Office\Models\Pengajuansurat;

require_once BASE_PATH . '/vendor/autoload.php';
class ApiFgdController extends ControllerBase
{
    public function initialize()
    {
        $ses_nip_nik = $this->session->get('nip');
        if (!empty($ses_nip_nik)) {
            $this->response->redirect('');
        }
    }
    public function indexAction(){
        $response = null;
        $tahunini = getdate();
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
            $isisurat[] = $suratpengabdians->FGD;
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
    public function formAction(){
        $response = null;

        if ($this->request->isPost()) {
            $isi =null;
            $tahunini = getdate();
            $nip =$this->session->get('nip');
            $cek = Pengajuansurat::find([
                'conditions' =>  "nip_pengaju like'$nip' and tahun like '$tahunini[year]'"
            ]);
            $tanggal= date('d/m/y');
            if(count($cek)==null){
                $isi = [
                    "izinpengabdian" => [],
                    "izinpenelitian"=>[],
                    "FGD"=>[
                        [
                            "FgdId"=> 1,
                            "FgdNarNam"=>  $this->request->getPost('FgdNarNam'),
                            "FgdModNam"=>  $this->request->getPost('FgdModNam'),
                            "FgdJud"=>  $this->request->getPost('FgdJud'),
                            "FgdJen"=>  $this->request->getPost('FgdJen'),
                            "FgdLok"=>  $this->request->getPost('FgdLok'),
                            "FgdPesNam"=>  $this->request->getPost('FgdPesNam'),
                            "FgdTglPel"=>  $this->request->getPost('FgdTglPel'),
                            "FgdTglSurat"=>  $tanggal,
                            "FgdTglAcc"=>  "",
                        ]
                    ],
                    "surattugas"=>[],
                ];

                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju=$this->session->get('user')->nip;
                $pengajuan->tahun=date('y');
                $pengajuan->isi_surat=json_encode($isi);
                $pengajuan->save();
                if ($pengajuan->save()==true) {


                    $response = [
                        "pesan" => "Berhasil Menyimpan Data",

                    ];
                }
                else {

                    $response = [
                        "pesan" => "Gagal Menyimpan Data",

                    ];

                }


            }else {

                $nip =$this->session->get('nip');
                $cek1 = Pengajuansurat::find([
                    'conditions' =>  "nip_pengaju like'$nip' and tahun like '$tahunini[year]'"
                ]);
                $id_pengajuan= $cek1[0]->id_pengaju;

                //id baru
                $isilama = json_decode($cek1[0]->isi_surat);

                $idakhir = end($isilama->FGD);

                $idlama = $idakhir->FgdId;

                $idbaru= $idlama+1;
                $isi = [
                    "FgdId"=> $idbaru,
                    "FgdNarNam"=>  $this->request->getPost('FgdNarNam'),
                    "FgdModNam"=>  $this->request->getPost('FgdModNam'),
                    "FgdJud"=>  $this->request->getPost('FgdJud'),
                    "FgdJen"=>  $this->request->getPost('FgdJen'),
                    "FgdLok"=>  $this->request->getPost('FgdLok'),
                    "FgdPesNam"=>  $this->request->getPost('FgdPesNam'),
                    "FgdTglPel"=>  $this->request->getPost('FgdTglPel'),
                    "FgdTglSurat"=>  $tanggal,
                    "FgdTglAcc"=>  "",

                ];

                //id baru

                array_push($isilama->FGD,$isi);


                $simpan = Pengajuansurat::findFirst($id_pengajuan);
                $simpan->isi_surat=json_encode($isilama);
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

        } else{
            $response= [
                "pesan"=>"Error",

            ];
        }
        return json_encode($response);

    }
    public function disposisiAction($id,$key2){
        $response = null;
        $pengajuan = Pengajuansurat::find([
            'conditions' =>  "id_pengaju like'$id'"
        ]);
        if($pengajuan!=null){
        $isi = json_decode($pengajuan[0]->isi_surat);

        $fgd =$isi->FGD;
        $tanggal= date('d/m/y');

        $fgd[$key2]->FgdTglAcc=$tanggal;
        $pengajuan = Pengajuansurat::findFirst($id);
        $pengajuan->isi_surat=json_encode($isi);

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
    public function printAction($nip,$key){

        $pengajuan = Pengajuansurat::find([
            'conditions' =>  "id_pengaju like'$nip'"
        ]);
        $kepala = Pengguna::find([
            'conditions' =>  "hak_akses like 'kepala'"
        ]);
        $suratFGD = $pengajuan[0]->isi_surat;
        $isisurat = json_decode($suratFGD);
        $isisurat= $isisurat->FGD;
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $document = $phpWord->loadTemplate('surat/SuratFGD.docx');

        $document->setValue('FgdNarNam', $isisurat[$key]->FgdNarNam);
        $document->setValue('FgdModNam', $isisurat[$key]->FgdModNam);
        $total = count($isisurat[$key]->FgdPesNam);

        $document->cloneRow('no', $total);
        for ($i =0; $i<$total;$i++){
            $document->setValue('no#'.($i+1), ($i+3));
            $document->setValue('FgdAngNam#'.($i+1), $isisurat[$key]->FgdPesNam[$i]);
            $document->setValue('peserta#'.($i+1), "Peserta");

        }

        $document->setValue('FgdJud', $isisurat[$key]->FgdJud);

        $document->setValue('FgdTglPel', $isisurat[$key]->FgdTglPel);

        $document->setValue('FgdLok', $isisurat[$key]->FgdLok);
        $document->setValue('FgdTglAcc', $isisurat[$key]->FgdTglAcc);
        $document->setValue('ketua', $kepala[0]->nama);
        $document->setValue('ketuanip', $kepala[0]->nip);

        $tgl= str_replace('/','-',$isisurat[$key]->FgdTglAcc);

        $filename= "surat FGD ".$isisurat[$key]->FgdNarNam." ".$tgl.".docx";
        $name = "$filename";
        $document->saveAs($filename);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
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
