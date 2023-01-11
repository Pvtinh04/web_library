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
            require '../controllers/reset_password_form.php';
            
    ?>
    <div class="timetable">
        <form action="" class="form" method="POST">
            <?php
                $result = alladmins();
            ?>
        <table class="tbl" >
                <tr>
                    <th style="width: 40px"> No</th>
                    <th> Tên người dùng</th>
                    <th class="centerth"> Mật khẩu mới</th>
                    <th class="centerth"> Action </th>
                </tr>
                <tr>
                <?php
                        for ($i = 0; $i <  count($result); $i++){  
                ?>
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $result[$i]->login_id ?></td>
                        <td><input type="text" name="newpass<?php echo $result[$i]->id ?>" style="cursor:pointer" class="newpass"></td>
                        <td><input class="inputClean" type="text" name="idadmin<?php echo $result[$i]->id ?>" value="<?php echo $result[$i]->login_id ?>">
                            <input type="submit" name="resetpw<?php echo $result[$i]->id ?>" value="Reset" style="cursor:pointer"  class="reset">
                            </td>
                </tr>
                <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <div>
                                <span class="error"><?php echo $passErr[$result[$i]->id]; ?></span>
                            </div>
                        </td>
                        <td></td>
                </tr>
                <?php
                        }
                ?>
               
            </table>
        </form>
    </div>
</body>
</html>