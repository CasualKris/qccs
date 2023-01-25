<?php
include_once "Spaceship.php";

?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            body {
                color:white;
                background-image: url("space.png");
            }
            table, th, td {
                border: 1px solid;
            }
        </style>
    </head>

    <body>
        <p>
            <?php
            $fleet1 = [];
            $fleet2 = [];

            // Generating Fleet 
            function genShip()
            {
                global $fleet1;
                global $fleet2;
                for ($int = 0; $int < 5; $int++) {
                    $fleet1[] = new fighterShip(100, rand(10, 100), rand(10, 100), [0, 0]);
                }

                for ($int = 0; $int < 5; $int++) {
                    $fleet2[] = new fighterShip(100, rand(10, 100), rand(10, 100), [100, 100]);
                }


            }

            //Fleet combat 
            function fleetCombat(array $firstFleet, array $secondFleet)
            {   
                //Default scores
                $deadShips1 = 0;
                $deadShips2 = 0;
                $fleet1Ammo = 0;
                $fleet2Ammo = 0;
                do {
                    //The combat loop
                    do {
                        //The combat itself (Note: '$deadShips' makes the ship in active combat be the first NOT dead ship)
                        $dmg = $firstFleet[$deadShips1]->shoot();
                        $secondFleet[$deadShips2]->hit($dmg);
                        $dmg2 = $secondFleet[$deadShips2]->shoot();
                        $firstFleet[$deadShips1]->hit($dmg2);
                    } while ($firstFleet[$deadShips1]->IsAlive() === true && $secondFleet[$deadShips2]->IsAlive() === true);

                    //Increase counter when any ship dies
                    if ($firstFleet[$deadShips1]->isAlive() === false) {
                        $deadShips1++;
                    } else {
                        $deadShips2++;
                    }
                } while ($deadShips1 < 5 && $deadShips2 < 5);
                echo "<br>";

                //Condition for the script to progress
                if ($deadShips1 === 5) {
                    echo "fleet 2 wins" . "<br>";
                } else if ($deadShips2 === 5) {
                    echo "fleet 1 wins" . "<br>";
                }
                echo "deaths of fleet 1: " . $deadShips1 . "<br>";
                echo "deaths of fleet 2: " . $deadShips2 . "<br>";
                
                //Results of the battle
                echo "<table>";
                echo "<p>Results of fleet 1</p>";
                echo "<tr>";
                echo "<th></th>";
                for ($count = 1; $count <= 5; $count++) {
                    echo "<th> Ship " . $count . "</th>";
                }
                echo "</tr>";
                echo "<tr>";
                echo "<td>Alive? </td>";
                foreach($firstFleet as $ship) {
                    echo "<td>" . $ship->isAlive() . "</td>";
                }
                echo "<tr>";
                echo "<td>Ammo consumed </td>";
                foreach($firstFleet as $ship) {
                    echo "<td>" . (100 - $ship->getAmmo()) . "</td>";
                }
                echo "</table>";

                echo "<table>";
                echo "<p>Results of fleet 2</p>";
                echo "<tr>";
                echo "<th></th>";
                for ($count = 1; $count <= 5; $count++) {
                    echo "<th> Ship " . $count . "</th>";
                }
                echo "</tr>";
                echo "<tr>";
                echo "<td>Alive? </td>";
                foreach($secondFleet as $ship) {
                    echo "<td>" . $ship->isAlive() . "</td>";
                }
                echo "<tr>";
                echo "<td>Ammo consumed </td>";
                foreach($secondFleet as $ship) {
                    echo "<td>" . (100 - $ship->getAmmo()) . "</td>";
                }
                echo "</table>";
            }

                //As the ships are for the most part randomized, it is required to also note the stats before the battle
            function drawShipSpecsTable(array $firstFleet, array $secondFleet)
            {
                echo "<table>";
                echo "<p>Overview of fleet 1</p>";
                echo "<tr>";
                echo "<th></th>";
                for ($count = 1; $count <= 5; $count++) {
                    echo "<th> Ship " . $count . "</th>";
                }
                echo "</tr>";
                echo "<tr>";
                echo "<td>Hit Points: </td>";
                foreach($firstFleet as $ship) {
                    echo "<td>" . $ship->getHitPoints() . "</td>";
                }
                echo "<tr>";
                echo "<td>Ammo consumed </td>";
                foreach($firstFleet as $ship) {
                    echo "<td>" . $ship->getAmmo() . "</td>";
                }
                echo "</table>";


                echo "<table>";
                echo "<p>Overview of fleet 2</p>";
                echo "<tr>";
                echo "<th></th>";
                for ($count = 1; $count <= 5; $count++) {
                    echo "<th> Ship " . $count . "</th>";
                }
                echo "</tr>";
                echo "<tr>";
                echo "<td>Hit Points: </td>";
                foreach($secondFleet as $ship) {
                    echo "<td>" . $ship->getHitPoints() . "</td>";
                }
                echo "<tr>";
                echo "<td>Ammo consumed </td>";
                foreach($secondFleet as $ship) {
                    echo "<td>" . $ship->getAmmo() . "</td>";
                }
                echo "</table>";
            }

            genShip();
            drawShipSpecsTable($fleet1, $fleet2);
            fleetCombat($fleet1, $fleet2);

            ?>
        </p>
    </body>
</html>