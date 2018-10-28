<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class Lppm extends RouterGroup
{
    public function initialize()
    {
        // Default paths
        $this->setPaths(
            [
                'module' => 'lppm',
                'namespace' => 'LPPMKP\Lppm\Controllers',
            ]
        );

        $this->setPrefix('');
        $this->add('/', 'index::index');


        //$this->addGet('/keluar', 'auth::logout');
        $this->add('/daftar', 'auth::daftar');


        $this->add('/lupa', 'auth::lupa');

        $this->add('/auth/loginproses', 'auth::loginproses');
        $this->add('/konfirmasi/{id}', 'auth::konfirmasi');



    }

}


class Office extends RouterGroup
{
    public function initialize()
    {
        // Default paths
        $this->setPaths(
            [
                'module' => 'office',
                'namespace' => 'LPPMKP\Office\Controllers',
            ]
        );

        // All the routes start with /blog
        $this->setPrefix('/office');

        $this->add('/', ['controller' => 'index', 'action' => 'index']);
//        $this->add('/errors/show404', 'error::show404');

        $this->add('/:params', [
                'controller' => 'index',
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:params', [
                'controller' => 1,
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:action/:params', [
                'controller' => 1,
                'action' => 2,
                'params' => 3,
            ]
        );

        $this->addGet('/masuk', 'auth::login');
        $this->addGet('/keluar', 'auth::logout');
        //$this->addGet('/daftarakun', 'auth::daftar');

        //pengguna
        $this->add('/pengguna', 'pengguna::index');
        $this->add('/pengguna/edit/{nip}', 'pengguna::update');
        $this->add('/pengguna/hapus/{nip}', 'pengguna::delete');
        $this->add('/pengguna/tambah', 'pengguna::add');

        $this->add('/pengajuan', 'pengajuan::pengajuan');
        $this->add('/profile', 'profile::profile');

        //form
        $this->add('/form-izinpengabdian', 'izin_pengabdian::form');
        $this->add('/form-izinpenelitian', 'izin_penelitian::form');
        $this->add('/form-fgd', 'fgd::form');
        $this->add('/form-tugasperjalanan', 'tugas_perjalanan::form');

        //list
        $this->add('/list-izinpengabdian', 'izin_pengabdian::index');
        $this->add('/list-izinpenelitian', 'izin_penelitian::index');
        $this->add('/list-fgd', 'fgd::index');
        $this->add('/list-tugasperjalanan','tugas_perjalanan::index');
        //disposisi
        $this->add('/list-izinpengabdian/disposisi/{id}/{key2}', 'izin_pengabdian::disposisi');
        $this->add('/list-fgd/disposisi/{id}/{key2}', 'fgd::disposisi');
        $this->add('/list-izinpenelitian/disposisi/{id}/{key2}','izin_penelitian::disposisi');
        $this->add('/list-tugasperjalanan/disposisi/{id}/{key2}','tugas_perjalanan::disposisi');

        //cetak
        $this->add('/surat-izinpengabdian/cetak/{nip}/{key2}', 'izin_pengabdian::print');
        $this->add('/surat-fgd/cetak/{nip}/{key}', 'fgd::print');
        $this->add('/surat-izinpenelitian/cetak/{nip}/{key}', 'izin_penelitian::print');
        $this->add('/surat-tugasperjalanan/cetak/{nip}/{key1}', 'tugas_perjalanan::print');

        //api
        $this->add('/api/auth/loginproses', 'apiauth::loginproses');
        $this->add('/api/daftar', 'apiauth::daftar');
        $this->add('/api/list-izinpengabdian', 'api_izin_pengabdian::index');
        $this->add('/api/form-izinpengabdian', 'api_izin_pengabdian::form');
        $this->add('/api/list-izinpengabdian/disposisi/{id}/{key2}', 'api_izin_pengabdian::disposisi');
        $this->add('/api/list-fgd', 'api_fgd::index');
        $this->add('/api/form-fgd', 'api_fgd::form');
        $this->add('/api/list-fgd/disposisi/{id}/{key2}', 'api_fgd::disposisi');
        $this->add('/api/list-penelitian', 'api_izin_penelitian::index');
        $this->add('/api/form-penelitian', 'api_izin_penelitian::form');
        $this->add('/api/list-penelitian/disposisi/{id}/{key2}', 'api_izin_penelitian::disposisi');
        $this->add('/api/list-tugasperjalanan', 'api_tugas_perjalanan::index');
        $this->add('/api/form-tugasperjalanan', 'api_tugas_perjalanan::form');
        $this->add('/api/list-tugasperjalanan/disposisi/{id}/{key2}', 'api_tugas_perjalanan::disposisi');

    }
}

class Monitoring extends RouterGroup
{
    public function initialize($di)
    {
        // Default paths
        $this->setPaths(
            [
                'module' => 'monitoring',
                'namespace' => 'LPPMKP\Monitoring\Controllers',
            ]
        );

        // All the routes start with /blog
        $this->setPrefix('/monitoring');

        $this->add('/', ['controller' => 'index', 'action' => 'index']);

        $this->add('/:params', [
                'controller' => 'index',
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:params', [
                'controller' => 1,
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:action/:params', [
                'controller' => 1,
                'action' => 2,
                'params' => 3,
            ]
        );

        $this->addGet('/masuk', 'auth::login');
        $this->addGet('/keluar', 'auth::logout');

    }
}

$router = $di->getRouter();


$router->mount(
    new Lppm()
);
$router->mount(
    new Office()
);

$router->mount(
    new Monitoring()
);

// Define your routes here

$router->handle();
