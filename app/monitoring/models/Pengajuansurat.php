<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 16/10/2018
 * Time: 1:25
 */

namespace LPPMKP\Monitoring\Models;



class Pengajuansurat extends \Phalcon\Mvc\Model
{

    public $id_pengaju;

    public $nip_pengaju;

    public $isi_surat;

    public $tahun;


    public function initialize()
    {
        $this->setSchema("lppm_office");
        $this->setSource("pengajuan_surat");
    }


    public function getSource()
    {
        return 'pengajuan_surat';
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
