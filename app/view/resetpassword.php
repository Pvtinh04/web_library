<div style="height: 350px; width: 550px;  margin: 0 auto; border: 1px solid #5b9bd5; display: flex; justify-content:center;  flex-direction: column; align-items: center;" class="container_login">
            <form action="" method="post">
                 <div class="form-container" style="width: 450px; margin-left:255px;">
                    <label style="color: red">
                    <?php 
                    echo $error["login_id"];
                    ?>
                    </label>
                </div> 
                <div class="form-container">
                    <div class="form-label" style="width: 110px;"><label>Người dùng</label></div>
                    <input type="text" name="account" class="input-label" placeholder="" autofocus value="<?php echo isset($_POST["account"]) ? $_POST["account"] : ''; ?>">
                </div>
                
                <div class="button-container" style="margin-top: 20px;">
                    <input style="width: 200px;" type="submit" value="Khôi phục mật khẩu" class="button" name="sm_password" style="cursor: pointer">
                </div>
            </form>
        </div>