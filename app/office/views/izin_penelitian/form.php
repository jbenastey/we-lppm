<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 16/10/2018
 * Time: 0:56
 */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2><?php $this->flashSession->output() ?></h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-20">
                        <form class="form-horizontal" method="post" action="" role="form" name="add_name" id="add_name"
                              enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Email Dosen" class="form-control" name="SitEml"
                                           value="<?= $this->session->get('user')->email ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Nama Ketua Tim Penelitian</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Nama Dosen" class="form-control" name="SitKetNam"
                                           value="<?= $this->session->get('user')->nama ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Nama Anggota Penelitian</label>
                                <div class="col-md-10">
                                    <table class="table table-bordered" id="dynamic_field2">
                                        <tr>
                                            <td><input type="text" placeholder="Nama Anggota" class="form-control"
                                                       name="SitAngNam[]" value=""
                                                       autocomplete="off" parsley-trigger="change" required></td>
                                            <td>
                                                <button type="button" name="add" id="add2" class="btn btn-success"><i
                                                            class="fa fa-user-plus"></i> Tambah Anggota
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Judul Kegiatan Penelitian</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="SitJud"
                                           value="" autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Tanggal Kegiatan Penelitian</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-daterange-datepicker" placeholder="mm/dd/yyyy"
                                               name="SitTglKeg" id="datepicker-autoclose" readonly autocomplete="off"
                                               required>

                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Lokasi Kegiatan Penelitian</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="" class="form-control" name="SitLok" value=""
                                           autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Instansi/Unit surat yg dituju</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Kepala Sekolah MTsN/ Kepala Desa Belutu"
                                           class="form-control" name="SitInsTuj" value="" autocomplete="off"
                                           parsley-trigger="change" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Nomor KTP</label>
                                <div class="col-md-10">
                                    <input type="number" placeholder="NIK" class="form-control" name="SitNomKtp"
                                           value="" autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-2 col-form-label">Upload Foto KTP</label>
                                <div class="col-10">
                                    <input type="file" class="form-control dropify" data-max-file-size="3M"
                                           parsley-trigger="change" required name="SitFotKtp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Nomor WhatsApp</label>
                                <div class="col-md-10">
                                    <input type="number" placeholder="Nomor WhatsApp" class="form-control" name="SitNom"
                                           value="" autocomplete="off">
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
