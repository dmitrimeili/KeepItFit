<?php
ob_start();

?>
<div class="container wrapper style1 centered">
    <form>
        <input type="image">
        <input type="text" name="name" placeholder="Nom">
        <select name="program">
            <?php foreach ($programs as $program){?>
            <option value="<?= $program['id']?>"><?=$program['name']?></option>
            <?php }?>
        </select>
        <textarea name="description"></textarea>
        <input type="number" name="reps" placeholder="Répétition">
        <input type="number" name="time" placeholder="temps en seconde">
    </form>

</div>
<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
