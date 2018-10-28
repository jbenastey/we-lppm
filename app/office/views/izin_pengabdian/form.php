<?php
/**
 * Created by PhpStorm.
 * User: ahmadfauzirahman
 * Date: 02/06/18
 * Time: 5:36
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
                              data-parsley-validate novalidate>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Nama Ketua Tim Pengabdi</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Nama Dosen" class="form-control" name="SipKetNam"
                                           value="<?= $this->session->get('user')->nama ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Nama Anggota Pengabdi</label>
                                <div class="col-md-10">
                                    <table class="table table-bordered" id="dynamic_field3">
                                        <tr>
                                            <td><input type="text" placeholder="Nama Anggota" class="form-control"
                                                       name="SipAngNam[]" value="" autocomplete="off"
                                                       parsley-trigger="change" required></td>
                                            <td>
                                                <button type="button" name="add" id="add3" class="btn btn-success"><i
                                                            class="fa fa-user-plus"></i> Tambah Anggota
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Judul Kegiatan Pengabdian</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="SipJud"
                                           value="" autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Tanggal Kegiatan Pengabdian</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>

                                        <input type="text" class="form-control input-daterange-datepicker"
                                               placeholder="mm/dd/yyyy"
                                               name="SipTglKeg" readonly parsley-trigger="change" required>

                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Lokasi Kegiatan Pengabdian</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="" class="form-control" name="SipLok" value=""
                                           autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Instansi/Unit surat yg dituju</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Kepala Sekolah MTsN/ Kepala Desa Belutu"
                                           class="form-control" name="SipInsTuj" value="" autocomplete="off"
                                           parsley-trigger="change" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Kabupaten/Kota</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Kota Pekanbaru/Kabupaten Kampar"
                                           class="form-control" name="SipKabKot" value="" autocomplete="off"
                                           parsley-trigger="change" required>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

