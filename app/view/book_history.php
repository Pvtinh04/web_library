<?php if (!isset($_GET['page'])) header('location:../../index.php?page=book_history'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./web/css/style_book_history.css">
</head>

<body>

    <div class="main">
        <form action="" method="POST" id="form" enctype="multipart/form-data">
            <div class="wrapper">
                <div class="search-">
                    <div class="form-group">
                        <label class="form-label">Tên sách</label>
                        <div class="form-input">
                            <select class="hello" id="bookId" name="bookId">
                                <option value=""></option>
                                <?php
                                for ($i = 0; $i < count($books); $i++) {
                                    if ($books[$i]['id'] === $_SESSION['bookId']) {
                                        echo '<option value="' . $books[$i]['id'] . '" selected="selected">' . $books[$i]['name'] . '</option>';
                                    } else {
                                        echo '<option value="' . $books[$i]['id'] . '">' . $books[$i]['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Người dùng</label>
                        <div class="form-input">
                            <select class="hello" id="userId" name="userId">
                                <option value=""></option>
                                <?php
                                foreach ($users as $user) {
                                    echo '<option value="' . $user["id"] . '">' . $user["name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between flex-row">

                        <button class="btn btn-primary" type="submit" id="delete">Reset</button>
                        <button class="btn btn-primary" type="submit" name="search--">Tìm kiếm</button>
                    </div>
                </div>
            </div>
            <div class="count">
                <div class="student-found">
                    <p>Số bản ghi tìm thấy: <?php echo count($data) ?></p>
                </div>
            </div>
            <div class="list" style="
    display: grid;">
                <table class="student-table table">
                    <tr class="header">
                        <th scope="col">No.</th>
                        <th scope="col">Tên sách</th>
                        <th scope="col">Số lần mượn</th>
                        <th scope="col">Thời gian dự kiến muộn</th>
                        <th scope="col">Thời gian trả kiến muộn</th>
                        <th scope="col">Thời điểm trả</th>
                        <th scope="col">Người mượn</th>
                    </tr>
                    <?php

                    for ($i = 0; $i < count($data); $i++) {
                        $books_name =  $data[$i]['books_name'];
                        // for ($j = $i; $j < count($data); $j++) {
                        //     if($books_name ==  $data[$j]['books_name']){

                        //     }
                        // }
                        // foreach($data as $item){
                        echo '
                            <tr >
                            <td scope="col">' . ($i + 1) . '</td>
                            <td scope="col">' . $data[$i]['books_name'] . '</td>
                            <td scope="col">'. $data[$i]['times'] .'</td>
                            <td scope="col">'. $data[$i]['borrowed_date'] . '</td>
                            <td scope="col">'. $data[$i]['return_plan_date'] . '</td>
                            <td scope="col">' . $data[$i]['return_actual_date'] . '</td>
                            <td scope="col">' . $data[$i]['username'] . '</td>
                            </tr> 
                        ';
                    }
                    ?>
                </table>
            </div>

        </form>
    </div>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <!-- Bootstrap DatePicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap DatePicker -->
    <script type="text/javascript">
        $(function() {
            $('#txtDate').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>

</body>

</html>