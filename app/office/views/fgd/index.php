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
                    <table id="responsive-datatable"
                           class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0"
                           width="100%">

                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Narasumber</th>
                            <th>Nama Moderator</th>
                            <th>Judul Kegiatan</th>
                            <th>Jenis FGD</th>
                            <th>Lokasi FGD</th>
                            <th>Nama Peserta</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $no = 1;

                        foreach ($data as $key => $c):
                            foreach ($c as $key2 => $d):
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td> <?= $d->FgdNarNam ?></td>

                                    <td> <?= $d->FgdModNam ?></td>
                                    <td> <?= $d->FgdJud ?></td>
                                    <td> <?= $d->FgdJen ?></td>
                                    <td> <?= $d->FgdLok ?></td>
                                    <?php
                                    $anggota = $d->FgdPesNam;
                                    $noanggota = 1;
                                    $nip = $this->session->get('nip');
                                    ?>
                                    <td> <?php
                                        foreach ($anggota as $a):
                                            ?>  <?= $noanggota . ". " . $a ?> <br>
                                            <?php
                                            $noanggota++;
                                        endforeach; ?>

                                    </td>
                                    <td> <?= $d->FgdTglPel ?></td>
                                    <td> <?= $d->FgdTglSurat ?></td>
                                    <td>
                                        <?php if ($d->FgdTglAcc == null):
                                            echo 'Belum disetujui';
                                        else : echo 'Telah disetujui';
                                        endif;
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        if ($this->session->get('hak_akses') == 'dosen') {
                                            {

                                            }
                                            if ($d->FgdTglAcc != null) {
                                                ?>
                                                <a href="<?= $this->url->get('office/surat-fgd/cetak/' . $pengajuan[$key]->id_pengaju . '/' . $key) ?>"
                                                   class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                                            class="ti-printer"></i> </a>
                                                <?php
                                            } else {
                                                echo 'Belum Bisa di Cetak';
                                            }
                                        } elseif ($this->session->get('hak_akses') == 'kepala') {
                                            if ($d->FgdTglAcc == null):?>

                                                <a href="<?= $this->url->get('office/list-fgd/disposisi/' . $pengajuan[$key]->id_pengaju . '/' . $key2) ?>"
                                                   class="btn btn-icon waves-effect waves-light btn-info m-b-5"
                                                   disabled> <i class="ti-check">
                                                    </i> DISPOSISI</a>
                                            <?php else : echo 'Selesai';
                                            endif;

                                        }

                                        ?>

                                    </td>


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

        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>
<!-- end row -->