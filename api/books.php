<?php

require_once 'src/DBconfig.php';
require_once 'src/Book.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $arr = [];
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $book = new Book(); 
        $book ->loadFromDB($conn, $_GET['id']);
        $arr[] = $book;
        echo json_encode($arr);               
    } else {
        $all = new Book();
        echo json_encode($all->loadAllFromDB($conn));
    }
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['author']) && isset($_POST['name'])) {
        $book = new Book();
        $book -> create($conn, $_POST['name'], $_POST['author'], $_POST['description']);
        
    }
}   
}

