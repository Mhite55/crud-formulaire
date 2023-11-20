<?php
include_once "../model/pdo.php";
include_once "../model/sql.php";
include_once "tools.php";

if (
    !empty($_POST["name"]) && !empty($_POST["taille"]) && !empty($_POST["poids"])
    && !empty($_POST["age"])  && !empty($_POST["etat_sante"]) && !empty($_POST["id_user"])
) {
    $data = [$_POST["name"], $_POST["taille"], $_POST["poids"], $_POST["age"], $_POST["etat_sante"], $_POST["id_user"]];
    try {
        updateData('imc', $data);
        sendMessage("Modification effectuée(s)","success","../view/create_imc.php", $_POST["page"]);
    } catch (Exception $error) {
        sendMessage($error->getMessage(), "failed","../view/update_imc.php?id=$_POST[id_user]", $_POST["page"], true);
    }
} else {
    sendMessage("Veuillez remplir correctement le formulaire", "failed", "../view/update_imc.php?id=$_POST[id_user]", $_POST["page"], true);
}
