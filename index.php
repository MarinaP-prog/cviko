<?php
include "map.php";

$repo = new BookRepository();
$books = $repo->getAllBooks();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Seznam knih</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Books</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Seznam knih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="filter.php">Vyhledej knihu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Přidej knihu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="display-5">Seznam knih</h1>
        <table class="table table-striped">
    <thead>
        <tr>
            <th>ISBN</th>
            <th>Jméno autora</th>
            <th>Příjmení autora</th>
            <th>Název knihy</th>
            <th>Popis</th>
            <th>Obrázek</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book) : ?>
            <tr>
                <td><?php echo htmlspecialchars($book->isbn); ?></td>
                <td><?php echo htmlspecialchars($book->firstname); ?></td>
                <td><?php echo htmlspecialchars($book->lastname); ?></td>
                <td><?php echo htmlspecialchars($book->title); ?></td>
                <td><?php echo htmlspecialchars($book->book_description); ?></td>
                <td><img src="<?php echo htmlspecialchars($book->image_path); ?>" alt="Obrázek knihy" width="100"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>