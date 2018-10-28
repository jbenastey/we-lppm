<?php

namespace LPPMKP\Office\Controllers;

class IndexController extends ControllerBase
{


    public function indexAction()
    {
        $halaman = 'Beranda';
        $this->view->halaman = $halaman;
    }

}

