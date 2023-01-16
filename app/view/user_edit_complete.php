<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

    <div style="display: flex; width: 450px; justify-content: space-around; margin: 10px auto">
        
        <label style=" align-items: center; font-size: 16px">Bạn đã sửa thành công</label>
    </div>

    <div style="display: flex; width: 450px; justify-content: space-around; margin: 10px auto">
        <label style="  align-items: center; font-size: 16px">
    <a href="index.php?page=home">Quay lại danh sách</a>
    </label>
    </div>

</div>
