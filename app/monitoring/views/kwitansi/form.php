<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 27-Oct-18
 * Time: 18:37
 */
?>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Kwitansi</h4>


            <div class="row">
                <div class="col-12">
                    <div class="p-20">

                        <form action="" class="form-horizontal" role="form" name="add_name" id="add_name" method="post">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Nama</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="Nama" name="KwiNam" value="<?= $nama?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">NIP</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="NIP" name="KwiNip" value="<?= $nip?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-2 col-form-label">Jenis</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="Jenis" name="KwiJen" value="<?= $jenis?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Judul</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="Judul" name="KwiJud" value="<?= $judul ?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-2 col-form-label">Lokasi</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="Lokasi" name="KwiLok" value="<?= $lokasi?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Tanggal Berangkat</label>

                                <div class="col-4">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>

                                        <input type="text" class="form-control input-daterange-datepicker"
                                               placeholder="mm/dd/yyyy"
                                               name="KwiTglKeg" readonly parsley-trigger="change" required value="<?= $tanggal?>">

                                    </div><!-- input-group -->

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Nomor SPB</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="Nomor SPB" name="KwiNomSpb">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-2 col-form-label">Rincian Biaya</label>
                                <div class="col-10">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <tr>
                                            <td><label class="col-2">Deskripsi</label><input type="text" name="KwiDes[]" placeholder="Deskripsi" class="form-control name_list" /></td>
                                            <td><label class="col-2">Durasi</label><input type="text" name="KwiDur[]" placeholder="Durasi" class="form-control name_list" /></td>
                                            <td><label class="col-2">Biaya</label><input type="text" name="KwiBya[]" placeholder="Biaya" class="form-control name_list" /></td>
                                            <td><label class="col-2">Keterangan</label><input type="text" name="KwiKet[]" placeholder="Keterangan" class="form-control name_list" /></td>

                                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Daftar Pengeluaran Riil</label>
                                <div class="col-10">
                                    <table class="table table-bordered" id="dynamic_field2">
                                        <tr>
                                            <td><label class="col-2">Deskripsi</label><input type="text" name="KwiDesRil[]" placeholder="Deskripsi" class="form-control name_list" /></td>
                                            <td><label class="col-2">Durasi</label><input type="text" name="KwiDurRil[]" placeholder="Durasi" class="form-control name_list" /></td>
                                            <td><label class="col-2">Biaya</label><input type="text" name="KwiByaRil[]" placeholder="Biaya" class="form-control name_list" /></td>

                                            <td><button type="button" name="add2" id="add2" class="btn btn-success">Add More</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>
                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>
<!-- end row -->
