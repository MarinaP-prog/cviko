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
                $row['id'], // první je id
                $row['isbn'], // druhý je isbn
                $row['firstname'], // třetí je firstname
                $row['lastname'], // čtvrtý je lastname
                $row['title'], // pátý je title
                $row['book_description'], // šestý je book_description
                $row['image_path'] // sedmý je image_path
            );
        }
        return $books;
    }
    
    
    public function searchBook($isbn, $firstname, $lastname, $title)
    {
        $sql = "SELECT * FROM books WHERE 1=1"; // Začínáme s podmínkou, která vždy platí (1=1)
        $params = [];
    
        if (!empty($isbn)) {
            $sql .= " AND isbn = ?";
            $params[] = $isbn;
        }
        if (!empty($lastname)) {
            $sql .= " AND lastname LIKE ?";
            $params[] = "%$lastname%"; // Používáme LIKE pro částečné hledání
        }
        if (!empty($firstname)) {
            $sql .= " AND firstname LIKE ?";
            $params[] = "%$firstname%";
        }
        if (!empty($title)) {
            $sql .= " AND title LIKE ?";
            $params[] = "%$title%";
        }
    
        $stmt = $this->pdo->prepare($sql); // Připravíme dotaz s dynamickými parametry
        $stmt->execute($params); // Spustíme dotaz s parametry
    
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row['isbn'], $row['firstname'], $row['lastname'], $row['title'], $row['book_description'], $row['image_path'], $row['id']);
        }
    
        return $books; // Vracíme objekty místo asociativního pole
    }
    

    public function createBook(Book $book)
    {
        $stmt = $this->pdo->prepare("INSERT INTO books (isbn, firstname, lastname, title, book_description, image_path) VALUES (?,?,?,?,?,?)");
        return $stmt->execute([$book->isbn, $book->firstname, $book->lastname, $book->title, $book->book_description, $book->image_path]);
    }

//     public function createBook(Book $book, $file)
// {
//     // Ověření, zda byl nahrán soubor
//     if ($file['error'] !== UPLOAD_ERR_OK) {
//         throw new Exception("Chyba při nahrávání souboru.");
//     }

//     // Povolené formáty
//     $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
//     $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

//     if (!in_array($fileExtension, $allowedFormats)) {
//         throw new Exception("Nepodporovaný formát souboru. Povolené jsou: JPG, PNG, GIF.");
//     }

//     // Cesta pro uložení souboru
//     $uploadDir = "uploads/";
//     if (!is_dir($uploadDir)) {
//         mkdir($uploadDir, 0777, true); // Vytvoří složku, pokud neexistuje
//     }

//     // Generování unikátního názvu souboru
//     $uniqueFileName = uniqid("book_", true) . '.' . $fileExtension;
//     $uploadPath = $uploadDir . $uniqueFileName;

//     // Přesun souboru na server
//     if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
//         throw new Exception("Nepodařilo se uložit obrázek.");
//     }

//     // Uložení cesty k obrázku
//     $book->image_path = $uploadPath;

//     // Vložení do databáze
//     $stmt = $this->pdo->prepare("INSERT INTO books (isbn, firstname, lastname, title, book_description, image_path) VALUES (?, ?, ?, ?, ?, ?)");
//     return $stmt->execute([$book->isbn, $book->firstname, $book->lastname, $book->title, $book->book_description, $book->image_path]);
// }

    public function GetBookById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Book($row['isbn'], $row['firstname'], $row['lastname'], $row['title'], $row['book_description'], $row['image_path'], $row['id']) : null;
    }

   
}
?>