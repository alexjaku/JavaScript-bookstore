<?php

require_once 'DBconfig.php';

class Book implements JsonSerializable {
    private $id; 
    private $name; 
    private $author;
    private $description;
    
    public function jsonSerialize() {
        return [
            'name' => $this->name,
            'author' => $this->author,
            'id' => $this->id,
            'description' => $this->description
        ];
    }
    
    function __construct() {
        $this -> id = -1;
        $this -> author = '';
        $this -> name = '';
        $this -> description ='';
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getAuthor() {
        return $this->author;
    }

    function getDescription() {
        return $this->description;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    # load a book 
    function loadFromDB($conn, $id) {
        $sql = 'SELECT * FROM `Book` WHERE `id` = :id';
        try {
            $query = $conn -> prepare($sql); 
            $query -> execute (['id' => $id]); 
            // $book will be a row from the DB table, $this will be an array
            $book = $query -> fetch();   
        } catch (Exception $ex) {
            echo $ex ->getMessage();
        }
       
        $this -> $id = ($book['id']);
        $this -> setName($book['name']);
        $this -> setDescription($book['description']);
        $this -> setAuthor($book['author']);
        
        return $this;
    }
    # load all books 
    function loadAllFromDB($conn) {
        $sql = 'SELECT * FROM `Book` ';
        try {
            $query = $conn -> prepare($sql); 
            $query -> execute (); 
            
            $books = $query -> fetchAll();   
        } catch (Exception $ex) {
            echo $ex ->getMessage();
        }
        
        $booksArray = [];
        foreach ($books as $book) {
            $loadedBook = new Book();
            $loadedBook -> id = $book['id'];
            $loadedBook -> setName($book['name']);
            $loadedBook -> setDescription($book['description']);
            $loadedBook -> setAuthor($book['author']);
            
            $booksArray[] = $loadedBook; 
        }        
        
        return $booksArray;
    }
    
    # add a new book
    function create($conn, $name, $author, $description) {
        if ($this ->getId() == -1 && !empty($name) && !empty($author)) {
            $sql = 'INSERT INTO `Book`(`name`, `author`, `description`)'
                    . ' Values (:name, :author, :description)';
            $sqlParams = [
                            'name' => $name,
                            'author' => $author,
                            'description' => $description,
                        ];
            
            try {
                $query = $conn -> prepare($sql);
                $result = $query -> execute($sqlParams);
                $this -> setId($conn -> lastInsertId());
                return $result; 
            } catch (Exception $ex) {
                echo $ex ->getMessage();
                return false;
            }  
        }
    }
    
    # update a book
    function update($conn, $name, $author, $description) {
        if ($this ->getId() == -1 && !empty($name) && !empty($author)) {
            $sql = 'UPDATE `Book` SET  '
                    . '`name` = :name, '
                    . '`author` = :author, '
                    . '`description` = :description;'
                    . 'WHERE `id` = :id';
            $sqlParams = [
                            'name' => $name,
                            'author' => $author,
                            'description' => $description,
                            'id' => $this ->getId()
                        ];

            try {
                $query = $conn -> prepare($sql);
                $query -> execute($sqlParams);
                
                return $this; 
            } catch (Exception $ex) {
                echo $ex ->getMessage();
            }  
        }
    }
    
    # delete a book
    function deleteFromDB($conn) {
        $sql = 'DELETE FROM `Book` WHERE `id` = :id;';
        $sqlParams = ['id' => ($this ->getId())];
        
        try {
            $query = $conn -> prepare($sql);
            $query -> execute($sqlParams);
        } catch (Exception $ex) {
            echo $ex ->getMessage();
        }
    }
    
}
