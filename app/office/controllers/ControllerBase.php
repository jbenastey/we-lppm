<?php
namespace LPPMKP\Office\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {

        if ($this->session->has('user') == false) {
            $this->response->redirect('office/masuk');
        } else {
//
//            $this->allowAccess();
        }
    }
}
