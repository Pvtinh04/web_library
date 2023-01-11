<?php 
  // if($_SESSION['name']==""){
  //     header("Location: ../view/book_edit_input_view.php");
  // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../web/css/bookRender/editBook.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Xác nhận sửa tải liệu</title>
</head>
<body>
    <?php
        require '../controller/book_edit_confirm_controller.php';
        require '../common/define.php';
				// Check name or id null router go back -1
        // if($_GET["name"]===NULL && $_GET["id"]===NULL){
        //     header("Location: ../view/book_edit_input_view.php");
        // }
    ?>
    <button class="custombackhome"><a href="../../index.php"><img src="https://img.icons8.com/material-outlined/24/FFFFFF/home--v2.png"/>Trang chủ</a></button>
    <div class="component container">
        <div class='col-md-12'>
            <form name='classroom-confirm' action='' method='POST'> 
                <div class="col-md-12"> 
                    <div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Tên Sách</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:50%'>
                            <?php 
                           
                            echo "<div class='lable-input'>$name</div>"
                            ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Thể loại</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:50%'>
                            <?php 
                           
                            foreach ($listCategory as $key=>$build){
                                if($key===$category){
                                    echo "<div class='lable-input'>$build</div>";
                                }
                            }
                            ?>
                            </label>                  
                        </div>
                    </div>
										<div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Thể loại</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:50%'>
                            <?php 
                            
                            foreach ($listAuthor as $key=>$build){
                                if($key===$author){
                                    echo "<div class='lable-input'>$build</div>";
                                }
                            }
                            ?>
                            </label>                  
                        </div>
                    </div>
										<div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Số lượng</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:30%'>
                            <?php 
                            
                            echo "<div class='lable-input'>$quantity</div>"
                            ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Mô tả chi tiết</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:100%'>
                            <?php 
                            
                            echo "<div class='lable-input'>$description</div>"
                            ?>
                            </label>                        
                        </div>
                    </div>
                    <div class="col-md-12 seacrch">
                        <div class="col-sm-2">
                            <div class="content">Avatar</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:30%'>
                            <?php 
															if($avatar == $avatarPast){
																	echo "<img src='../../web/avatar/$id/$avatarPast' class='image' id='image'>" ;
																}else{
																	echo "<img src='../../web/avatar/bookClient/$avatar' class='image' id='image'>";
																}
                            	// echo "<img src='../../web/avatar/bookClient/$avatar' class='image'>"
                            ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 accept">
                        <button type="button" id="btn-back" name="back" onclick="history.back()">Sửa lại</button>
                        <button type="submit" id="btn-edit" name="edit">Sửa</button>
                </div>
            </form>
        
        </div>
    </div>
</body>
</html>