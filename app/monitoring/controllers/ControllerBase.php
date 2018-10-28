<?php
namespace LPPMKP\Monitoring\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {

        if ($this->session->has('user') == false) {
            $this->response->redirect('monitoring/masuk');
        } else {

//            $this->allowAccess();
        }
    }
}
