<?php
ob_start();
$class = "no-sidebar";
?>
<div class="container wrapper style1 centered">
<?= $exercise['exercise']?>
</div>
<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>

