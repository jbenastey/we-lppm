<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 28-Oct-18
 * Time: 14:37
 */


namespace LPPMKP\Monitoring\Models;



class Kwitansi extends \Phalcon\Mvc\Model
{

    public $kwitansiId;

    public $kwitansiNIP;

    public $kwitansiIsi;

    public $kwitansiTahun;


    public function initialize()
    {
        $this->setSchema("lppm_monitoring");
        $this->setSource("kwitansi");
    }


    public function getSource()
    {
        return 'kwitansi';
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
