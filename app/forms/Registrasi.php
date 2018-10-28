<?php
namespace LPPMKP\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class Registrasi extends Form
{

    public function initialize($entity = null, $options = null)
    {
        $nip = new Text('nip',
            [
                'class' => 'form-control',
                'placeholder' => 'Masukkan NIP/NIK Anda'
            ]
        );

        $nip->addValidators([
            new PresenceOf([
                'message' => 'Nip/Nik Harus Dimasukkan'
            ])
        ]);

        $this->add($nip);


        $nama = new Text('nama',
            [
                'class' => 'form-control',
                'placeholder' => 'Nama Lengkap'
            ]
        );

        $nama->addValidators([
            new PresenceOf([
                'message' => 'Nama Diperlukan'
            ])
        ]);

        $this->add($nama);


        // password
        $password = new Password('password', [
            'class' => 'form-control',
            'placeholder' => 'Password'
        ]);
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password di butuhkan'
            ]),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'Password Terlalu pendek, maksimal 8 karakter'
            ]),

        ]);
        $this->add($password);

       

        $email = new Text('email', [
            'class' => 'form-control',
            'placeholder' => 'Harus Memakai E-mail Mahasiswa Uin'
        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'Email Dibutuhkan'
            ]),
            new Email([
                'message' => 'Email tidak valid'
            ])
        ]);
        $this->add($email);

    }

    public function messages($nama)
    {
        if ($this->hasMessagesFor($nama)) {
            foreach ($this->getMessagesFor($nama) as $message) {
                $this->flash->error($message);
            }
        }
    }
}
