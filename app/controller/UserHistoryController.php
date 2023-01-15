<?php
require_once "app/model/BookModel.php";
    class UserHistoryController extends Controller
    {
        
        private $model;
        public function __construct(){
            $this->model = new BookModel(); 
            $page = $_GET['page'];
            switch ($page) {
                case 'user_history':
                    $result = [];
                    $araryParagraph = [];
                    $list_book = $this->model->deBook();
                    if($_SERVER['REQUEST_METHOD'] == "GET"){

                    if (isset($_GET["search"])) {
                            if(isset($_GET['user_id'])){
                                $user_id = $_GET['user_id'];
                            }
                            if(isset($_GET['book_id'])){
                                $book_id = $_GET['book_id'];
                            }
                            $result = $this->model->history_transaction($user_id, $book_id);
                    }
                            if(isset($_GET["reset"])){
                                $_GET['user_id']="";
                                $_GET['book_id']="";
                            }
                }

                function formatDate($date)
                {
                    $date = date('Y-m-d h:i:s', strtotime($date));
                    $new_date = date('h:i d/m/Y', strtotime($date));
                    return $new_date;
                }
                    include_once "./app/view/" . $page . ".php";
                    break;
				case 'book_detail':
					if (!isset($_GET["book_id"])) {
                        header('location:index.php?page=search_books');
                    } else {
                        $book = $this->model->getBook($_GET["book_id"]);
                        var_dump($book);
                    }
                    include_once "./app/view/" . $page . ".php";
                    break;
				case 'book_edit_complete_view':
                    include_once "./app/view/" . $page . ".php";
                    break;

                case 'book_edit_confirm_view':
                        $id=$_SESSION['id'];
                        $name = $_SESSION['name'];
                        $category = $_SESSION['category'];
                        $author = $_SESSION['author'];
                        $quantity = $_SESSION['quantity'];
                        $description = $_SESSION['description'];
                        $avatar =  $_SESSION['avatar'];
                        $avatarPast=$_SESSION['avatarPast'];
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $update = date("Y-m-d h:i:s");
                            if(isset($_POST['edit'])){
                                    $this->model->editBook($id,$name,$category,$author,$quantity,$avatar,$description,$update);
                                    mkdir("../../web/avatar/$id", 0777);
                                    deleteImgTmp($avatar,$id,$avatarPast);
                                    router();
                                
                        }
                        
                        function router(){
                                $status='true';
                                header("Location: ../view/book_edit_complete_view.php?accuracy='true'");
                        }
                        function deleteImgTmp($avatarT,$id,$avatarPast){
                                $file="../../web/avatar/bookClient/$avatarT";
                                $newfile="../../web/avatar/$id/$avatarT";
                                copy($file, $newfile);
                                if($avatarT!==$avatarPast){
                                        unlink("../../web/avatar/bookClient/$avatarT");
                                        // unlink("../../web/avatar/$id/$avatarPast");
                                }else{
                                        unlink("../../web/avatar/bookClient/$avatarT");
                                }
                        } 
                            include_once "./app/view/" . $page . ".php";
                            break;
                case 'book_edit_input_view':
                    $listCate = $this->listCategory;
                    $nameErr = $categoryErr = $authorErr = $quantityErr = $avatarErr=$descriptionErr="";
                    
                    $name = $category = $author = $quantity= $avatarCorrect = $description = "";
                    
                    $id=$_GET["id"];
                    $result=$this->model->get_room($id);
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
                                    $_SESSION['id']=$id;
                                    $_SESSION["avatarPast"]=$avatarPast; 
                                    $_SESSION["name"]=$name;
                                    $_SESSION["description"]=$description;
                                    $_SESSION["avatar"]=$avatarCorrect;
                                    $_SESSION["author"]=$author;
                                    $_SESSION["category"]=$category;
                                    $_SESSION["quantity"]=$quantity;     
                                    echo "<script>location.href = 'index.php?page=book_edit_confirm_view';</script>";
                                    exit();

                                }
                            }
                    include_once "./app/view/" . $page . ".php";
                    break;
            }
        }
    }
    


?>