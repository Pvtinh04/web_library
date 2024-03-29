<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

<div class="container search-book-page">
    <form class="search-book" method="post" action="">
        <div class="search-book-item">
            <label>Thể loại</label>
            <select name="khoa" id="khoa" class="khoa" ng-model="model.value">
                <option id="NULL" value=""></option>
                <?php
                foreach ($listCate as $key => $value) {
                    if (isset($search_cate) && $search_cate == $key) {
                        $select = "selected";
                    }else{
                        $select = "";
                    }
                    echo "<option id='$key' value='" . $key . "'" . $select . ">" . $value . "</option>";
                };
                ?>
            </select>
        </div>
        <div class="search-book-item">
            <label>Từ khóa</label>
            <input id="search" type="text" class="input_search" value="<?php echo (isset($keyword) ? $keyword : ""); ?>" name="keyword_search_book" onchange='saveValue(this);'>
        </div>
        <div class="mb-3">
            <button name="submit_search" class="search_btn" type="submit">Tìm kiếm</button>
        </div>
    </form>
    <p class="mb-3">Số quyển sách tìm thấy: <?php
                                            echo count($search_books_result);
                                            ?></p>
    <p class="delete-success"><?php if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            $_SESSION['success'] = "";
        } ?></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tên sách</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thể loại</th>
                <th scope="col">Mô tả chi tiết</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($search_books_result as $key => $value) {
                $html = "";
                if ($this->model->checkBookInTransaction($value["id"])) {
                    $html = "<button type='button' class='btn delete-product' data-bs-toggle='modal' data-bs-target='#errorModal' data-id='" . $value["id"] . "'>Xoá</button>
                    <button type='button' class='btn delete-product' data-bs-toggle='modal' data-bs-target='#errorModal' data-id='" . $value["id"] . "'>Sửa</button>";
                } else {
                    $html = "<button type='button' class='btn delete-product' data-bs-toggle='modal' data-bs-target='#exampleModal' data-id='" . $value["id"] . "'>Xoá</button>
                    <a class='btn edit-product' href='index.php?page=book_edit_input_view&id=" . $value["id"] . "'>Sửa</a>";
                }

                echo ("
                <tr>
                    <th scope='row'>" . $key + 1 . "</th> 
                    <td class='w-25'><a style='color: black; text-decoration: none' href='index.php?page=book_detail&book_id=" . $value["id"] . "'>" . $value["name"] . "</a></td>
                    <td class=''>" . $value["quantity"] . "</td>
                    <td class='' style='width: 10%'>" . $listCate[$value["category"]] . "</td>
                    <td class='w-25'>" . $value["description"] . "</td>
                    <td style='width: 20%'>" . $html . "</td>
                </tr>
                ");
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xoá book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xoá ko?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a type="button" class="btn btn-primary delete-book-confirm">Xoá</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 18px; text-align: center">
                Loại sách này đang được cho mượn. Không thể chỉnh sửa.
            </div>
        </div>
    </div>
</div>

<script>
    $('.delete-product').on('click', function(e) {
        var id = $(this).attr('data-id');
        $('.delete-book-confirm').attr('data-id', id);
    });
    $(".delete-book-confirm").on('click', function(e) {
        var id = $(this).attr('data-id');
        location.href = "./index.php?page=book_delete&book_id=" + id;
    });
</script>