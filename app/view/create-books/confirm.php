<section class="card mt-3 mb-3">
    <div class="card-body">
        <h1 class="card-title">Đăng ký sách</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="post-title">Tên sách</label>
                <label name="name" id="name" class="form-control"><?= $data['name'] ?? ''; ?></label>
            </div>
            <div class="form-group row">
                <label for="post-title">Thể loại</label>
                <label name="category" id="category" class="form-control"><?= $data['category'] ?? ''; ?></label>
            </div>

            <div class="form-group row">
                <label for="post-title">Tác giả</label>
                <label name="author" id="author" class="form-control"><?= $data['author'] ?? ''; ?></label>
            </div>
            <div class="form-group row">
                <label for="post-title">Số lượng</label>
                <label name="quantity" id="quantity" class="form-control"><?= $data['quantity'] ?? ''; ?></label>
            </div>

            <div class="form-group row">
                <label for="post-content">Mô tả chi tiết</label>
                <label name="description" id="description" class="form-control"><?= $data['description'] ?? ''; ?></label>
            </div>

            <div class="input-group mb-3">
                <label for="post-content">Avatar</label>
                <div class="custom-avatar">
                    <input type="file" name="avatar" id="avatar" class="custom-file-input mx-sm-3">
                </div>
            </div>

            <button type="submit" name="book-create" class="btn btn-primary">Đăng ký</button>
            <button type="submit" name="book-back" class="btn btn-primary">Sửa lại</button>
        </form>
    </div>
</section>