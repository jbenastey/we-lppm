<?php

?>
<div class="user-img">
    <img src="<?= $this->url->get('img/foto_user/' . $this->session->get('foto')) ?>" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
    <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
</div>

<h5 class="text-capitalize"><a href="#"><?= $this->session->get('user')->nama ?></a></h5>

<ul class="list-inline">
    <li class="list-inline-item">
        <a href="#" >
            <i class="mdi mdi-settings"></i>
        </a>
    </li>

    <li class="list-inline-item">
        <a href="" data-toggle="modal" data-target="#modalLogout" class="text-custom">
            <i class="mdi mdi-power"></i>
        </a>
    </li>
</ul>



