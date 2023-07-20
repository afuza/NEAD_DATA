<?php
include_once("../theme/header.php");
?>
<div class="container">
    <div class="text-ip text-center">YOUR IP : <?= get_client_ip(); ?>
        || Country : <?= get_country(); ?> || Device : <?= get_device(); ?> </div>
    <div class="img-login-v">
        <img src="https://nead-email.b-cdn.net/anon.png" alt="" class="img-fluid img-login">
    </div>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="login-card col-lg-6 mx-auto">
            <form id="login" autocomplete="off" method="POST">
                <div class="row">
                    <div class="col-lg-5 mb-3">
                        <input placeholder="Username" id="email" type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-lg-5 mb-3">
                        <input placeholder="Password" id="password" type="password" class="form-control form-control-sm">
                    </div>
                    <div class="col-lg-2 mb-3">
                        <input type="submit" id="login-btn" class="btn btn-green btn-sm" value="login">
                    </div>
                </div>
                <div class="text-center text-light">
                    <p id="cookie"><?= $_SESSION['login_alert_shown']; ?></p>
                </div>
            </form>
        </div>
    </div>

</div>
<?php
if (isset($_GET['logout']) && $_GET['logout'] === "success") {
    if (!isset($_COOKIE['logout_alert_shown'])) {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Login Success',
            showConfirmButton: false,
            timer: 3000,
            iconColor: '#149414',
            confirmButtonColor: '#149414',
            background: 'black',
        });
        Cookies.set('logout_alert_shown', 'true', {
            expires: 9999,
            path: '/',
        });
        </script>";
    }
}

?>
<script src="../assets/js/_login.js"></script>
<?php
include_once("../theme/footer.php");
?>