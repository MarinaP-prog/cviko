<?php
include 'map.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $isbn = $_POST['isbn'] ?? '';
   $firstname = $_POST['firstname'] ?? '';
   $lastname = $_POST['lastname'] ?? '';
   $title = $_POST['title'] ?? '';
   $book_description = $_POST['book_description'] ?? '';
   $image_path = $_POST['image_path'] ?? '';

   $repo = new BookRepository();
   $book = new Book($id, $isbn, $firstname, $lastname,$title, $book_description,  $image_path);
   $repo->createBook($book);
   header('Location: index.php');
   exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Knihy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Seznam knih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="filter.php">Vyhledej knihu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="add.php">Přidej knihu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
    <h1 class="display-5">Přidej knihu</h1>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <div class="mb-2">
            <label for="isbn" class="form-label">ISBN</label>
            <input class="form-control" type="text" name="isbn" id="isbn" value="" required>
        </div>
        <div class="mb-2">
            <label for="firstname" class="form-label">Jmeno autora</label>
            <input class="form-control" type="text" name="firstname" id="firstname" value="" required>
        </div>
        <div class="mb-2">
            <label for="lastname" class="form-label">Prijmeni autora</label>
            <input class="form-control" type="text" name="lastname" id="lastname" value="" required>
        </div>
        <div class="mb-2">
            <label for="title" class="form-label">Nazev knihy</label>
            <input class="form-control" type="text" name="title" id="title" value="" required>
        </div>
        <div class="mb-2">
            <label for="book_description" class="form-label">Popis</label>
            <textarea class="form-control" name="book_description" id="book_description" required></textarea>
        </div>
        <div class="mb-2">
            <label for="image_path" class="form-label">Obrazek</label>
            <!-- <input type="file" name="image" accept="image/*" required><br> -->
            <input type="text" name="image_path" id="image_path" required><br>
        </div>
        <div class="mb-2">
            <button type="submit" class="btn btn-success">
                Uloz to
            </button>
        </div>
    </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
