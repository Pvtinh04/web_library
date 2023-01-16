<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

<div class="wrapper">
    <div class="form-group form-group-1">
        <div class="form-label">Tên sách</div>
        <p class="info-book">
            <?php echo $book[0]["name"]  ?>
        </p>
    </div>
    <div class="form-group">
        <div class="form-label">Thể loại</div>
        <p class="info-book"><?php echo $book[0]["category"] ?></p>
    </div>
    <div class="form-group ">
        <div class="form-label">Tác giả</div>
        <p class="info-book"><?php echo $book[0]["author"] ?></p>
    </div>
    <div class="form-group">
        <div class="form-label">Số lượng</div>
        <p class="info-book"><?php echo $book[0]["quantity"] ?></p>
    </div>

    <div class="form-group">
        <div class="form-label">Mô tả chi tiết</div>
        <p class="info-book"><?php echo $book[0]["description"] ?></p>
    </div>

    <div class="form-group">
        <div class="form-label">Avatar</div>
        <img src="<?php echo $book[0]["avatar"] ?>" class="info-book" />
    </div>
    <div class="btn-signup">
        <a class="btn edit-book-btn" type="submit" href='index.php?page=edit_book&book_id=<?php echo $book[0]["id"] ?>' name="signup">Sửa</a>
    </div>