
<div class="container" style="height: 550px; width: 550px; margin: 15px auto; border: 1px solid #5b9bd5; display: flex; justify-content:center; flex-direction: column; align-items: center;">
<form method="post" enctype="multipart/form-data" action="">
<!-- name -->

 <div style="display: flex; width: 450px; justify-content: space-around; "> 
 <div style="width: 110px;  padding: 10px 0;"> 
 <label  >  Họ và tên</label> 
</div>  
    <label style="font-style: italic;margin-left: 20px; height: 40px; width: 320px; display: flex; align-items: center; font-size: 16px"><?php 
                    if (isset($_SESSION['user']["name"])){
                        echo $_SESSION['user']["name"];
                        
                    }
                    ?>
    </label>
</div> 
 <!-- Classify -->
 
<div style="display: flex; width: 450px; justify-content: left; "> 
<div style="width: 109px;  padding: 10px 0;"> 
<label>  Phân loại</label> 
</div> 
    <label style="font-style: italic;margin-left: 20px; height: 40px; width: 320px; display: flex; align-items: center; font-size: 16px"><?php 
                if (isset($_SESSION['user']["classify"])){
                    if ($_SESSION['user']["classify"] == 1){
                        echo "Sinh viên";
                    } else {
                        echo "Giáo viên";
                    }
                    
                }
                ?>
    </label>

</div>

 <!-- Id  -->
 
<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  >ID</label>
</div>
    <label style="font-style: italic;margin-left: 20px; height: 40px; width: 320px; display: flex; align-items: center; font-size: 16px"><?php 
                        if (isset($_SESSION['user']["id"])){
                            echo $_SESSION['user']["id"];
                            
                        }
                        ?>
    </label>
</div>

 <!-- Upload file image -->
 
<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  > Hình ảnh  </label>
</div>
<label style="margin-left: 20px;  width: 320px; display: flex; align-items: center; font-size: 16px">
            <?php 
            if (!empty($_SESSION['user']["avatar"])){
                ?>
                
                <img style ="display: block;height:150px " src="<?php echo $_SESSION['user']["avatar"]; ?>" alt="">
            <?php
            }
            ?>
            </label>   
</div>

<!-- Description -->

<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  > Mô tả thêm  </label>
</div>
<p style="word-wrap:break-word;font-style: italic; height: 100px; width: 300px; font-size: 16px"><?php 
                    if (isset($_SESSION['user']["description"])){
                        echo $_SESSION['user']["description"];
                        
                    }
                    ?>
    </p>
</div>
<!-- BTN Submit -->

<div style="width: 300px; margin: 20px auto; display: flex; justify-content: center;">
<a href="index.php?page=user_add_input"><input  type="button" value="Sửa lại" style="margin-right:5px;background-color:#5b9bd5;height: 45px; width: 130px; font-size: 15px; border-radius: 5px; color: white;"></a>
<input name ="submit_add_complete" type="submit" value="Đăng ký" style="margin-left:5px;background-color:#5b9bd5;height: 45px; width: 130px; font-size: 15px; border-radius: 5px; color: white;">
</div>
</form>
</div>