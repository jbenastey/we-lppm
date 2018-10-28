<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 16-Oct-18
 * Time: 21:46
 */

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2><?php $this->flashSession->output() ?></h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-20">
                        <form class="form-horizontal" method="post" action="" role="form" name="add_name" id="add_name">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Nama Ketua Tim Peneliti/Pengabdi</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="StpKetNam">
                                        <?php
                                        foreach ($nama as $n):
                                        ?>
                                        <option value="<?= $n->nama ?>"> <?= $n->nama ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">NIP/NIK (Ketua)</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Nama Dosen" class="form-control" name="StpNipNik"
                                           value="" parsley-trigger="change" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Pangkat/Golongan/Jabatan (Ketua)</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Pangkat/Golongan/Jabatan (Ketua)"
                                           class="form-control" name="StpGol" parsley-trigger="change" required
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Nama Anggota Pengabdi</label>
                                <div class="col-md-10">
                                    <table class="table table-bordered" id="dynamic_field4">
                                        <tr>
                                            <td><input type="text" placeholder="Nama Anggota" class="form-control"
                                                       name="StpAngNam[]" value="" parsley-trigger="change" required
                                                       autocomplete="off">
                                            </td>
                                            <td>
                                                <button type="button" name="add" id="add4" class="btn btn-success">Add
                                                    More
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Judul Kegiatan Penelitian/Pengabdian Sesuai
                                    SK</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="StpJud"
                                           value="" parsley-trigger="change" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Kluster Kegiatan Penelitian/Pengabdian Sesuai
                                    SK</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="StpKlu"
                                           value="" parsley-trigger="change" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Tanggal Kegiatan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>

                                        <input type="text" class="form-control input-daterange-datepicker"
                                               placeholder="mm/dd/yyyy"
                                               name="StpTglKeg" readonly parsley-trigger="change" required>

                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Lokasi Kegiatan Penelitian/Pengabdian</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="" class="form-control" name="StpLok" value=""
                                           parsley-trigger="change" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Jenis Kegiatan</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="StpJen">
                                        <option value="penelitian">Penelitian</option>
                                        <option value="pengabdian">Pengabdian</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Nomor HP</label>
                                <div class="col-md-10">
                                    <input type="number" placeholder="Nomor HP" class="form-control" name="StpNom"
                                           value="" parsley-trigger="change" required autocomplete="off">
                                </div>
                            </div>


                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

