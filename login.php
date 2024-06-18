<?php
include_once 'part/header.php';
if (isset($_SESSION ['user_id'])){
        header("Location: index.php");
	
}
?>
<style>
         html, body {
            height: 100%;
        }
        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
        }
</style>

<div class="container">
        <div class="login-box">
            <h3 class="text-center mb-4">Giriş</h3>
            <form method="POST" action="conf/auth.php">
                <div class="form-group">
                    <label for="email">Email Adresi</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Emailinizi daxil edin ">
                </div>
                <div class="form-group">
                    <label for="password">Şifrə</label>
                    <input type="password" name="pass" class="form-control" id="password" placeholder="Şifrenizi daxil edin ">
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Daxil ol </button>
                <input type="hidden" name="form_source" value="login_form">
            </form>
        </div>
    </div>
    <?php
include_once 'part/footer.php';
?>
