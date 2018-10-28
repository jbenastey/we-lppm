<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 24-Oct-18
 * Time: 13:33
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
                                    <th>NIP/NIK</th>
                                    <th>Golongan</th>
                                    <th>Judul Kegiatan</th>
                                    <th>Kluster Kegiatan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    <th>Nama Anggota :</th>
                                    <th>Lokasi Kegiatan :</th>
                                    <th>Jenis Kegiatan :</th>
                                    <th>Nomor Hp :</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $no = 1;

                                foreach ($data as $key1 => $c):
                                    foreach ($c as $key2=> $d):
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td> <?= $d->StpKetNam ?></td>
                                        <td> <?= $d->StpNipNik ?></td>
                                        <td> <?= $d->StpGol ?></td>
                                        <td> <?= $d->StpJud ?></td>
                                        <td> <?= $d->StpKlu ?></td>
                                        <td> <?= $d->StpTglKeg ?></td>
                                        <td> <?= $d->StpTglSratKel ?></td>
                                        <td>
                                            <?php if ($d->StpTglAcc == null):
                                                echo 'Belum disetujui';
                                            else : echo 'Telah disetujui';
                                            endif;
                                            ?>
                                        </td>
                                        <td>

                                            <?php
                                            if ($this->session->get('hak_akses') == 'staff') {
                                                if ($d->StpTglAcc != null) {
                                                    $nip = $this->session->get('nip');
                                                    ?>
                                                    <a href="<?= $this->url->get('office/surat-tugasperjalanan/cetak/'.$pengajuan[$key1]->id_pengaju.'/'. $key2) ?>"
                                                       class="btn btn-icon waves-effect waves-light btn-info m-b-5"> <i
                                                                class="ti-printer"></i> </a>
                                                <?php } else {
                                                    echo 'Belum Bisa di Cetak';
                                                }
                                            }
                                            elseif ($this->session->get('hak_akses') == 'kepala') {
                                                if($d->StpTglAcc==null):?>
                                                    <a href="<?= $this->url->get('office/list-tugasperjalanan/disposisi/'.$pengajuan[$key1]->id_pengaju.'/'.$key2) ?>"
                                                       class="btn btn-icon waves-effect waves-light btn-info m-b-5" disabled> <i class="ti-check">
                                                        </i> DISPOSISI</a>
                                                <?php else : echo 'Selesai';
                                                endif;
                                            }

                                            ?>

                                        </td>

                                        <?php
                                        $anggota = $d->StpAngNam;
                                        $noanggota = 1;
                                        ?>
                                        <td> <?php
                                            foreach ($anggota as $a):
                                                ?>  <?= $noanggota . ". " . $a ?> <br>
                                                <?php
                                                $noanggota++;
                                            endforeach; ?>

                                        </td>
                                        <td> <?= $d->StpLok ?></td>
                                        <td> <?= $d->StpJen ?></td>
                                        <td> <?= $d->StpNom ?></td>


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
