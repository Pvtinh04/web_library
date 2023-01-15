<?php 
	class Controller extends Model
	{
		private $model;
		function __construct()
		{
			$this->model = new Model(); 
		}

		public function Controllers()
		{
			if (isset($_GET['page'])) {
				$page =$_GET['page'];
			} else {
				$page =  'home';
			} 
            switch ($page) {
                case "transaction":
                    require_once "app/controller/TransactionController.php";
                    new TransactionController();
                    break;
				case "home":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					include_once "./app/view/".$page.".php";
					break;
            	case 'login':
            		require_once "app/controller/LoginController.php";
					new LoginController();
					break;
				case "logout":
					unset($_SESSION['authen']);
					header('Location:index.php');
					break;
				case "reset_password":
					require_once "app/controller/ResetPasswordController.php";
					new ResetPasswordController();
					break;
				case "reset_password_form":
					require_once "app/controller/ResetPasswordController.php";
					new ResetPasswordController();
					break;
				case 'user_add_input':
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/AddUserController.php";
					new AddUserController();
					break;
				case 'user_add_confirm':
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/AddUserController.php";
					new AddUserController();
					break;
				case 'user_add_complete':
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/AddUserController.php";
					new AddUserController();
					break;
				case "user_search":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/UserSearchController.php";
					new UserSearchController();
					break;
				case "transaction":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/TransactionController.php";
					new TransactionController();
					break;
				case "ledger_return_book":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/LedgerBookController.php";
					new LedgerBookController();
					break;
				case "search_books":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/BookController.php";
					new BookController();
					break;
				case "book_detail":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/BookController.php";
					new BookController();
					break;
				case "book_edit_input_view":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/BookController.php";
					new BookController();
					break;
				case "book_edit_confirm_view":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/BookController.php";
					new BookController();
					break;
				case "book_edit_complete_view":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/BookController.php";
					new BookController();
					break;
				case "book_history":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/BookHistoryController.php";
					new BookHistoryController();
					break;
				case "user_history":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/UserHistoryController.php";
					new UserHistoryController();
					break;
				case "user_edit":
					require_once "app/controller/EditUserController.php";
					new EditUserController();
					break;
				case "user_edit_confirm":
					require_once "app/controller/EditUserController.php";
					new EditUserController();
					break;
				case "user_edit_complete":
					require_once "app/controller/EditUserController.php";
					new EditUserController();
				case "borrow_book_input":
					// if (!isset($_SESSION['authen']))  header('Location: index.php?page=login');
					require_once "app/controller/BorrowBookController.php";
					new BorrowBookController();
					break;
				}
				
		}
		/**
		 * View
		 */
		public function view(string $path, array $data = []): void
		{
			if (is_array($data)) {
				extract($data);
			}
			require(ROOT . '/app/views/' . $path . '.php');
		}
	}

?>