<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="dark:bg-gray-800">
    <h1 class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 pl-5">Výpis</h1>
    <div class="relative overflow-x-auto">
        <?php

        require "MySQL.php";
        require "Html.php";

        try {
            $driver = new MySQL();
            $db = $driver->connect("127.0.0.1", "root", "", "school");

            $html = new HTML();
            echo $html->createTable($db->select("SELECT Zak.id AS \"Id Zaka\", Zak.jmeno AS \"Jmeno Zaka\", Trida.nazev AS \"Nazev Tridy\", Trida.zastupujici_ucitel AS \"Zodpovedny Ucitel Tridy\" FROM Zak INNER JOIN Trida ON Zak.trida_id = Trida.id;"));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</body>

</html>