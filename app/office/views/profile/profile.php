<?php
/**
 * Created by PhpStorm.
 * User: ahmadfauzirahman
 * Date: 23/05/18
 * Time: 18:11
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Profile : <?= $this->session->get('nama') ?></h4>
            <h4><?php $this->flashSession->output() ?></h4>

            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" action="" method="post" role="form"
                          enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Nip</label>
                            <div class="col-md-10">
                                <input type="text" name="nip" readonly class="form-control" value="<?=
                                $this->session->get('nip') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Nama</label>
                            <div class="col-md-10">
                                <input type="text" name="nama" class="form-control" value="<?=
                                $this->session->get('nama') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label" for="example-email">Email</label>
                            <div class="col-md-10">
                                <input type="email" name="email" class="form-control"
                                       value="<?= $this->session->get('email') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Ganti Password ?</label>
                            <div class="col-md-10">
                                <input type="password" name="password" class="form-control" value=
                                "<?= $this->session->get('password') ?>"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Ganti Foto ?</label>
                            <div class="col-md-10">
                                <input type="file" name="foto" class="dropify" data-max-file-size="1M"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
