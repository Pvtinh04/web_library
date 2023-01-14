<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <title>Sửa thông tin người dùng</title>
</head>
<style>

    .container{
        width: 40%;    
    }
    .containers{
        padding: 10px;
        border: 1px solid #5b9bd5;
    }

    .col-sm-2{
        width: 30%;
    }

    .col-sm-6{
        display: flex;
        gap:10px;
        flex:1;
    }

    .col-sm-6-avatar{
        display: block;
    }
</style>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Sửa thông tin người dùng</h1>
        <form method="post" enctype="multipart/form-data" class="containers">
            <div class="form-group row mt-4">
                <label class="col-sm-2" for="name">Họ và tên</label>
                <div class="col-sm-6">
                    <?php
                    if (isset($_SESSION['user_name'])){
                        $value_user_name = $_SESSION['user_name'];
                    }
                    else{
                        $value_user_name = $userInfo['name'];
                    }
                    ?>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $value_user_name;?>">
                    <span class="text-danger font-weight-bold">
                    <?php
                        echo isset($error['name']) ? $error['name'] : '';
                    ?>
                    </span>
                </div>
            </div>
            <div class="form-group row mt-4">
                <label class="col-sm-2" for="classify">Phân loại</label>
                <div class="col-sm-6">
                    <?php
                        if (isset($_SESSION['user_classify'])){
                            $user_classify = $_SESSION['user_classify'];
                        }
                        else{
                            $user_classify = $userInfo['type'];
                        }
                        $classify = array("Giáo viên", "Sinh viên");
                        $count=2;
                        for ($i = 0; $i < count($classify); $i++) {
                    ?>
                        <input <?php if($count==$user_classify){
                            echo 'checked';
                        }
                        ?>
                        type="radio" id="classify" name="classify" value=<?php echo $count;?>>
                        <label for=<?php echo $classify[$i];?>><?php echo $classify[$i];?></label><br>
                        <?php
                        $count--;
                        }
                    ?>
                    <span class="text-danger font-weight-bold">
                    <?php
                        echo isset($error['classify']) ? $error['classify'] : '';
                    ?>
                    </span>
                </div>
            </div>
            <div class="form-group row mt-4">
                <label class="col-sm-2" for="name">ID</label>
                <div class="col-sm-6">
                    <?php
                    if (isset($_SESSION['user_id'])){
                        $user_id = $_SESSION['user_id'];
                    }
                    else{
                        $user_id = $userInfo['user_id'];
                    }
                    ?>
                    <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id;?>">
                    <span class="text-danger font-weight-bold">
                    <?php
                        echo isset($error['id']) ? $error['id'] : '';
                    ?>
                    </span>
                </div>
            </div>

            <div class="form-group row mt-4">
                <label class="col-sm-2" for="user_avatar" class="form__label">
                    Avatar
                </label>
                <div class="col-sm-6 col-sm-6-avatar">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="user_avatar" name="user_avatar" border-width>
                    </div>
                    <span class="text-danger font-weight-bold">
                        <?php
                        echo isset($error['avatar']) ? $error['avatar'] : '';
                        ?>
                    </span>
                    <?php
                    if (! isset($_SESSION['user_avatar'])){
                    ?>
                        <img  src=<?php echo $userInfo['avatar'];?> alt="Avatar">
                    <?php
                    }
                    else{
                        ?>
                        <img  src=<?php echo $_SESSION['user_avatar'];?> alt="Avatar">
                    <?php
                    }
                    ?>
                </div>

            </div>

            <div class="form-group row mt-4">
                <label class="col-sm-2" for="note">Mô tả thêm</label>
                <div class="col-sm-6">
                    <?php
                    if (isset($_SESSION['user_description'])){
                        $description = $_SESSION['user_description'];
                    }
                    else{
                        $description = $userInfo['description'];
                    }
                    ?>
                    <textarea class="form-control" id="description" rows="5" name="description" ><?php echo $description;?></textarea>
                    <span class="text-danger font-weight-bold">
                    <?php
                        echo isset($error['description']) ? $error['description'] : '';
                    ?>
                    </span>
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-lg pe-5 ps-5" name="edit_user_submit">Xác nhận</button>
            </div>
        </form>

    </div>

    <!-- Bootstrap -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
</body>

</html>