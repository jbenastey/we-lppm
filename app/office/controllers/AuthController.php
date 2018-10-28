<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 15:20
 */

namespace LPPMKP\Office\Controllers;


use Phalcon\Mvc\Controller;



class AuthController extends Controller
{
    public function initialize()
    {
        if ($this->session->has('user') == true) {
            $this->response->redirect('office/error/found/404');
        }
    }

    public function loginAction()
    {
        $this->view->halaman = 'Login';
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('office/masuk');


    }

}