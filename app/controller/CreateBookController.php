<?php

class CreateBookController extends Controller
{
    private $book;

    public function __construct()
    {
        $this->book = new CreateBookModel();
    }

    public function create()
    {
        if (isset($_POST['book-confirm'])) {
            $dataBook = [
                'name' => $_POST['name'] ?? '',
                'category' => $_POST['category'] ?? '',
                'author' => $_POST['author'] ?? '',
                'quantity' => $_POST['quantity'] ?? '',
                'avatar' => $_POST['avatar'] ?? [],
                'description' => $_POST['description'] ?? ''
            ];
            try {
                $errors = $this->validate($dataBook);
                if ($errors) {
                    throw new ValidationException($errors);
                }
                $_SESSION['book'] = $dataBook;
                Site::redirect( 'app/view/create-books/confirm.php');
            } catch (ValidationException $e) {
                $errors = $e->getError();
            }
        }
        $data = [
            'title' => 'Đăng ký sách',
            'data' => $dataBook ?? [],
            'errors' => $errors ?? [],
        ];

        $this->view('create-books/create', $data);
    }

    public function confirm()
    {
        $book = $_SESSION['book'] ?? [];
        $dataBook = [
            'name' => $book['name'] ?? '',
            'category' => $book['category'] ?? '',
            'author' => $book['author'] ?? '',
            'quantity' => $book['quantity'] ?? '',
            'avatar' => $book['avatar'] ?? [],
            'description' => $book['description'] ?? ''
        ];
        if (isset($_POST['book-create'])) {
            $this->book->create($dataBook);
            Site::redirect( 'app/view/home.php');
        }
        $data = [
            'title' => 'Đăng ký sách',
            'data' => $dataBook ?? [],
        ];

        if (isset($_POST['book-back'])) {
            Site::redirect( 'app/view/books/create.php');
        }
        $this->view('create-books/confirm', $data);
    }


    /**
     */
    private function validate(array $data): array
    {
        $errors = Str::validate(
            $data['name'],
            'name',
            [
                'required' => 'Hãy nhập tên giáo viên',
                'length' => 'Không nhập quá 100 ký tự'
            ],
            true,
            100
        );
        $errors = Str::validate(
            $data['category'],
            'category',
            ['required' => 'Hãy chọn thể loại'],
            true,
            0,
            $errors
        );
        $errors = Str::validate(
            $data['author'],
            'author',
            [
                'required' => 'Hãy nhập tên tác giả',
                'length' => 'Không nhập quá 250 ký tự'
            ],
            true,
            255,
            $errors
        );
        $errors = Str::validate(
            $data['quantity'],
            'quantity',
            [
                'required' => 'Hãy nhập số lượng',
                'length' => 'Hãy nhập số lượng ít hơn hoặc bằng 2 chữ số'
            ],
            true,
            2,
            $errors
        );
        $errors = Str::validate(
            $data['description'],
            'description',
            [
                'required' => 'Hãy nhập mô tả chi tiết',
                'length' => 'Không nhập quá 1000 ký tự'
            ],
            true,
            1000,
            $errors
        );
        return File::validate(
            $data['avatar'],
            'Hãy chọn avatar',
            ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'],
            $errors
        );
    }
}