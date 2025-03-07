<?php
include 'map.php';

$isbn = $_GET['isbn'] ?? '';
$firstname = $_GET['firstname'] ?? '';
$lastname = $_GET['lastname'] ?? '';
$title = $_GET['title'] ?? '';

$repo = new BookRepository();

if ($isbn || $firstname || $lastname || $title) {
    $books = $repo->searchBook($isbn, $firstname, $lastname, $title);
} else {
    $books = $repo->getAllBooks();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Vyhledej knihu</title>
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
                        <a class="nav-link active" href="filter.php">Vyhledej knihu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Přidej knihu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="display-5">Vyhledat knihu</h1>
        <form action="filter.php" method="GET">
            <div class="mb-2">
                <label for="firstname">Křestní jméno autora:</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
            </div>
            <div class="mb-2">
                <label for="lastname">Příjmení autora:</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
            </div>

            <div class="mb-2">
                <label for="title">Název knihy:</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>">
            </div>
            <div class="mb-2">
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn" value="<?php echo htmlspecialchars($isbn); ?>">
            </div>

            <button type="submit">Vyhledat</button>

            <!-- Tlačítko reset -->
            <button type="button" onclick="window.location.href = 'filter.php';">Obnovit seznam knih</button>
        </form>

        <!-- Výpis knih -->
        <?php if (isset($books) && is_array($books)): ?>
            <h2>Výsledky vyhledávání</h2>
            <table class="table table-striped">
                <tr>
                    <th>ISBN</th>
                    <th>Jméno autora</th>
                    <th>Příjmení autora</th>
                    <th>Název knihy</th>
                    <th>Popis</th>
                    <th>Obrázek</th>
                </tr>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($book->isbn); ?></td>
                            <td><?php echo htmlspecialchars($book->firstname); ?></td>
                            <td><?php echo htmlspecialchars($book->lastname); ?></td>
                            <td><?php echo htmlspecialchars($book->title); ?></td>
                            <td><?php echo htmlspecialchars($book->book_description); ?></td>
                            <td><img src="<?php echo htmlspecialchars($book->image_path); ?>" alt="Obrázek knihy" width="100"></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Žádné knihy nebyly nalezeny.</td>
                    </tr>
                <?php endif; ?>

            </table>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
