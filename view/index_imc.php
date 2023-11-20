<?php
include_once "base.php";
include_once "../model/pdo.php";
// PAGINATION

$sql_patient = "SELECT COUNT(*) FROM imc WHERE isDelete != true";
$nbr = $pdo->query($sql_patient);
$patientNbr = $nbr->fetch();
$patientNbr = $patientNbr[0];
$nbrByPage = 10;
$page = ceil($patientNbr / $nbrByPage);
if (isset($_GET["page"]) && $_GET["page"] != 0 && $_GET["page"] <= $page) {
    $currentPage = (int)$_GET["page"];
    $offset = ($currentPage * $nbrByPage) - $nbrByPage;

    $sql = "SELECT * FROM imc WHERE isDelete != true ORDER BY id_user ASC LIMIT $offset, $nbrByPage";
    $stmt = $pdo->query($sql);
    // stmt = statements
    $patient = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location:index_imc.php?page=1");
}

?>

<h1 class="text-center">Liste des patient</h1>

<?php include_once "message.php" ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Taille</th>
            <th>Poids</th>
            <th>Age</th>
            <th>état de santé</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET["page"])) {
            $table = "";
            $p = $_GET["page"];
            foreach ($patient as $imc) {
                $table .= "<tr>";
                $table .= "<td>$imc[name]</td>";
                $table .= "<td>$imc[taille]</td>";
                $table .= "<td>$imc[poids]</td>";
                $table .= "<td>$imc[age]</td>";
                $table .= "<td>$imc[etat_sante]</td>";
                $table .="<td> <a class='destroy-imc' data-toggle='tooltip' data-placement='top' title='Supprimer le patient' href='../controller/delete_ctrl_imc.php?id=$imc[id_user]&page=$p'>❌</a><a class='destroy-imc' data-toggle='tooltip' data-placement='top' title='Modifier les données Patient' href='update_imc.php?id=$imc[id_user]&page=$p'>🔍</a></td>";
                $table .= "</tr>";
            }
            echo $table;
        }
        ?>
    </tbody>
</table>
</table>
<nav aria-label="Page navigation patient">
    <ul class="pagination justify-content-center">
        <li class='page-item'><a class='page-link' href="index_imc.php?page=1">
                <<< </a>
        </li>
        <?php
        if (isset($_GET["page"])) {
            $currentPage = (int)$_GET["page"];
            for ($i = 1; $i <= $page; $i++) {
                if ($i <= $currentPage + 2 && $i > $currentPage - 2) {
                    echo "<li class='page-item'><a class='page-link' href='index_imc.php?page=$i'>$i</a></li>";
                }
            }
        }
        ?>
        <li class='page-item'><a class='page-link' href="index_imc.php?page=<?= $page ?>">>>> </a> </li>
    </ul>
</nav>
</body>

</html>