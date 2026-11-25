<?php

$serveurs = [
    "api-01"   => ["cpu" => 45, "ram" => 60, "status" => "1"],
    "api-02"   => ["cpu" => 92, "ram" => 78, "status" => "1"],
    "db-prod"  => ["cpu" => 70, "ram" => 95, "status" => "1"],
    "web-01"   => ["cpu" => 30, "ram" => 40, "status" => "1"],
    "web-02"   => ["cpu" => 55, "ram" => 65, "status" => "0"],
    "cache-01" => ["cpu" => 88, "ram" => 92, "status" => "1"]
];


$totalOnline = 0;
$sommeScores = 0;
$nbServeurs = count($serveurs);
$meilleurServeur = null;
$meilleurScore = -INF;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 2 - Monitoring de serveurs</title>
</head>
<body>

    
    <table id="table1" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 8px;">Serveur</th>
                <th style="padding: 8px;">CPU%</th>
                <th style="padding: 8px;">RAM%</th>
                <th style="padding: 8px;">Status</th>
                <th style="padding: 8px;">Score</th>
                <th style="padding: 8px;">État</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            foreach ($serveurs as $nomServeur => $infos) {
                $cpu = $infos["cpu"];
                $ram = $infos["ram"];
                $statusCode = $infos["status"];

                if ($statusCode === "1") {
                    $statusLabel = "online";
                    $totalOnline++;
                } else {
                    $statusLabel = "offline";
                }

                
                $score = 100 - (($cpu + $ram) / 2);
                $sommeScores += $score;

                
                if ($score > $meilleurScore) {
                    $meilleurScore = $score;
                    $meilleurServeur = $nomServeur;
                }

              
                $estCritique = ($cpu > 85) || ($ram > 90);
                if ($estCritique) {
                    $etat = "CRITIQUE";
                } elseif ($score >= 50) {
                    $etat = "OK";
                } else {
                    $etat = "ATTENTION";
                }

                
                if ($statusLabel === "offline") {
                    $bgColor = "RGB(200,200,200)";
                } elseif ($estCritique) {
                    $bgColor = "RGB(255,180,180)";
                } elseif ($score >= 50) {
                    $bgColor = "RGB(180,255,180)";
                } else {
                    $bgColor = "RGB(255,220,150)";
                }

                
                echo "<tr class=\"row\" style=\"background-color: $bgColor;\">";
                echo "<td class=\"serveur\" style=\"padding: 8px;\">" . htmlspecialchars($nomServeur) . "</td>";
                echo "<td class=\"cpu\" style=\"padding: 8px;\">" . htmlspecialchars($cpu) . "</td>";
                echo "<td class=\"ram\" style=\"padding: 8px;\">" . htmlspecialchars($ram) . "</td>";
                echo "<td class=\"status\" style=\"padding: 8px;\">" . htmlspecialchars($statusLabel) . "</td>";
                echo "<td class=\"score\" style=\"padding: 8px;\">" . htmlspecialchars($score) . "</td>";
                echo "<td class=\"etat\" style=\"padding: 8px;\">" . htmlspecialchars($etat) . "</td>";
                echo "</tr>";
            }

            
            $moyenneScores = ($nbServeurs > 0) ? ($sommeScores / $nbServeurs) : 0;
            ?>
        </tbody>
    </table>

    
    <div style="margin-top: 16px;">
        <h3 style="margin-bottom: 8px;">Résumé</h3>
        <p style="margin: 4px 0;">Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
        <p style="margin: 4px 0;">Score moyen: <span id="moy_scores"><?php echo $moyenneScores; ?></span></p>
        <p style="margin: 4px 0;">Meilleur serveur: <span id="best_serv"><?php echo htmlspecialchars($meilleurServeur) . " (" . htmlspecialchars($meilleurScore) . ")"; ?></span></p>
    </div>

</body>
</html>