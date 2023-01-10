<?php
ob_start();
session_start();
// session_destroy();
include_once 'app/common/db.php';
include_once 'app/common/define.php';
include_once 'app/model/model.php';

?>

<?php

if (isset($_GET['type']) && $_GET['type'] === 'json') {

    include_once 'app/controller/controller.php';

    $controll = new Controller();
    $controll->Controllers();

} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <!-- Bootstrap DatePicker -->
        <link rel="stylesheet" href="./web/css/style_login.css" type="text/css" />
        <link rel="stylesheet" href="./web/css/ledger_return_book.css" type="text/css" />

        <!-- Bootstrap DatePicker -->

        <title>Web Library</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap");
        </style>
    </head>

    <?php
    $page = "home";
    if (file_exists('app/view/' . $page . '.php')) {
        ?>

        <body>
        <?php

        include_once 'app/controller/controller.php';

        $controll = new Controller();
        $controll->Controllers();
        ?>
        </body>
        <?php
    } else {
        echo "<h2 style='' class='err404'>Trang không tồn tại!</h2>";
    }
    ?>

    </html>
<?php

}

?>



