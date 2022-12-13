<div style="height: 350px; width: 550px;  margin: 0 auto; border: 1px solid #5b9bd5; display: flex; justify-content:center;  flex-direction: column; align-items: center;" class="container_login">
            <form action="" method="post">
                 <div class="form-container" style="width: 450px; margin-left:255px;">
                    <label style="color: red">
                    <?php 
                    echo $error["login_id"];
                    echo $err_login;
                    ?>
                    </label>
                </div> 
                <div class="form-container">
                    <div class="form-label" style="width: 110px;"><label>Người dùng</label></div>
                    <input type="text" name="account" class="input-label" placeholder="" autofocus value="<?php echo isset($_POST["account"]) ? $_POST["account"] : ''; ?>">
                </div>
                <div class="form-container" style="width: 450px; margin-left:255px;">
                    <label style="color: red">
                    <?php 
                    echo $error["password"];
                    ?>
                    </label>
                </div>
                <div class="form-container">
                    <div class="form-label" style="width: 110px;"><label>Password</label></div>
                    <input type="password" name="password" class="input-label" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>">
                </div>
                <div class="form-container" style="margin-left:250px;">
                <a style="color:black;  font-style: oblique;" href="index.php?page=resetpassword">Quên mật khẩu</a>
                </div>  
                <div class="button-container" style="margin-top: 20px;">
                    <input type="submit" value="Đăng nhập" class="button" name="submit_login" style="cursor: pointer">
                </div>
            </form>
        </div>