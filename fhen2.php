<style type="text/css">
	iframe{
		width: 100% !important;
		height: 500px;
	}
	@media (min-width: 320px) and (max-width: 480px) {
		iframe{
			height: 280px;
		}
	}
</style>
<?php


echo "<h2>$vhen[title]</h2>";

echo html_entity_decode($vhen['video']);


?>
