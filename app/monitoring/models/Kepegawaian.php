<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 24-Oct-18
 * Time: 23:31
 */

namespace LPPMKP\Monitoring\Models;

class Kepegawaian extends \Phalcon\Mvc\Model
{

    public $no;

    public $nip;

    public $nidn;

    public $no_induk_internal;

    public $no_kode_absen;

    public $nama;

    public $tempat_tgl_lahir;

    public $tipe_id;

    public $nomor_id;

    public $jender;

    public $agama;

    public $status_pernikahan;

    public $alamat;

    public $kota;

    public $kode_pos;

    public $no_telp;

    public $no_hp;

    public $email;

    public $gol_darah;

    public $tinggi_badan;

    public $berat_badan;

    public $cacat;

    public $hobi;

    public $tanggal_masuk;

    public $tmt_pns;

    public $tmt_cpns;

    public $kategori_pegawai;

    public $tipe_pegawai;

    public $status_pekerjaan;

    public $status_pekerjaan1;

    public $bank;

    public $norek_bank;

    public $norek_penerima;

    public $no_jamsos;

    public $no_askes;

    public $status_npwp;

    public $npwp;

    public $usia_pensiun;


    public function initialize()
    {
        $this->setSchema("lppm_office");
        $this->setSource("kepegawaian");
    }


    public function getSource()
    {
        return 'kepegawaian';
    }


    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }


    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}

