<?php
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

// Gestisci i filtri
$filterParking = isset($_GET['filterParking']) ? $_GET['filterParking'] : '';
$filterVote = isset($_GET['filterVote']) ? $_GET['filterVote'] : '';

$filteredHotels = array_filter($hotels, function ($hotel) use ($filterParking, $filterVote) {
    if ($filterParking !== '' && $hotel['parking'] != $filterParking) {
        return false;
    }
    if ($filterVote !== '' && $hotel['vote'] < $filterVote) {
        return false;
    }
    return true;
});
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>PHP Hotel</title>
</head>

<body>

    <div class="container mt-5">
        <h1>Lista degli Hotel</h1>

        <!-- form per i filtri -->
        <form class="mb-5" method="get">
            <div class="row">
                <div class="col-md-3">
                    <label for="filterParking" class="form-label">Filtra per parcheggio:</label>
                    <select id="filterParking" name="filterParking" class="form-select">
                        <option value="">Tutti</option>
                        <option value="1">Con parcheggio</option>
                        <option value="0">Senza parcheggio</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filterVote" class="form-label">Filtra per voto:</label>
                    <input type="number" id="filterVote" name="filterVote" class="form-control" min="1" max="5">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filtra</button>
                </div>
            </div>
        </form>

        <!-- hotel in tabella -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredHotels as $hotel) : ?>
                    <tr>
                        <td><?= $hotel['name'] ?></td>
                        <td><?= $hotel['description'] ?></td>
                        <td><?= $hotel['parking'] ? 'Sì' : 'No' ?></td>
                        <td><?= $hotel['vote'] ?></td>
                        <td><?= $hotel['distance_to_center'] ?> km</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

</html>