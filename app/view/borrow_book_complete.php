<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

    <div class="container" style="height: 100px; width: 550px; margin: 155px auto; border: 3px solid #5b9bd5;display: flex; justify-content:center; flex-direction: column; align-items: center;">
        <div style="display: flex; width: 450px; justify-content: space-around; margin: 10px auto">
            
            <label style=" align-items: center; font-size: 16px">Mượn sách thành công</label>
        </div>

        <div style="display: flex; width: 450px; justify-content: space-around; margin: 10px auto">
            <label style="  align-items: center; font-size: 16px">
        <a href="index.php?page=home">Quay lại trang chủ</a>
        </label>
        </div>

    </div>
