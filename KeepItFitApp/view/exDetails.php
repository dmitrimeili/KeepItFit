<?php
ob_start();
$class = "no-sidebar";

?>

<div class="container wrapper style1 centered">
    <h1>Exercice : <?= $exercise["exercise"] ?><br></h1>
    <h2> Type : <?=$exercise['program']?><br>
    <img src="images/<?= $exercise['image'] ?>" width="300px" height="300px"><br>
    Description :  </h2>
    <p><?= $exercise['description'] ?></p>
    <h2><?php if ($exercise['time'] != 0) { ?>
            <p>Temps : <?= $exercise["time"] ?> s </p>
        <?php } ?>
        <?php if ($exercise['repetition'] != 0) { ?>
            <p>Répetition : <?= $exercise["repetition"] ?></p>
        <?php } ?>

        <p>Difficulté : <?php
        switch ($exercise['difficulty']) {
            case "1";
                ?>Facile<?php
                break;
            case "2";
                ?>Moyen<?php
                break;
            case "3";
                ?>Difficile<?php
                break;
        } ?></p>

        <p>Zones ciblé : <?=$exercise['area']?></p>
        <p>Matériel requis : <?=$exercise['material']?></p>
    </h2>


</div>

<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>

