<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

<h1 class="text-center">Thêm mới mượn sách</h1>
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
<?php
?>
<div style="display: flex; width: 450px; justify-content: left; "> 
<div style="width: 109px;  padding: 10px 0;"> 
<label>  Sách</label> 

</div> 
<select name="book" id="book" style="margin-left: 20px; height: 40px; width: 320px; border: 1px solid #42719b;">
<option value=></option>
<?php 
if (!empty($book_exceed )){
 foreach ($books as $keys => $values) {
	foreach ($book_exceed as $key => $value) {

       if ($values->id != $value["book_id"]){
    					
    ?>
    <option  <?php if(isset($_POST['book'])  && $_POST["book"]==$values->id){
    echo 'selected';
}  ?> value=<?php  echo $values->id?>><?php  echo $values->name?></option>
    <?php
    }
}
}
} else {
    foreach ($books as $keys => $values) {
?>
<option  <?php if(isset($_POST['book'])  && $_POST["book"]==$values->id){
    echo 'selected';
}  ?> value=<?php  echo $values->id?>><?php  echo $values->name?></option>
<?php
    }
}
?>
</select>
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
<select name="user" id="user" style="margin-left: 20px; height: 40px; width: 320px; border: 1px solid #42719b;">
<option value=></option>
<?php 
if (!empty($user_exceed )){
 foreach ($users as $keys => $values) {
	foreach ($user_exceed as $key => $value) {

       if ($values->id != $value["user_id"]){
    					
    ?>
    <option  <?php if(isset($_POST['user'])  && $_POST["user"]==$values->id){
    echo 'selected';
}  ?> value=<?php  echo $values->id?>><?php  echo $values->name?></option>
    <?php
    }
}
}
} else {
    foreach ($users as $keys => $values) {
?>
<option  <?php if(isset($_POST['user'])  && $_POST["user"]==$values->id){
    echo 'selected';
}  ?> value=<?php  echo $values->id?>><?php  echo $values->name?></option>
<?php
    }
}
?>
</select>
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
<input type="text" id ="borrow_date"  name="borrow_date"  value="<?php if( isset($_POST['borrow_date'])  && $error["borrow_date"]==''){
    echo $_POST['borrow_date'];
} ?>" style="margin-left: 20px; height: 40px; width: 320px; border: 1px solid #42719b;" >
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
<input type="text" id ="give_date"  name="give_date"  value="<?php if( isset($_POST['give_date'])  && $error["give_date"]==''){
    echo $_POST['give_date'];
} ?>" style="margin-left: 20px; height: 40px; width: 320px; border: 1px solid #42719b;" >
</div>


<!-- BTN Submit -->

<div style="width: 300px; margin: 20px auto; display: flex; justify-content: center;">
<input type="submit" value="Mượn sách" style="background-color:#5b9bd5;height: 45px; width: 130px; font-size: 15px; border-radius: 5px; color: white;">
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