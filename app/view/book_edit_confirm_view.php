
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./web/css/editBook.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Xác nhận sửa tải liệu</title>
</head>
<body>
   
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
                            <div class="lable-input">
                            <?php 
                           if (isset($_SESSION["name"])){
                            echo $_SESSION["name"];
                           }
                            
                           ?>
                            </div>
                            
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Thể loại</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:50%'>
                            <div class="lable-input">
                            <?php 
                           if (isset($_SESSION["category"])){
                            echo $_SESSION["category"];
                           }
                            
                           ?>
                            
                            </label>                  
                        </div>
                    </div>
										<div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Tác giả</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:50%'>
                            <div class="lable-input">
                            <?php 
                           if (isset($_SESSION["author"])){
                            echo $_SESSION["author"];
                           }
                            
                           ?>
                            </div>
                            </label>                  
                        </div>
                    </div>
										<div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Số lượng</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:30%'>
                            <div class="lable-input">
                            <?php 
                           if (isset($_SESSION["quantity"])){
                            echo $_SESSION["quantity"];
                           }
                            
                           ?>
                            </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-2">
                            <div class="content">Mô tả chi tiết</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="" style='width:100%'>
                            <div class="lable-input">
                            <?php 
                           if (isset($_SESSION["description"])){
                            echo $_SESSION["description"];
                           }
                            
                           ?>
                            </div>
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
                            
                            echo $_SESSION["avatarPast"];
                            ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 accept">
                        <button type="button" id="btn-back" name="back" onclick="history.back()">Sửa lại</button>
                        <button type="submit" id="btn-edit" name="edit">Đăng ký</button>
                </div>
            </form>
        
        </div>
    </div>
</body>
</html>


<!-- Test View mới -->
