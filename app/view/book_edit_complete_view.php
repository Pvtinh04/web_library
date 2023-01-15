<?php
        if($_GET["accuracy"]==NULL){
            header("Location: ../view/book_edit_input_view.php");
        } 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./web/css/editBook.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Sửa Sách thành công</title>
</head>
<body>
    <div class="component container">
        <div class='col-md-12' style="text-align: center;">
            <p>Bạn đã chỉnh sửa thành công Sách.</p>
            <a href="../../index.php">Trở về trang chủ</p>
        </div>
    </div>
    <script type="text/javascript" src=""></script>
</body>
</html>