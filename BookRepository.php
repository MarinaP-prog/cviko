<?php
class BookRepository {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function getAllBooks()
    {
        $stmt = $this->pdo->query('SELECT * FROM books');
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row['id'], 
                $row['isbn'], 
                $row['firstname'],
                $row['lastname'], 
                $row['title'], 
                $row['book_description'], 
                $row['image_path'] 
            );
        }
        return $books;
    }
    
    
    public function searchBook($isbn, $firstname, $lastname, $title)
    {
        $sql = "SELECT * FROM books WHERE 1=1";
        $params = [];
    
        if (!empty($isbn)) {
            $sql .= " AND isbn = ?";
            $params[] = $isbn;
        }
        if (!empty($lastname)) {
            $sql .= " AND lastname LIKE ?";
            $params[] = "%$lastname%"; 
        }
        if (!empty($firstname)) {
            $sql .= " AND firstname LIKE ?";
            $params[] = "%$firstname%";
        }
        if (!empty($title)) {
            $sql .= " AND title LIKE ?";
            $params[] = "%$title%";
        }
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params); 
    
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row['isbn'], $row['firstname'], $row['lastname'], $row['title'], $row['book_description'], $row['image_path'], $row['id']);
        }
    
        return $books;
    }
    

    public function createBook(Book $book)
    {
        $stmt = $this->pdo->prepare("INSERT INTO books (isbn, firstname, lastname, title, book_description, image_path) VALUES (?,?,?,?,?,?)");
        return $stmt->execute([$book->isbn, $book->firstname, $book->lastname, $book->title, $book->book_description, $book->image_path]);
    }


    public function GetBookById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Book($row['isbn'], $row['firstname'], $row['lastname'], $row['title'], $row['book_description'], $row['image_path'], $row['id']) : null;
    }

   
}
?>
