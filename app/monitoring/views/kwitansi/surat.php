<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 27-Oct-18
 * Time: 21:28
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
                                    <th>Nama Anggota :</th>
                                    <th>Lokasi Kegiatan :</th>
                                    <th>Jenis Kegiatan :</th>
                                    <th>Nomor Hp :</th>
                                    <th>Aksi :</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $no = 1;

                                foreach ($data as $key => $d):
                                    foreach ($d as $key2 => $data2):
                                        if ($data2->StpTglAcc == !null){
                                    ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td> <?= $data2->StpKetNam ?></td>
                                                <td> <?= $data2->StpNipNik ?></td>
                                                <td> <?= $data2->StpGol ?></td>
                                                <td> <?= $data2->StpJud ?></td>
                                                <td> <?= $data2->StpKlu ?></td>
                                                <td> <?= $data2->StpTglKeg ?></td>
                                                <td> <?= $data2->StpTglSratKel ?></td>


                                                <?php
                                                $anggota = $data2->StpAngNam;
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
                                                <td> <?= $data2->StpLok ?></td>
                                                <td> <?= $data2->StpJen ?></td>
                                                <td> <?= $data2->StpNom ?></td>
                                                <td><a href="<?= $this->url->get('monitoring/form-kwitansi/'.$pengajuan[$key]->id_pengaju.'/'.$key2) ?>">asdas</a></td>


                                                <?php
                                                $no++;
                                                ?>
                                            </tr>
                                    <?php
                                        }
                                        ?>

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
