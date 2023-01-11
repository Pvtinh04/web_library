<?php if(!isset($_GET['page'])) header('location:../../index.php?page=user_add_input'); ?>
<div class="container" style="height: 550px; width: 550px; margin: 15px auto; border: 1px solid #5b9bd5; display: flex; justify-content:center; flex-direction: column; align-items: center;">
<form method="post" enctype="multipart/form-data" action="">
<!-- name -->
<div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    echo $error["name"];
    ?>
    </label>
</div>
 <div style="display: flex; width: 450px; justify-content: space-around; "> 
 <div style="width: 110px;  padding: 10px 0;"> 
 <label  >  Họ và tên</label> 
</div>  
<input type="text"  value="<?php if(isset($_POST['name']) && isset($_SESSION['user']['name']) && $error["name"]==''){
    echo $_POST['name'];
} elseif(!isset($_POST['name']) && isset($_SESSION['user']['name'])){
    echo $_SESSION['user']['name'];
} elseif(!isset($_SESSION['user']['name']) && isset($_POST['name'])  && $error["name"]==''){
    echo $_POST['name'];
}
else {
    echo '';
} ?>" name="name" style="margin-left: 20px; height: 40px; width: 320px; border: 1px solid #42719b;"> 
</div> 
 <!-- Classify -->
 <div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    echo $error["classify"];
    ?>
    </label>
</div>
<div style="display: flex; width: 450px; justify-content: left; "> 
<div style="width: 109px;  padding: 10px 0;"> 
<label>  Phân loại</label> 
</div> 

<div style="display:flex; align-items: center"> 

<?php
$classify = array("Giáo viên", "Sinh viên");
$counter =2;
for ($i = 0; $i < count($classify); $i++) {
    
    ?>
    <input <?php if(isset($_POST['classify'])  && $_POST["classify"]==$counter){
    echo 'checked';
} elseif(!isset($_POST['classify']) && isset($_SESSION['user']['classify']) && $_SESSION['user']["classify"]==$counter){
    echo 'checked';
} ?> type='radio'  name='classify' style='margin-left:30px;' value=<?php echo $counter;?> >
    <label style="margin-left: 10px;" for=<?php echo $classify[$i];?>><?php echo $classify[$i];?></label>
    <?php
    $counter --;
}
    ?>

</div>
</div>

 <!-- Id  -->
 <div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    echo $error["id"];
    ?>
    </label>
</div>
<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  >ID</label>
</div>
<input type="text"  name="id"  value="<?php if(isset($_POST['id']) && isset($_SESSION['user']['id']) && $error["id"]==''){
    echo $_POST['id'];
} elseif(!isset($_POST['id']) && isset($_SESSION['user']['id'])){
    echo $_SESSION['user']['id'];
} elseif(!isset($_SESSION['user']['id']) && isset($_POST['id'])  && $error["id"]==''){
    echo $_POST['id'];
}
else {
    echo '';
} ?>" style="margin-left: 20px; height: 40px; width: 320px; border: 1px solid #42719b;" >
</div>

 <!-- Upload file image -->
 <div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    echo $error["avatar"];
    ?>
    </label>
</div>
<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  > Hình ảnh  </label>
</div>
    <input class="form-control" type="file" name="avatar" id="avatar" style="margin-left: 20px; height: 40px; width: 320px;">
</div>

<!-- Description -->
<div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    echo $error["description"];
    ?>
    </label>
</div>
<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  > Mô tả thêm  </label>
</div>
<textarea  style="margin-left: 20px; height: 150px; width: 320px;" name="description" id="" cols="50" rows="50"><?php if(isset($_POST['description']) && isset($_SESSION['user']['description']) && $error["description"]==''){
    echo $_POST['description'];
} elseif(!isset($_POST['description']) && isset($_SESSION['user']['description'])){
    echo $_SESSION['user']['description'];
} elseif(!isset($_SESSION['user']['description']) && isset($_POST['description'])  && $error["description"]==''){
    echo $_POST['description'];
}
else {
    echo '';
} ?></textarea>
</div>
<!-- BTN Submit -->

<div style="width: 300px; margin: 20px auto; display: flex; justify-content: center;">
<input type="submit" value="Xác nhận" style="background-color:#5b9bd5;height: 45px; width: 130px; font-size: 15px; border-radius: 5px; color: white;">
</div>
</form>
</div>