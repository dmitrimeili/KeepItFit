<?php
ob_start();

?>
<div class="container wrapper style1 centered">
    <div class="row">
        <div class="col-sm">
            <form action="index.php?action=addPlace" id="placeForm" method="post">
                <input class="form-control" type="text" name="place" placeholder="Ajouter un lieu"><br>
                <input  type="submit" id="submit" value="Ajouter">
            </form>
            <br>
            <?php foreach ($places as $place) {?>
                <form>
                    <label for="submit"><?= $place['place']?></label>
                    <input type="submit" value="<?= $place['place']?>">
                </form><br>
            <?php }?>
        </div>
        <div class="col-sm">
            <form action="index.php?action=addTargetedArea" id="targetedAreaForm" method="post">
                <input class="form-control" type="text" name="trargetedArea" placeholder="Ajouter une zone ciblé"><br>
                <input  type="submit" id="submit" value="Ajouter">
            </form>
            <br>
            <?php foreach ($areas as $area) {?>
                <label><?= $area['name']?></label><br>
            <?php }?>
        </div>
        <div class="col-sm">
            <form action="index.php?action=addProgram" id="programForm" method="post">
                <input class="form-control" type="text" name="program" placeholder="Ajouter un programme"><br>
                <input type="submit" id="submit" value="Ajouter">
            </form>
            <br>
            <?php foreach ($programs as $program) {?>
                <label><?= $program['name']?></label><br>
            <?php }?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
