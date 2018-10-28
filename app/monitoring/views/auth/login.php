<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 14:37
 */?>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="m-t-40 card-box">
        <div class="text-center">
            <a href="<?= $this->url->get('monitoring') ?>" methods="post" class="logo"><span>Monitoring<span> Keuangan</span></span></a>
            <h5 class="text-muted m-t-0 font-600">LPPM UIN SUSKA RIAU</h5>
        </div>
        <!-- <a href="<?= $this->url->get('monitoring') ?>" class="btn btn-info btn-block">Monitoring Keuangan</a>-->

        <div class="text-center">
            <h4 class="text font-bold m-b-0">Assalamu'alaikum Wr Wb</h4>
            <h4><?php $this->flashSession->output() ?></h4>

        </div>
        <div class="p-10">
            <form class="form-horizontal m-t-20"  action="<?= $this->url->get('auth/loginproses') ?>" method="post">

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" placeholder="NIP / NIK" name="nipNik">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password"  placeholder="Password" name="password">
                    </div>
                </div>

                <input type="hidden" value="monitoring" name="from_monitoring">
                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Masuk</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="<?= $this->url->get('lupa')?>" class="text-muted"><i class="fa fa-lock m-r-5"></i> Lupa Password?</a>
                    </div>
                </div>

            </form>

        </div>
        <div style="font-size: 11px; color: #727b84;">
            © <?= date('Y') ?> LPPM UIN SUSKA RIAU by
        </div>
    </div>
    <!-- end card-box-->

</div>
<!-- end wrapper page -->
