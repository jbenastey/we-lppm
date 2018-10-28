<?php
namespace LPPMKP\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class Ganti extends Form
{

    public function initialize($entity = null, $options = null)
    {
        $password = new Password('password', [
            'class' => 'form-control',
            'placeholder' => 'Masukan Password Lama'
        ]);
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password di butuhkan'
            ]),

        ]);
        $this->add($password);

        $passwordbaru = new Password('passwordbaru', [
            'class' => 'form-control',
            'placeholder' => 'Masukan Password Baru'
        ]);
        $passwordbaru->addValidators([
            new PresenceOf([
                'message' => 'Password di butuhkan'
            ]),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'Password Terlalu pendek, maksimal 8 karakter'
            ]),
            new Confirmation([
                'message' => 'Password tidak cocok',
                'with' => 'confirmPasswordbaru'
            ])
        ]);
        $this->add($passwordbaru);

        //confirmpassword

        $confirmPasswordbaru = new Password('confirmPasswordbaru',
            [
                'class' => 'form-control',
                'placeholder' => 'Ulangi Password Baru Anda'
            ]
        );
        $confirmPasswordbaru->addValidators([
            new PresenceOf([
                'message' => 'Password confirmasi dibutuhkan'
            ])
        ]);

        $this->add($confirmPasswordbaru);

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
