<?php

require_once 'src/DBconfig.php';
require_once 'src/Book.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $arr = [];
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $book = new Book(); 
        echo json_encode($book ->loadFromDB($conn, $_GET['id']));               
    } else {
        $all = new Book();
        echo json_encode($all->loadAllFromDB($conn));
    }
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['author'], $_POST['name'])) {
        $book = new Book();
        $result = $book -> create($conn, $_POST['name'], $_POST['author'], $_POST['description']);
        
        var_dump(json_encode($result));
        var_dump($result);
        
        if($result == null) {
            echo json_encode("Pusto!");
        } else if($result != false) {
            echo json_encode("Udało się!");                       
        }
    }
}   
}

