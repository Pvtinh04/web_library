<?php
class Connect {
    protected $pdo = null;
		function __construct()
		{
            include_once('./app/common/define.php');
            try{
                $this->pdo = new PDO(DB_DNS, DB_USER,DB_PASSWORD);
                $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo $e->getMessage();
				exit();
            }
		}
    
}
?>