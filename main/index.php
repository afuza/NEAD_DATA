<?php
include_once("../theme/header.php");
?>
<div class="container">
    <div class="text-ip text-center">YOUR IP : <?= get_client_ip(); ?>
        || Country : <?= get_country(); ?> || Device : <?= get_device(); ?> </div>
    <div class="img-login-v">
        <img src="./assets/img/anon.png" alt="" class="img-fluid img-login">
    </div>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="login-card col-lg-6 mx-auto">
            <form action="main/email.php">
                <div class="row">
                    <div class="col-lg-5 mb-3">
                        <input name="email" placeholder="Username" type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-lg-5 mb-3">
                        <input name="password" placeholder="Password" type="password" class="form-control form-control-sm">
                    </div>
                    <div class="col-lg-2 mb-3">
                        <button type="submit" class="btn btn-green btn-sm">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once("../theme/footer.php");
?>