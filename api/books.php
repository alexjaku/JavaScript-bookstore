<?php

require_once 'src/DBconfig.php';
require_once 'src/Book.php';

 // showing books or 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $arr = [];
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $book = new Book(); 
        echo json_encode($book ->loadFromDB($conn, $_GET['id']));               
    } else {
        $all = new Book();
        $allInfo = $all->loadAllFromDB($conn);
        if($allInfo !== null) {
            echo json_encode($allInfo);
        } else {
            echo json_encode('Brak książek lub zła baza');
        }
        
    }
}   
// saving a book from the FORM to DB    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['author'], $_POST['name'])) {
        $book = new Book();
        $result = $book -> create($conn, $_POST['name'], $_POST['author'], $_POST['description']);
        
        var_dump(json_encode($result));
        var_dump($result);
        
        if($result == null) {
            echo json_encode('Pusto!');
        } else if($result != false) {
            echo json_encode("Udało się!");                       
        }
    }
}   

// editing a book 
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents('php://input'), $put_vars); 
    $id = $put_vars['id']; 
    $author = $put_vars['author'];
    $description = $put_vars['description'];
    $book = new Book();
    $book ->loadFromDB($conn, $id);
    $name = $book -> getName(); 
    $result = $book ->update($conn, $name, $author, $description); 
    if ($result !== false) {
        echo json_encode('Zaaktualizowano!'); 
    } else {
        echo json_encode('Coś poszło nie tak! Sprawdź formularze!');
    }
}

// deleting a book 
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $del_vars);
    $book = new Book(); 
    $book ->loadFromDB($conn, $del_vars['id']);
    $result = $book ->deleteFromDB($conn, $del_vars['id']);
    if ($result == true) {
        echo json_encode('Usunięto!'); 
    } else {
        echo json_encode('Coś poszło nie tak!');
    }
}
