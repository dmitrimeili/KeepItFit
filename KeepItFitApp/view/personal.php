<?php
ob_start();
$class = "no-sidebar";
?>

<div class="container wrapper style1 centered">

    <form action="index.php?action=CreateProgram" method="post">
        <div class="row ">
            <div class="col-sm">
                <select name="place">
                    <?php foreach ($places as $place) { ?>
                        <option value="<?= $place['id'] ?>"><?= $place['place'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm">
                <select name="program">
                    <?php foreach ($programs as $program) { ?>
                        <option value="<?= $program['id'] ?>"><?= $program['name'] ?></option>
                    <?php } ?>
                </select>
                <br>
            </div>
            <input type="submit" id="submit" name="submit" value="Créer un programme perso">
        </div>
        <form>
</div>
<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
