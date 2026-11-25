<?php

$etudiantsNote = [
    "JOHN" => 9,
    "BOB" => 15.5,
    "RAYANE" => 7,
    "ROSIE" => 13
];


function estAdmissible($note) {
    
    if ($note >= 10) {
        return "Vrai";
    } else {
        return "Faux";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 1 - Étudiants Notes</title>
</head>
<body>

    
    <table id="table1" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 8px;">Etudiant</th>
                <th style="padding: 8px;">Note</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            foreach ($etudiantsNote as $nom => $note) {
               
                $resultat = estAdmissible($note);

                
                if ($resultat === "Vrai") {
                    $bgColor = "RGB(136,248,136)";
                } else {
                    $bgColor = "RGB(251,173,173)";
                }

                
                echo "<tr class=\"row\" style=\"background-color: $bgColor;\">";
                echo "<td class=\"etud\" style=\"padding: 8px;\">" . htmlspecialchars($nom) . "</td>";
                echo "<td class=\"note\" style=\"padding: 8px;\">" . htmlspecialchars($note) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>