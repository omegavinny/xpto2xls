<?php

require "./DatabaseMySQL.php";

$connection = DatabaseMySQL::getConnection();

$table = 'inscricoes';

$sql = "SELECT DISTINCT `lote` FROM {$table}";

$atividades = $connection->query($sql);

foreach ($atividades as $atividade) {

    $labels = ['RG', 'Nome', 'E-mail', 'Assinatura do Participante'];

    $sql = "SELECT rg, nome, email, '' FROM {$table} WHERE `lote` = :lote";

    $statement = $connection->prepare($sql);
    $statement->execute([':lote' => $atividade[0]]);

    $result = $statement->fetchAll();

    $html = "<table border=1 style='width: 100%'; border-spacing: 15px;'>";

    $html .= "<tr><th colspan='4'>{$atividade[0]}</th></tr>";

    $html .= "<tr>";

    foreach($labels as $label) {
        $html .= "<th>{$label}</th>";
    }

    $html .= "</tr>";

    foreach($result as $row) {
        $html .= "<tr>";

        for($i=0; $i<4; $i++) {
            $html .= "<td>";
            $html .= $row[$i];
            $html .= "</td>";
        }

        $html .= "</tr>";
    }

    $html .= "</table>";

    echo $html;
    echo "<br>";

    file_put_contents("./exports/{$atividade[0]}.xls", $html);

}
?>