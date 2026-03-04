<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bootstrap Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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

    //  Prendiamo la scelta dell'utente dal form (GET)
    // Se non hanno ancora cliccato nulla, usiamo una stringa vuota
    $parking_filter = $_GET['parking'] ?? '';

    // Creiamo un nuovo contenitore (array) per gli hotel che vogliamo mostrare
    $filtered_hotels = [];

    //  Ciclo per decidere quali hotel inserire nella lista filtrata
    foreach ($hotels as $hotel) {

        // Caso A: L'utente vuole vedere tutto (non ha scelto un filtro)
        if ($parking_filter === '') {
            $filtered_hotels[] = $hotel;
        }

        // Caso B: L'utente ha scelto "Solo con parcheggio" (value="1")
        // Controlliamo se l'hotel ha il parcheggio (true)
        elseif ($parking_filter === '1' && $hotel['parking'] === true) {
            $filtered_hotels[] = $hotel;
        }

        // Caso C: L'utente ha scelto "Solo senza parcheggio" (value="0")
        // Controlliamo se l'hotel non ha il parcheggio (false)
        elseif ($parking_filter === '0' && $hotel['parking'] === false) {
            $filtered_hotels[] = $hotel;
        }
    }
    ?>

    <div class="container mt-5">
        <form action="index.php" method="GET" class="row g-3 mb-4">
            <div class="col-auto">
                <label for="parking" class="form-label">Filtra per Parcheggio:</label>
                <select name="parking" id="parking" class="form-select">
                    <option value="">Tutti gli hotel</option>
                    <option value="1">Solo con parcheggio</option>
                    <option value="0">Solo senza parcheggio</option>
                </select>
            </div>
            <div class="col-auto d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtra</button>
                <a href="index.php" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </form>

        <h1 class="text-center mb-4">Lista Hotel</h1>

        <table class="table table-striped table-hover border">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filtered_hotels as $hotel) { ?>
                    <tr>
                        <td>
                            <?php echo $hotel['name']; ?>
                        </td>
                        <td>
                            <?php echo $hotel['description']; ?>
                        </td>
                        <td>
                            <?php
                            if ($hotel['parking'] === true) {
                                echo "Sì";
                            } else {
                                echo "No";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $hotel['vote']; ?> / 5
                        </td>
                        <td>
                            <?php echo $hotel['distance_to_center']; ?> km
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>