<?php
    session_start();
    // $nameErr = $buildingErr = $descriptionErr = $avatarErr = "";
		$nameErr = $categoryErr = $authorErr = $quantityErr = $avatarErr=$descriptionErr="";
    // $name = $building = $description = $avatarCorrect = "";
		$name = $category = $author = $quantity= $avatarCorrect = $description = "";
        require '../model/bookPhpAdminClient.php';
        $id=$_GET["id"];
				// $id='1';
        $result=get_room($id);
        foreach ($result as $item) {
        $namePast=$item["name"];
        $descriptionPast=$item["description"];
        $avatarPast=$item["avatar"];
        $authorPast=$item["author"];
				$categoryPast=$item["category"];
				$quantityPast=$item["quantity"];
        }
        $_SESSION['avatarCorrect']=" ";   
    if (isset($_POST['btn-accept'])) {
        if (empty($_POST["name"]) ) {
            $nameErr = "Hãy nhập tên Sách *";
        }else if(preg_replace('/\s+/', ' ', $_POST["name"])===" "){
            $nameErr = "Sách không được chỉ có khoảng trắng  *";
        } else if(strlen($_POST["name"])>100){
            $nameErr = "Tên Sách bé hơn 100 ký tự *";
        }else {
            $name = ($_POST["name"]);
        }
          
        if($_POST["category"] == "none") {
            $categoryErr = "Hãy chọn thể loại *";
        } else {
            $category = ($_POST["category"]);
        }
				if($_POST["author"] == "none") {
					$authorErr = "Hãy chọn tác giả *";
				} else {
						$author = ($_POST["author"]);
				}
				if (empty($_POST["quantity"]) ) {
					$quantityErr = "Hãy nhập số lượng*";
				} else {
					if((int)($_POST["quantity"]) < 10){
						$quantityErr ="Hãy nhập số lượng ít hơn hoặc bằng 2 chữ số";
					}else{
						$quantity = ($_POST["quantity"]);
					}
				}
        if (empty($_POST["description"])) {
            $descriptionErr = "Hãy nhập mô tả *";
        }else if(preg_replace('/\s+/', ' ', $_POST["description"])===" "){
            $descriptionErr = "Mô tả không được chỉ có  khoảng trắng *";
        }else if(strlen($_POST["description"])>1000){
            $descriptionErr = "Mô tả chi tiết bé hơn 1000 ký tự *";
        } else {
            $description = ($_POST["description"]);
        }
        if($avatarPast == $_POST["upload"]){
						$avatarCorrect = $avatarPast;
						// move_uploaded_file($_FILES['upload']['tmp_name'], "../../web/avatar/bookClient/$avatarCorrect");
				}else{
					if (empty($_FILES['upload']['name'])) {
							$avatarErr = "Hãy chọn avatar*";
					} elseif (!preg_match("/\.(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$/",$_FILES['upload']['name'])){
							$avatarErr = "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF *";
					}
					else if (file_exists($_FILES['upload']['name'])){
							$avatarErr = "Tên file đã tồn tại, không được ghi đè *";
					}else {
							$avatarCorrect =  $_FILES['upload']['name'];
							move_uploaded_file($_FILES['upload']['tmp_name'], "../../web/avatar/bookClient/$avatarCorrect");
					}
				}
       
        if($name !="" && $author !="" && $category !="" && $description !="" && $avatarCorrect !="" && $quantity !==""){
            $name=preg_replace('/\s+/', ' ', $name);
            $description=preg_replace('/\s+/', ' ', $description);
            // session_start();
                  
            header("Location: ../view/book_edit_confirm_view.php");
						$_SESSION['id']=$id;
						$_SESSION["avatarPast"]=$avatarPast; 
						$_SESSION["name"]=$name;
						$_SESSION["description"]=$description;
						$_SESSION["avatar"]=$avatarCorrect;
						$_SESSION["author"]=$author;
						$_SESSION["category"]=$category;
						$_SESSION["quantity"]=$quantity;     

        }
    }
?>