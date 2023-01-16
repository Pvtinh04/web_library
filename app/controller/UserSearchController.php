<?php
    class UserSearchController extends Controller
    {
        private $listType= [
            '1' => 'Sinh Viên',
            '2' => 'Giáo Viên',
            
        
        ];
        private $model;
        public function __construct(){
            $this->model = new UserModel(); 
            $page = $_GET['page'];
            switch ($page) {
				case 'user_search':
                    $search_users_result = $this->model->getAllUsers();
                    if (isset($_POST['submit_search_user'])) {
                        $search_type = isset($_POST['type']) ? $_POST['type'] : '';
                        $keyword = isset($_POST['keyword_search_user']) ? trim($_POST['keyword_search_user']) : '';
                        $search_users_result = $this->model->searchUser($search_type, $keyword);
                    }
                    if (isset($_GET['id'])){
                        
                        $this->model->delUser($_GET['id']);
                        header('Location:index.php?page=user_search');
                    }
                    $listType = $this->listType;
					include_once "./app/view/".$page.".php";
					break;
                case 'user_detail':
                    if (isset($_GET['id'])){
                        echo $_GET['id'];
                        $id = $_GET['id'];
                        $user = $this->model->getUserById($id);
                    }
                    include_once "./app/view/".$page.".php";
                    break;
            }
        }
    }
    


?>