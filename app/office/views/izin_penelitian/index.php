<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 19/10/2018
 * Time: 13:57
 */

?>

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h2><?php $this->flashSession->output() ?></h2>

            <div class="panel panel-info">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive">

                            <table id="responsive-datatable"
                                   class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0"
                                   width="100%">

                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Ketua</th>
                                    <th>Email Ketua</th>

                                    <th>Judul Penelitian</th>
                                    <th>Tanggal Kegiatan</th>


                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>

                                    <th>Nama Anggota :</th>
                                    <th>Lokasi Kegiatan :</th>
                                    <th>Instansi Tujuan :</th>
                                    <th>Nomor KTP :</th>
                                    <th>Foto KTP :</th>
                                    <th>Nomor HP :</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $no = 1;

                                foreach ($data as $key1 => $c):
                                    foreach ($c as $key2 => $d):
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td> <?= $d->SitKetNam ?></td>
                                            <td> <?= $d->SitEml ?></td>

                                            <td> <?= $d->SitJud ?></td>
                                            <td> <?= $d->SitTglKeg ?></td>


                                            <td> <?= $d->SitTglSratKel ?></td>
                                            <td>
                                                <?php if ($d->SitTglAcc == null):
                                                    echo 'Belum disetujui';
                                                else : echo 'Telah disetujui';
                                                endif;
                                                ?>
                                            </td>
                                            <td>

                                                <?php

                                                if ($this->session->get('hak_akses') == 'dosen') {

                                                    if ($d->SitTglAcc != null) {
                                                        $nip = $this->session->get('nip');
                                                        ?>
                                                        <a href="<?= $this->url->get('office/surat-izinpenelitian/cetak/' . $nip . '/' . $key2) ?>"
                                                           class="btn btn-icon waves-effect waves-light btn-info m-b-5">
                                                            <i
                                                                    class="ti-printer"></i> </a>
                                                    <?php } else {
                                                        echo 'Belum Bisa di Cetak';
                                                    }
                                                } elseif ($this->session->get('hak_akses') == 'kepala') {
                                                    if ($d->SitTglAcc == null): ?>
                                                        <a href="<?= $this->url->get('office/list-izinpenelitian/disposisi/' . $pengajuan[$key1]->id_pengaju.'/' . $key2) ?>"
                                                           class="btn btn-icon waves-effect waves-light btn-info m-b-5"
                                                           disabled> <i
                                                                    class="ti-check">
                                                            </i> DISPOSISI</a>


                                                    <?php else : echo 'Selesai';
                                                    endif;

                                                }
                                                ?>

                                            </td>

                                            <?php
                                            $anggota = $d->SitAngNam;
                                            $noanggota = 1;

                                            ?>
                                            <td> <?php
                                                foreach ($anggota as $a):
                                                    ?>  <?= $noanggota . ". " . $a ?> <br>
                                                    <?php
                                                    $noanggota++;
                                                endforeach; ?>

                                            </td>
                                            <td> <?= $d->SitLok ?></td>
                                            <td> <?= $d->SitInsTuj ?></td>
                                            <td> <?= $d->SitNomKtp ?></td>
                                            <td> <?= $d->SitFotKtp ?></td>
                                            <td> <?= $d->SitNom ?></td>


                                            <?php
                                            $no++;
                                            ?>
                                        </tr>
                                    <?php
                                    endforeach;
                                endforeach;
                                ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>
<!-- end row -->
