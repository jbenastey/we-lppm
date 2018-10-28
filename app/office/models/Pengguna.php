<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 11:50
 */

namespace LPPMKP\Office\Models;



class Pengguna extends \Phalcon\Mvc\Model
{

    public $idPengguna;

    public $nipNik;

    public $password;

    public $hakAkses;

    public $konfirmasiEmail;


    public function initialize()
    {
        $this->setSchema("lppm_office");
        $this->setSource("pengguna");
    }


    public function getSource()
    {
        return 'pengguna';
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