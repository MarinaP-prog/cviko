<?php

class Book
{
    //properties
    public $id;
    public $isbn;
    public $firstname;
    public $lastname;
    public $title;
    public $book_description;
    public $image_path;

    //konstruktor
    public function __construct($id, $isbn, $firstname, $lastname, $title,  $book_description, $image_path)
    {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->title = $title;
        $this->book_description = $book_description;
        $this->image_path = $image_path;
    }
}
