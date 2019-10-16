<?php
function connect(){
    /* 
    No matter what error mode you set, 
    an error connecting will always produce an exception, 
    and creating a connection should always 
    be contained in a try/catch block.
    */
    try {
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=localhost;dbname=addressbook", "root", "");
        return $DBH;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
function editContact($first_name,$last_name,$phone,$email){
    # ability to insert objects directly into your database, assuming the properties match the named fields.
    
    # a simple object
    class person {
        public $first_name;
        public $last_name;
        public $phone;
        public $email;
     
        function __construct($fn,$ln,$p,$e) {
            $this->first_name = $fn;
            $this->last_name = $ln;
            $this->phone = $p;
            $this->email = $e;
        }
        # etc ...
    }
     
    $newPerson = new person($first_name,$last_name,$phone,$email);
     
    # here's the fun part:
    if(connect()) $DBH=connect();
    $STH = $DBH->prepare("update contacts set first_name=:first_name, last_name=:last_name, phone=:phone, email=:email where id=".$_POST['id']);
    $STH->execute((array)$newPerson);
}
editContact($_POST['first_name'],$_POST['last_name'],$_POST['phone'],$_POST['email']);
header('Location: index.php');
exit();