<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

<h1 class="text-center">Xác nhận thông tin mượn sách</h1>
<div class="container" style="height: 550px; width: 550px; margin: 15px auto; border: 1px solid #5b9bd5; display: flex; justify-content:center; flex-direction: column; align-items: center;">
<form method="post" enctype="multipart/form-data" action="">
<!-- name -->
<!-- Classify -->
<div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    if(isset($error["book"])) echo $error["book"];
    ?>
    </label>
</div>
<div style="display: flex; width: 450px; justify-content: left; "> 
<div style="width: 109px;  padding: 10px 0;"> 
<label>  Sách</label> 
</div> 
<span><?php if(isset($_SESSION['borrow']['book'])){ 
    foreach($books as $key => $value){
      echo $value->name;
    }
} ?></span>
</div> 
 <!-- Classify -->
 <div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    if(isset($error["user"])) echo $error["user"];
    ?>
    </label>
</div>
<div style="display: flex; width: 450px; justify-content: left; "> 
<div style="width: 109px;  padding: 10px 0;"> 
<label>  Người dùng</label> 
</div> 
<span><?php if(isset($_SESSION['borrow']['user'])){ 
    foreach($users as $key => $value){
      echo $value->name;
    }
} ?></span>
</div>

 <!-- borrow date  -->
 <div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    if(isset($error["borrow_date"])) echo $error["borrow_date"];
    ?>
    </label>
</div>
<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  >Từ ngày</label>
</div>
<span><?php if(isset($_SESSION['borrow']['borrow_date'])){ echo $_SESSION['borrow']['borrow_date'];} ?></span>
</div>
<!-- date  -->
<div style="width: 450px; text-align: left;">
    <label style="color: red">
    <?php 
    if(isset($error["give_date"])) echo $error["give_date"];
    ?>
    </label>
</div>
<div  style="display: flex; width: 450px; ">
<div style="width: 110px;  padding: 10px 0;">
<label  >Ngày trả</label>
</div>
<span><?php if(isset($_SESSION['borrow']['give_date'])){ echo $_SESSION['borrow']['give_date'];} ?></span>
</div>


<!-- BTN Submit -->
<div style="width: 300px; margin: 20px auto; display: flex; justify-content: center;">
<button  style="margin-right:5px;background-color:#5b9bd5;height: 45px; width: 130px; font-size: 15px; border-radius: 5px; color: white;" type="button" id="btn-back" name="back" onclick="history.back()">Sửa lại</button>
<input type="submit" value="Xác nhận" style="background-color:#5b9bd5;height: 45px; width: 130px; font-size: 15px; border-radius: 5px; color: white;">
</div>
</form>
</div>
<script type="text/javascript">
        $(function() {
            $('#borrow_date').datepicker({
                format: "dd/mm/yyyy"
            });
        });
        $(function() {
            $('#give_date').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>