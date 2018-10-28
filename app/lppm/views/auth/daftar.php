<?php
/**
 * Created by PhpStorm.
 * User: ahmadfauzirahman
 * Date: 24/05/18
 * Time: 22:41
 */
?>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="m-t-40 card-box">
    <div class="text-center">
        <a href="<?= $this->url->get('daftar') ?>" class="logo"><span>LPPM UIN <span> SUSKA RIAU</span></span></a>
        <h5 class="text-muted m-t-0 font-600">Assalammuaaikum</h5>
    </div>

        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Daftar</h4>
            <p><?php $this->flashSession->output() ?></p>
        </div>
        <div class="panel-body">
            <form class="form-horizontal m-t-20" action="<?= $this->url->get('daftar') ?>" method="post">

                <div class="form-group ">
                    <div class="col-xs-12">
                        <?= $form->render('nip'),
                        $form->messages('nip')?>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <?= $form->render('nama'),
                        $form->messages('nama')?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <?= $form->render('email'),
                        $form->messages('email')?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <?= $form->render('password'),
                        $form->messages('password') ?>
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                            Daftar
                        </button>
                    </div>
                </div>

            </form>

        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <p class="text-dark">Sudah Punya Akun?<a href="<?= $this->url->get('') ?>" class="text-primary m-l-5"><b>Login</b></a>
                </p>
            </div>
        </div>
    </div>
    <!-- end card-box -->



</div>
<!-- end wrapper page -->
