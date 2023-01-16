<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

    <div class="timetable">
       
            
        <table class="tbl" >
                <tr>
                    <th style="width: 40px"> No</th>
                    <th> Tên người dùng</th>
                    <th class=""> Mật khẩu mới</th>
                    <th class=""> Action </th>
                </tr>
                <tr>
                <?php
                        for ($i = 0; $i <  count($result); $i++){  
                            
                ?>
                <form action="" class="form" method="POST">
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $result[$i]->login_id ?></td>
                        <td><input type="text" name="newpass<?php echo $result[$i]->login_id ?>" style="cursor:pointer" class="newpass"></td>
                        <td><input class="inputClean" type="text" name="idadmin<?php echo $result[$i]->login_id ?>" value="<?php echo $result[$i]->login_id ?>">
                            
                            <button type="submit" name="reset_passowrd" value="<?php echo $result[$i]->login_id ?>" style="cursor:pointer"  class="reset">Reset</button>
                            </td>
                </tr>
                <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <div>
                                <span class="error"><?php echo $passErr[$result[$i]->login_id]; ?></span>
                            </div>
                        </td>
                        <td></td>
                </tr>
                </form>
                <?php
                        }
                ?>
               
            </table>
      
    </div>