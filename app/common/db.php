<?php
class Connect
{
    protected $pdo = null;
    function __construct()
    {
        include_once('./app/common/define.php');
        try {
            $this->pdo = new PDO(DB_DNS, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
// include_once('./app/common/define.php');
// class Connect extends Database
// {
//     protected $pdo = null;
//     function __construct()
//     {
//         $db = new Database();
//         try {
//             $this->pdo = new PDO($db->get_dns(), $db->get_user(), $db->get_pass());
//             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (PDOException $e) {
//             echo $e->getMessage();
//             exit();
//         }
//     }
// }
?>