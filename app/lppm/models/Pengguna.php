<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 11:50
 */

namespace LPPMKP\Lppm\Models;
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Pengguna extends Model
{

    public $id_pengguna;

    public $nip;

    public $nama;

    public $email;

    public $password;

    public $foto;

    public $hak_akses;

    public $token_akses;

    public $konfirmasi_email;

    public $no_hp;


    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }



    public function initialize()
    {
        $this->setSchema("lppm");
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