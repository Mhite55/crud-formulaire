<?php
include_once "../model/pdo.php";
include_once "tools.php";

if (
    !empty($_POST["name"]) && !empty($_POST["taille"]) && !empty($_POST["poids"])
    && !empty($_POST["age"])  && !empty($_POST["etat_sante"])
) {
    try {
        $sql = "INSERT INTO imc (name, taille, poids, age, etat_sante, isDelete) VALUE (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST["name"], $_POST["taille"], $_POST["poids"], $_POST["age"], $_POST["etat_sante"], 0]);
        sendMessage("Imc est entré dans la base de donnés", "success", "../view/create_imc.php");
    } catch (Exception $e) {
        sendMessage($e->getMessage(), "failed", "../view/create_imc.php");
    }
} else {
    sendMessage("Veuillez remplir correctement le formulaire", "failed", "../view/create_imc.php");
}
