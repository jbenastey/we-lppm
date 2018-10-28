<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 18/10/2018
 * Time: 21:01
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
                                <label class="col-2 col-form-label">Nama Narasumber</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Nama Narasumber" class="form-control"
                                           name="FgdNarNam" autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Nama Moderator</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Nama Moderator" class="form-control"
                                           name="FgdModNam" autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Judul Kegiatan Penelitian/Pengabdian Sesuai
                                    SK</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="FgdJud"
                                           value="" autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Jenis FGD</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="FgdJen">
                                        <option value="penelitian">Penelitian</option>
                                        <option value="pengabdian">Pengabdian</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Lokasi FGD</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="" class="form-control" name="FgdLok" value=""
                                           autocomplete="off" parsley-trigger="change" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Nama Peserta</label>
                                <div class="col-md-10">
                                    <table class="table table-bordered" id="dynamic_field1">
                                        <tr>
                                            <td><input type="text" placeholder="Nama Peserta" class="form-control" name="FgdPesNam[]" value=""></td>
                                            <td><button type="button" name="add" id="add1" class="btn btn-success">Add More</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-2 control-label">Tanggal Pelaksanaan</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy"
                                               name="FgdTglPel" id="datepicker-autoclose" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>


                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
