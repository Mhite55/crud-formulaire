<?php
    include_once "base.php";
    include_once "../model/sql.php";
    include_once "../controller/tools.php";

    if (isset ($_GET['id_user'])) {
        $patient = selectAll("imc", $_GET['id_user']);
    }
    //$patient = selectAll("imc", $_GET['id']);
?>

<h1 class="text-center mt-5 mb-5">Modifier un Patient</h1>

<?php include_once "message.php" ?>

<form id="form" class="mx-auto col-8" action="../controller/update_ctrl_imc.php" method="POST">

<label for="name">Name</label>
<input class="form-control my-2" type="text" name="name" value="<?= $patient['name'] ?>">

<label for="taille">Taille (en cm)</label>
<input class="form-control my-2" type="number" name="taille" value="<?= $patient['taille'] ?>">

<label for="poids">Poids (en kg)</label>
<input class="form-control my-2" type="number" name="poids"  value="<?= $patient['poids']?>">

<label for="age">Age</label>
<input class="form-control my-2" type="number" name="age"  value="<?= $patient['age'] ?>">

<?php
    $eta = ['bon', 'mauvais'];
    echo createCheckButton("etat_sante", $patient['etat_sante'], $eta);
?>

    <input type="hidden" name="id_user" value="<?= $patient['id_user'] ?>">
    <input type="hidden" name="page" value="<?= $_GET['page'] ?>">

    <input class="form-control mt-3" type="submit" value="Modification">

    </form>
</body>
</html>