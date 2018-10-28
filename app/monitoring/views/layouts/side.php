<?php
?>

<ul>
    <li class="text-muted menu-title" id="page-title-tour">Navigation</li>

    <li>
        <a href="<?= $this->url->get('monitoring') ?>" class="waves-effect"><i
                    class="mdi mdi-view-dashboard"></i> <span> Dashboard </span>
        </a>
    </li>

    <li>
        <a href="<?= $this->url->get('monitoring/profile') ?>" class="waves-effect"><i class=" mdi mdi-face "></i>
            <span>Profile Ku</span> </a>
    </li>


    <?php if ($this->session->get('hak_akses') == 'uang'): ?>
    <li class="text-muted menu-title" id="page-title-tour">Data Master</li>
        <li class="has_sub">
            <a class="waves-effect ">
                <i class="mdi mdi-folder-open"></i>
                <span>Kwitansi</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" style="display: none;">

                <li>
                    <a href="<?= $this->url->get('monitoring/form-kwitansi')?>">
                        </i><span>Form</span></a>
                </li>
                <li>
                    <a href="<?= $this->url->get('monitoring/list-kwitansi')?>">
                        </i><span>List Kwitansi</span></a>
                </li>
                <li>
                    <a href="<?= $this->url->get('monitoring/list-surat')?>">
                        </i><span>List Surat Tugas</span></a>
                </li>

            </ul>
        </li>


    <?php endif; ?>
</ul>
