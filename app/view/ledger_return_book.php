<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>
<div class="container-ledger_return_book">
  <form action="" method="POST" id="form" enctype="multipart/form-data">
    <div class="search">
      <div class="search-child">
        <label class="search-child-label">Tên sách</label>
        <div class="search-child-select">
          <select class="hello" id="bookId" name="bookId">
            <option value=""></option>
            <?php
            
            foreach ($books as $key => $book) {
              if ($book->id === $_SESSION['bookId']) {
                echo '<option value="' . $book->id . '" selected="selected">' . $book->name . '</option>';
              } else {
                echo '<option value="' .$book->id . '">' . $book->name . '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="search-child">
        <label class="search-child-label">Người dùng</label>
        <div class="search-child-select">
          <select class="hello" id="userId" name="userId">
            <option value=""></option>
            <?php
            foreach ($users as $key => $user) {
              if ($user->id  === $_SESSION['userId']) {
                echo '<option value="' . $user->id  . '" selected="selected">' . $user->name  . '</option>';
              } else {
                echo '<option value="' . $user->id . '">' . $user->name . '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="btn-search">
      <input type="submit" class="btn-search--reset" name="btn-search--reset" value="Reset" />
      <input type="submit" class="btn-search--search" name="btn-search--search" value="Tìm kiếm" />
    </div>
    <div class="search-result">
      <p>Số bản ghi tìm thấy: <?php echo count($data) ?></p>
    </div>
    <div class="list-header">
      <div class="list-item">
        <p class="stt">NO</p>
        <p class="book-name">Tên sách</p>
        <p class="user-name">Người dùng</p>
        <p class="loan-status">Tình trạng mượn</p>
      </div>
      <div class="list-item-action">
        <p>Action</p>
      </div>
    </div>
    <div class="list">
      <?php
      // var_dump($data);
      for ($i = 0; $i < count($data); $i++) {
        $status = '';
        $books_name =  $data[$i]['books_name'];
        if ($data[$i]['return_actual_date'] == null && new DateTime() <= new DateTime($data[$i]['return_plan_date'])) {
          $status = "Đang mượn";
        } else if ($data[$i]['return_actual_date'] == null && new DateTime() > new DateTime($data[$i]['return_plan_date'])) {
          $status = "Quá hạn";
        } else if ($data[$i]['return_actual_date'] != null) {
          $status = "Đã trả";
        }
        echo '
          <div class="list-header">
            <div class="list-item">
              <p class="stt">' . ($i + 1) . '</p>
              <p class="book-name">' . $data[$i]['books_name'] . '</p>
              <p class="user-name">' . $data[$i]['users_name'] . '</p>
              <p class="loan-status">' . $status . '</p>
            </div> ';
        if ($status != "Đã trả") {
         ?>
            <div class='list-item-action'>
              <a style='color: #cfdded;' class='btn btn-info' href='javascript:planactual(<?php echo $data[$i]['id'] ?>,"<?php echo $books_name ?>")'>Trả</a>
            </div>
          </div>
            <?php 
        } else {
          echo "
            <div class='list-item-action'>
              <a class='btn-give-book-back' style='display: none'></a>
            </div>
          </div>
            ";
        }
      }
      ?>
    </div>
    <!-- <button class="btn-give-book-back" name="btn-give-book-back' . ($i + 1) . '">Trả</button> -->
  </form>
</div>
<script>
    function planactual(id,name){
        var id = id;
        var name = name;
        var msg = confirm("Bạn chắn chắn muốn xóa user "+name +"?");

    if (msg) {
        window.location = "index.php?page=ledger_return_book&id="+id;
    }
    }
    </script>