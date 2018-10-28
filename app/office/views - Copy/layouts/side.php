<?php
?>

<ul>
    <li class="text-muted menu-title" id="page-title-tour">Navigation</li>

    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i
                    class="mdi mdi-view-dashboard"></i> <span> Dashboard </span>
        </a>
    </li>

    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class=" mdi mdi-face "></i>
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
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class=" mdi mdi-view-list"></i>
                <span>Data Jenis Surat</span> </a>
    </li>

    <li>
        <a href="<?= $this->url->get('office/pengajuan/pengajuan') ?>" class="waves-effect"><i class="glyphicon glyphicon-file"></i>
                <span>Data Pengajuan Surat</span>
        </a>
    </li>
    

    <?php elseif ($this->session->get('hak_akses') == 'dosen' || $this->session->get('hak_akses') == 'pustakawan'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Panel Dosen</li>
	
			<li>
			<a href="<?= $this->url->get('pengajuan') ?>" class="waves-effect"><i class="glyphicon glyphicon-file"></i>
					<span>Form Pengajuan Surat</span></a>
			</li>
			<li>
			<a href="<?= $this->url->get('pengajuan') ?>" class="waves-effect"><i class="glyphicon glyphicon-file"></i>
					<span>Surat Selesai</span></a>
			</li>
	</li>
                            
    

    <?php elseif ($this->session->get('hak_akses') == 'kepala'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Pannel Kasubbag</li>
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class="glyphicon glyphicon-eye-open"></i>
                <span>Lihat dan ACC</span>
            </a>
    </li>

    <?php elseif ($this->session->get('hak_akses') == 'staff' || $this->session->get('hak_akses') == 'kepala'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Laporan</li>
    <li>
        <a href="<?= $this->url->get('') ?>" class="waves-effect"><i class="mdi mdi-mail-send"></i>
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
