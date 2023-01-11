<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../web/css/base.css">
    <title>Document</title>
</head>
<body>
    <?php
            require '../controllers/reset_password.php';     
    ?>
    <div class="timetable">
        <form class="form" method="POST" action="">
            <div class="main">
                <div class="element"><span class="error"><?php echo $userErr;?></span></div>
                <div class="element">
                    <label for="reset-password">Người dùng</label>
                    <input id="reset-password" type="text" class="input-element" name="reset-input">
                </div>
                
                <div class="element">
                    <button type="submit" class="btn-submit" name="reset-password">Gửi yêu cầu reset password</button>
                </div>
               
            </div>
        </form>
    </div>
</body>
</html>