<?php

function sendMessage(string $message,string $status, string $location, int|null $page=null, bool $hasAIdBefore = false) :void{ //void = la fonction ne retourne rien
    // S'il y a un id avant nous remplaceront le "?" de l'url par un &
    $replace = !$hasAIdBefore ? "?" : "&";
    if ($page == null) {
        header("Location:$location" . $replace ."message=$message&status=$status");
        exit;
    }else{
        header("Location:$location" . $replace ."page=$page&message=$message&status=$status");
        exit;
    }
    
}

function createCheckButton(string $collumnName, string $dbValue, array $values) : string {
    $result = '';
    
    foreach ($values as $value) {
        $result .= "<div class='form-check'> ";
        $upper = ucfirst($value);
        if($value === $dbValue){
            $result .= "<input class='form-check-input' type='radio' name='$collumnName' checked value='$value' >";
        }else {
            $result .= "<input class='form-check-input' type='radio' name='$collumnName' value='$value' >";
        }
        $result .=  "<label class='form-check-label' for='$collumnName'>$upper</label></div>";
    }
    return $result;
}