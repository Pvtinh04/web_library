<?php
    session_start();
    require '../model/bookPhpAdminClient.php';
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
    // if(isset($_POST['edit'])){
    //         $file="../../web/avatar/bookClient/$avatar";
    //         $newfile="../../web/avatar/$id/$avatar";
    //         copy($file, $newfile);
    //         if($avatar!==$avatarPast){
    //             unlink("../../web/avatar/bookClient/$avatar");
    //             unlink("../../web/avatar/$id/$avatarPast");
    //         }else{
    //             unlink("../../web/avatar/bookClient/$avatar");
    //         }
    //         edit_room($id ,$name, $category, $author, $quantity, $avatar,$description,$update);
    //         header("Location: ../view/book_edit_complete_view.php?accuracy='true'");
    // }
		if(isset($_POST['edit'])){
				// edit();
				editBook($id,$name,$category,$author,$quantity,$avatar,$description,$update);
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
?>