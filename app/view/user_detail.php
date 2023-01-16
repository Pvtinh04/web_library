<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <title>Thông tin người dùng</title>
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
    label{

    }
</style>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Thông tin người dùng</h1>
        <?php var_dump($user); ?>
        <form class="containers">
            <div class="form-group row mt-4">
                <label   class="col-sm-2" for="name">Họ và tên</label>
                <div class="col-sm-6">
                   <span><?php if(isset($user["name"])) echo $user["name"];  ?></span>
                    <span class="text-danger font-weight-bold">
                    
                    </span>
                </div>
            </div>
            <div class="form-group row mt-4">
                <label  class="col-sm-2" for="classify">Phân loại</label>
                <div class="col-sm-6">
                <span><?php if(isset($user["type"])) {
                    if ($user["type"] == 2) {
                       echo "Giáo viên";
                } else {
                    echo "Sinh viên";
                }
              }  ?></span>
                    
                </div>
            </div>
            <div class="form-group row mt-4">
                <label class="col-sm-2" for="name">ID</label>
                <div class="col-sm-6">
                <span><?php if(isset($user["user_id"])) echo $user["user_id"];  ?></span>

                </div>
            </div>

            <div class="form-group row mt-4">
                <label class="col-sm-2" for="user_avatar" class="form__label">
                    Avatar
                </label>
                <div class="col-sm-6 col-sm-6-avatar">
                    <div class="input-group mb-3">
                    </div>
                    
                    <?php
                    if (isset($user["avatar"])){
                        $user['avatar'];
                    ?>
                        <img  src=<?php echo $user['avatar'];?> alt="Avatar">
                    <?php
                    }
                    
                        ?>
                        
                    
                </div>

            </div>

            <div class="form-group row mt-4">
                <label class="col-sm-2" for="note">Mô tả thêm</label>
                <div class="col-sm-6">
                <span><?php if(isset($user["description"])) echo $user["description"];  ?></span>

                </div>
            </div>
            </form>
            <div class="mt-5 d-flex justify-content-center">
                <a href="index.php?page=user_search">
                <button   class="btn btn-primary btn-lg pe-5 ps-5" name="">Quay lại</button>
                </a>
            </div>
        
    </div>

    <!-- Bootstrap -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
</body>

</html>