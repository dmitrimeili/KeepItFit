<?php
ob_start();
$class = "no-sidebar";
?>
<div class="container wrapper style1 centered">
    <?php foreach ($exercises as $exercise) { ?>
        <div class="rounded w3-hover-shadow"><br>
            <img src="images/<?= $exercise['image'] ?>" width="150px" height="150px">
            <header class="w3-container "><h2> Exercice : <?= $exercise["exercise"] ?><br></h2></header>
            <?php if ($exercise['time'] != 0) { ?>
                &nbsp;&nbsp;&nbsp;Temps : <?= $exercise["time"] ?> s
            <?php } ?>
            <?php if ($exercise['repetition'] != 0) { ?>
                &nbsp;&nbsp;&nbsp;Répetition : <?= $exercise["repetition"] ?>
            <?php } ?>

            <div class="right w3-container">
                <a href="index.php?action=exDetails&name=<?= $exercise['exercise'] ?>">
                    <button type="button" style="width: 35%">Détails</button>
                </a>
            </div>
            <br>
            <br>
        </div>

    <?php } ?>
</div>

<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
