<?php if (!isset($_SESSION['authen']))  header('Location: index.php?page=login'); ?>

<div class="container search-book-page">
    <form class="search-book" method="post" action="">
        <div class="search-book-item">
            <label>Phân loại</label>
            <select name="type" id="type" class="type" ng-model="model.value">
                <option id="NULL" value=""></option>
                <?php
                foreach ($listType as $key => $value) {
                    
                    if (isset($search_type) && $search_type == $key) {
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
            <input id="search" type="text" class="input_search" value="<?php echo (isset($keyword) ? $keyword : ""); ?>" name="keyword_search_user" onchange='saveValue(this);'>
        </div>
        <div class="mb-3">
            <button name="submit_search_user" class="search_btn" type="submit">Tìm kiếm</button>
        </div>
    </form>
    <p class="mb-3">Số quyển sách tìm thấy: <?php
                                            echo count($search_users_result);
                                            ?></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Phân loại</th>
                <th scope="col">Mô tả chi tiết</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($search_users_result as $key => $value) {
                ?>
                <tr>
                    <th scope='row'> <?php  echo $key + 1 ?> </th> 
                    <td class=''><?php echo $value["user_id"] ?> </td>
                    <td class='w-25'><a style='color: black; text-decoration: none' href='index.php?page=user_detail&id=<?php echo $value["id"] ?>'> <?php echo $value["name"] ?></a></td>
                    <td class='' style='width: 10%'> <?php echo $listType[$value["type"]] ?> </td>
                    <td class='w-25'> <?php echo $value["description"] ?> </td>
                    <td style='width: 20%'>
                        <!-- <button type='button' class='btn delete-product' data-bs-toggle='modal' data-bs-target='#exampleModal' data-id='" . $value["id"] . "'>Xoá</button> -->
                        <a class='btn delete-product' href='javascript:deluser(<?php echo $value['id'] ?>,"<?php echo $value['name'] ?>")'>Xóa</a>
                        <a class='btn edit-product' href='index.php?page=user_edit&id=<?php echo $value['id'];?>'>Sửa</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>


<script>
    function deluser(id,name){
        var id = id;
        var name = name;
        var msg = confirm("Bạn chắn chắn muốn xóa user "+name +"?");

    if (msg) {
        window.location = "index.php?page=user_search&id="+id;
    }
    }
    </script>