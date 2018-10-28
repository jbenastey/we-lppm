<?php

?>

<div class="user-img">
    <img src="assets/images/users/avatar-1.jpg" alt="user-img"
         title="Mat Helme"
         class="img-circle img-thumbnail img-responsive">
    <div class="user-status offline"><i class="mdi mdi-dot-circle"></i></div>
</div>

<h5 class="text-capitalize"><a href="#"><?= $this->session->get('user')->nama ?></a></h5>

<ul class="list-inline">
    <li>
        <a href="#">
            <i class="mdi mdi-settings"></i>
        </a>
    </li>

    <li>
        <a href="" data-toggle="modal" data-target="#modalLogout" class="text-custom">
            <i class="mdi mdi-power"></i>
        </a>
    </li>

</ul>

