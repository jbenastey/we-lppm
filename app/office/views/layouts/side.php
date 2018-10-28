<?php
?>

<ul>
    <li class="text-muted menu-title" id="page-title-tour">Navigation</li>

    <li>
        <a href="<?= $this->url->get('office') ?>" class="waves-effect"><i
                    class="mdi mdi-view-dashboard"></i> <span> Dashboard </span>
        </a>
    </li>

    <li>
        <a href="<?= $this->url->get('office/profile') ?>" class="waves-effect"><i class=" mdi mdi-face "></i>
            <span>Profile Ku</span> </a>
    </li>


    <?php if ($this->session->get('hak_akses') == 'staff'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Data Master</li>
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class="mdi mdi-account"></i>
                <span>Data Pengguna</span>
            </a>
    </li>
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class=" mdi mdi-account-box  "></i>
                <span>Data Dosen</span> </a>
    </li>
        <li class="has_sub">
            <a class="waves-effect ">
                <i class="mdi mdi-folder-open"></i>
                <span>Form Pembuatan Surat</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" style="display: none;">

                <li>
                    <a href="<?= $this->url->get('office/form-tugasperjalanan') ?>">
                        </i><span>Tugas Perjalanan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="has_sub">
            <a class="waves-effect ">
                <i class="mdi mdi-folder-open"></i>
                <span>List Pengajuan Surat</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" style="display: none;">
                <li>
                    <a href="<?= $this->url->get('office/list-tugasperjalanan') ?>">
                        </i><span>Tugas Perjalanan</span>
                    </a>
                </li>

            </ul>
        </li>
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class=" mdi mdi-view-list"></i>
                <span>Data Jenis Surat</span> </a>
    </li>

    <li>
        <a href="<?= $this->url->get('office/pengajuan') ?>" class="waves-effect"><i class="mdi mdi-library-books"></i>
                <span>Permohonan Pembuatan Surat</span>
        </a>
    </li>
    

    <?php elseif ($this->session->get('hak_akses') == 'dosen' || $this->session->get('hak_akses') == 'pustakawan'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Panel Dosen</li>

        <li class="has_sub">
            <a class="waves-effect ">
                <i class="mdi mdi-folder-open"></i>
                <span>Form Pengajuan Surat</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" style="display: none;">
                <li>
                    <a href="<?= $this->url->get('office/form-izinpenelitian') ?>">
                     </i><span>Izin Penelitian</span></a>
                </li>
                <li>
                    <a href="<?= $this->url->get('office/form-izinpengabdian') ?>">
                        </i><span>Izin Pengabdian</span>
                    </a>
                </li>

                <li>
                    <a href="<?= $this->url->get('office/form-fgd') ?>">
                        </i><span>FGD</span></a>
                </li>

            </ul>
        </li>



        <li class="has_sub">
            <a class="waves-effect ">
                <i class="mdi mdi-folder-open"></i>
                <span>List Pengajuan Surat</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" style="display: none;">
                <li>
                    <a href="<?= $this->url->get('office/list-izinpenelitian') ?>">
                        </i><span>Izin Penelitian</span></a>
                </li>
                <li>
                    <a href="<?= $this->url->get('office/list-izinpengabdian') ?>">
                        </i><span>Izin Pengabdian</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $this->url->get('office/list-fgd') ?>">
                        </i><span>FGD</span></a>
                </li>

            </ul>
        </li>


	</li>



    <?php elseif ($this->session->get('hak_akses') == 'kepala'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Panel Kasubbag</li>
        <li class="has_sub">
            <a class="waves-effect ">
                <i class="mdi mdi-folder-open"></i>
                <span>ACC Pengajuan Surat</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" style="display: none;">
                <li>
                    <a href="<?= $this->url->get('office/list-izinpenelitian') ?>">
                        </i><span>Izin Penelitian</span></a>
                </li>
                <li>
                    <a href="<?= $this->url->get('office/list-izinpengabdian') ?>">
                        </i><span>Izin Pengabdian</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $this->url->get('office/list-tugasperjalanan') ?>">
                        </i><span>Tugas Perjalanan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $this->url->get('office/list-fgd') ?>">
                        </i><span>FGD</span></a>
                </li>

            </ul>
        </li>


    <?php elseif ($this->session->get('hak_akses') == 'staff' || $this->session->get('hak_akses') == 'kepala'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Laporan</li>
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class="mdi mdi-assignment"></i>
                <span>Laporan Penelitian Dosen</span>
            </a>
    </li>
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class="glyphicon glyphicon-stats"></i>
                <span>Grafik Penelitian Dosen </span>
            </a>
    </li>


    <?php endif; ?>
</ul>
