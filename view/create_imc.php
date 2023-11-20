<?php
    include_once "base.php"
?>
    <h1 class="text-center mt-5 mb-5">Calcul ton imc</h1>

    <?php include_once "message.php" ?>

    <form id="form" class="mx-auto col-8" action="../controller/create_ctrl_imc.php" method="POST">

    <label for="name">Name</label>
    <input class="form-control my-2" type="text" name="name"id="">

    <label for="taille">Taille (en cm)</label>
    <input class="form-control my-2" type="number " name="taille" id="">

    <label for="poids">Poids (en kg)</label>
    <input class="form-control my-2 " type="number " name="poids" id="">

    <label for="age">Age</label>
    <input class="form-control my-2" type="number" name="age" id="">

    <div class="form-check"> 
        <input class="form-check-input my-1" type="radio" name="etat_sante" checked value="bon" id="">
        <label class="form-check-label my-1" for="etat_sante">Bonne santé</label>
    </div>
    <div class="form-check">
        <input class="form-check-input my-1" type="radio" name="etat_sante" value="mauvais" id="">
        <label class="form-check-label my-1" for="etat_sante">En Mauvaise santé</label>
    </div>

    <input class="form-control mt-3" type="submit" value="Calcul">

    </form>
</body>
</html>