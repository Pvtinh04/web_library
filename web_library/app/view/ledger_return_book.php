<?php if (!isset($_GET['page'])) header('location:../../index.php?page=ledger_return_book'); ?>
<div class="container-ledger_return_book">
  <form action="" method="POST" id="form" enctype="multipart/form-data">
    <div class="search">
      <div class="search-child">
        <label class="search-child-label">Tên sách</label>
        <div class="search-child-select">
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
      <div class="search-child">
        <label class="search-child-label">Người dùng</label>
        <div class="search-child-select">
          <select class="hello" id="userId" name="userId">
            <option value=""></option>
            <?php
            for ($i = 0; $i < count($users); $i++) {
              if ($users[$i]['id'] === $_SESSION['userId']) {
                echo '<option value="' . $users[$i]['id'] . '" selected="selected">' . $users[$i]['name'] . '</option>';
              } else {
                echo '<option value="' . $users[$i]['id'] . '">' . $users[$i]['name'] . '</option>';
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
          echo "
            <div class='list-item-action'>
              <a style='color: #cfdded;' onClick='return confirm(\"Bạn có muốn trả sách $books_name \")' type='button' href='index.php?page=ledger_return_book&id=$i' class='btn-give-book-back'>Trả</a>
            </div>
          </div>
            ";
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