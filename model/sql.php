<?php

/**  Cette fonction permettra de raccourcir le code permettant de 
* récupérer chaque mioche par rapport a son id, ou de récupérer tous les enfants.
* Si nous ne mettons pas d'id dans cette fonction alors 
* la fonction récupéra tous les gosse.
* Exemple $children = selectAll("child")
* sinon elle selectionnera l'enfant avec l'id indiqué
* Exemple $child = selectAll("child, 40)*/

function selectAll(string $tableName, int|null $id=null) :array {
    //$pdo = new PDO("mysql:host=localhost;dbname=orphanage", "stagiaire", "Stagiaire");
     $pdo = new PDO("mysql:host=localhost;dbname=scrud_exo", "root", "");
    //Dans le cas ou il n'y pas id
    if( $id == null){
        $sql ="SELECT * FROM $tableName WHERE isDelete != 1";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else {
        // Ici on concatène le nom de la table ave id_
        // pour avoir le nom de colonne "id" associée à cette table
        $idName = "id_" . $tableName;
        $sql ="SELECT * FROM $tableName WHERE $idName = $id AND isDelete != 1";
        $stmt = $pdo->query($sql);
        // On retourne le tableau associatif de la requête.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

function updateData(string $tableName, array $data){
    //$pdo = new PDO("mysql:host=localhost;dbname=orphanage", "stagiaire", "Stagiaire");
    $pdo = new PDO("mysql:host=localhost;dbname=scrud_exo", "root", "");
    // Ici nous allons fabriquer la requete sql à partir uniquement du nom de sa table.
    $columnName = getColumn($tableName);
    $header_sql = "UPDATE $tableName SET ";
    // Ce qui entre les SET et le WHERE
    $body_sql = "";
    // WHERE jusqu'a la fin
    $footer_sql = "";
    // Nous avons besoin de connaitre la taille du tableau
    // qui contient les nom des colonnes
    $columnCount = count($columnName);
    foreach ($columnName as $index => $name) {
        
        // Ici nous allons faire le footer de la requete en premier 
        // car le nom de la colonne est en premier dans la base de donnée
        if ( $index === 0 ){
            $footer_sql = " WHERE $name=?";
            // on met moins 2 car nous voulons ici jusqu'a l'avant dernier
            // cependant nous ne voulons pas compter le isDelete.
        }elseif ($index > 0 && $index < $columnCount - 1) {
            $body_sql .= "$name=?,";
        }else {
            $body_sql .= "$name=?";
        }
    }try {
        $stmt = $pdo->prepare($header_sql . $body_sql . $footer_sql);
        $stmt->execute($data);
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
   
}

function getColumn($tableName) : array{
    $array =[];
 // $pdo = new PDO("mysql:host=localhost;dbname=orphanage", "stagiaire", "Stagiaire");
    $pdo = new PDO("mysql:host=localhost;dbname=scrud_exo", "root", "");
    $sql ="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName' ORDER BY ORDINAL_POSITION" ;
    $stmt = $pdo->query($sql);
    $col = $stmt->fetchAll(PDO::FETCH_NUM);
    foreach($col as $column ){
        if ($column[0] != "isDelete"){
            $array[] = $column[0];
        }
    }
    return $array;
}