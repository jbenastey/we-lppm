<?php

namespace LPPMKP\Monitoring\Controllers;

use Phalcon\Mvc\Controller;
use LPPMKP\Monitoring\Models\Receipt;

class ReceiptController extends Controller
{
    public function indexAction()
    {
        $this->view->halaman = 'selamat datang';

    }

    public function addAction()
    {
        $this->view->halaman = 'tambah data kwitansi';

        if ($this->request->isPost()) {
            $add = new Receipt();

            $add->receiptName = $this->request->getPost('name');
            $add->receiptNIP = $this->request->getPost('nip');
            $add->receiptLocation = $this->request->getPost('location');
            $add->receiptDateDepart = $this->request->getPost('datedepart');
            $add->receiptDateReturn = $this->request->getPost('datereturn');
            $add->receiptNoSPB = $this->request->getPost('nospb');

            $number = count([$this->request->getPost('deskripsi')]);
            //var_dump($number);exit;
            $detailValue = '';
            //$no = 1;
            if($number>=0){
                for ($i=0; $i<$number;$i++){
                    $detailValue = [
                            'deskripsi' => $this->request->getPost('deskripsi'),
                            'durasi' => $this->request->getPost('durasi'),
                            'biaya' => $this->request->getPost('biaya'),
                            'ket' => $this->request->getPost('ket')
                    ];
                    //$no++;
                }
            }

            $add->receiptDetail = json_encode($detailValue);

            //var_dump(json_encode($detailValue)); exit;

            $save  = $add->save();
            if ($save) {

                $this->flashSession->success('Berhasil Menyimpan Data');

                $this->response->redirect('monitoring/receipt');
                } else {

                $this->flashSession->error('Gagal Menyimpan Data');

                $this->response->redirect('monitoring/receipt');

//            }
            }

        }
    }
}
