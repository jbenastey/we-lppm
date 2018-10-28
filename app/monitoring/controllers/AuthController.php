<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 15:20
 */

namespace LPPMKP\Monitoring\Controllers;


use Phalcon\Mvc\Controller;



class AuthController extends Controller
{
    public function initialize()
    {
        if ($this->session->has('user') == true) {
            $this->response->redirect('monitoring/error/found/404');
        }
    }

    public function loginAction()
    {
        $this->view->halaman = 'Login';
    }

}