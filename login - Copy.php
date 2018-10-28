
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 12:44
 */

	<body>
    <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>Lembaga Penelitian<span>Pengabdian Masyarakat</span></span></a>
                <h5 class="text-muted m-t-0 font-600">LPPM Office - Uin Suska Riauu</h5>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Assalamu'alaikum Wr.Wb</h4>
                </div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20" method="post" action="<?= $this->url->get('auth/loginproses') ?>">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="nip_nik" placeholder="NIP/NIK" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">MAsuk</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end card-box-->

            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="text-muted">Belum Punya Akun <a href="page-register.html" class="text-primary m-l-5"><b>Daftar</b></a></p>
                </div>
            </div>

        </div>
        <!-- end wrapper page -->

