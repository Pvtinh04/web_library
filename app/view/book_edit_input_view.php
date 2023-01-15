<?php
          
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./web/css/editBook.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Sửa nội dung sách</title>
</head>
<body>
<button class="custombackhome"><a href="index.php?page=home"><img src="https://img.icons8.com/material-outlined/24/FFFFFF/home--v2.png"/>Trang chủ</a></button>
    <div class="component container">
    <form name='classroom_input' action='' method='POST' enctype="multipart/form-data" class="col-sm-12">  
    <div class="col-md-12">  
                <div class="col-md-12">
                    <div class="col-sm-2">
                        <div class="content">Tên sách</div>
                    </div>
                    <div class="col-sm-7">
                        <label for="" style='width: 100%'>
                        <?php 
                        echo "<div><input type='text' class='name-input' id='name' name='name' value='$namePast'></div>"
                        ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-sm-7">
                        <div><span class="error"><?php echo $nameErr;?></span></div>
                    </div>
                </div>
								<div class="col-md-12">
                    <div class="col-sm-2">
                        <div class="content">Thể loại</div>
                    </div>
                    <div class="col-sm-7">
                    <select name="category" id="category" class="category" ng-model="model.value">
                            <option id="NULL" value=""></option>
                            <?php
                            foreach ($listCate as $key => $value) {
                                if (isset($categoryPast) && $categoryPast == $key) {
                                    $select = "selected";
                                }else{
                                    $select = "";
                                }
                                echo "<option id='$key' value='" . $key. "'" . $select . ">" . $value. "</option>";
                            };
                            ?>
                     </select>                
                    </div>
                </div> 
								<div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-sm-7">
                        <div><span class="error"><?php echo $categoryErr;?></span></div>
                    </div>
                </div>                   
                <div class="col-md-12">
                    <div class="col-sm-2">
                        <div class="content">Tác giả</div>
                    </div>
                    <div class="col-sm-7">
                        <label for="" style='width: 100%'>
                        <?php 
                        echo "<div><input type='text' class='author' id='author' name='author' value='$authorPast'></div>"
                        ?>
                        </label>
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-sm-7">
                        <div><span class="error"><?php echo $authorErr;?></span></div>
                    </div>
                </div>
								<div class="col-md-12">
                    <div class="col-sm-2">
                        <div class="content">Số lượng</div>
                    </div>
                    <div class="col-sm-7">
                        <label for="" style='width: %'>
                        <?php 
                        echo "<div><input type='number' class='name-input' id='quantity' name='quantity' value='$quantityPast'></div>"
                        ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-sm-7">
                        <div><span class="error"><?php echo $quantityErr;?></span></div>
                    </div>
                </div>                                
                <div class="col-md-12">
                    <div class="col-sm-2">
                        <div class="content">Mô tả chi tiết</div>
                    </div>
                    <div class="col-sm-7">
                        <label for="">
                        <?php 
                        echo "<textarea type='input' rows='5' cols='60' name='description' id='description' >$descriptionPast</textarea>"
                        ?>
                        </label>                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-sm-7">
                        <div><span class="error"><?php echo $descriptionErr;?></span></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-sm-7">
                    <?php 
                        if(isset($_SESSION['avatarCorrect'])){
                            $avatarNew=$_SESSION['avatarCorrect'];
                            echo "<img src='../../web/avatar/bookClient/$avatarNew' class='image' id='image'>";
                        }else{
                            echo "<img src='../../web/avatar/$id/$avatarPast' class='image' id='image'>" ;
                        }
                    ?>
                    </div>
                </div>                                
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <div class="content">Avatar</div>
                    </div>
                    <div class="col-sm-7" style="display:flex">
                        <label for="" class="col-sm-8" style="display:flex">
												<?php 
                       echo " <input type='text' name='upload' id='avatar' value='$avatarPast'>";
                    ?>
                           
                        </label>
                        <div class="col-sm-2" style="padding-left: 0px;">
                            <input type="file" id="upload" name="upload" style="display:none" onchange="preview(this)"/>
                            <label for="upload" class="browse" id="browse">Browse</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-sm-7">
                        <div><span class="error"><?php echo $avatarErr;?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 accept">
                <button type="submit" id="btn-accept" name="btn-accept">Xác nhận</button>
            </div>
    </div>
    </form>
    <div>
    <script type="text/javascript" src="../../web/js/editBook.js">
			//  document.getElementById("upload").value = 
		</script>
</body>
</html>