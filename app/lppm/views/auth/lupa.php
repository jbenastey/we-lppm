<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 10/11/2018
 * Time: 22:36
 */
?>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

    <div class="m-t-40 card-box">
        <div class="text-center">
            <h5 class="text-muted m-t-0 font-600">LPPM UIN SUSKA RIAU</h5>
        </div>
        <div class="text-center">
            <h4 class="text font-bold m-b-0">Lupa Password</h4>
            <p><?php $this->flashSession->output() ?></p>
        </div>
        <div class="panel-body">
            <form class="form-horizontal m-t-20" action="" method="post">

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" placeholder="NIP / NIK" name="nip">
                    </div>
                </div>



                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                            Reset
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>


</div>
<!-- end wrapper page -->

