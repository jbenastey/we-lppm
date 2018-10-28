<?php

namespace LPPMKP\Lppm\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $ses_nip_nik;
    protected $ses_hak_akses;
    protected $default_timezone;

    public function initialize()
    {
        $this->ses_nip_nim = $this->session->get('nip');
        $this->ses_hak_akses = $this->session->get('hak_akses');
        $this->default_timezone = date_default_timezone_set('Asia/Jakarta');
       // if (empty($this->ses_nip_nim)) {
         //   $this->response->redirect('office/masuk');
        //}

    }
}