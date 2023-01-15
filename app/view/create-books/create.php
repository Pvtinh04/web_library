<section class="card mt-3 mb-3">
    <div class="card-header">
        <h2>Đăng ký sách</h2>
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="post-title">Tên sách</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $data['name'] ?? ''; ?>">
                <?php Errors::get('name', $errors)?>
            </div>
            <div class="form-group row">
                <label for="post-title">Thể loại</label>
                <select name="category" id="category" class="form-control">
                    <option value="Khoa học">Khoa học</option>
                    <option value="Tiểu thuyết">Tiểu thuyết</option>
                    <option value="Manga">Manga</option>
                    <option value="Sách giáo khoa">Sách giáo khoa</option>
                </select>
                <?php Errors::get('category', $errors)?>
            </div>

            <div class="form-group row">
                <label for="post-title">Tác giả</label>
                <input type="text" name="author" id="author" class="form-control" value="<?= $data['author'] ?? ''; ?>">
                <?php Errors::get('author', $errors)?>
            </div>
            <div class="form-group row">
                <label for="post-title">Số lượng</label>
                <input type="text" name="quantity" id="quantity" class="form-control" value="<?= $data['quantity'] ?? ''; ?>">
                <?php Errors::get('quantity', $errors)?>
            </div>

            <div class="form-group row">
                <label for="post-content">Mô tả chi tiết</label>
                <textarea name="description" id="description" class="form-control"><?= $data['description'] ?? ''; ?></textarea>
                <?php Errors::get('description', $errors)?>
            </div>

            <div class="input-group mb-3">
                <label for="post-content">Avatar</label>
                <div class="custom-avatar">
                    <input type="file" name="avatar" id="avatar" class="custom-file-input mx-sm-3">
                </div>
            </div>

            <button type="submit" name="book-confirm" class="btn btn-primary">Xác nhận</button>
        </form>
    </div>
</section>