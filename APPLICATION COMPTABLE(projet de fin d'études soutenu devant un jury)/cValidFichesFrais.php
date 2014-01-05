<?php
/**
 * @author Aly BA <aly.ba2009@gmail.com>
 * @category espacecomtable
 * @todo le dossier espacecomptable
 * charge les controleurs comptable
 * charge le controleur actualisation des formulaires
 */

$repInclude2 ='./comptable/';
require($repInclude2 . "cLectureControle.php");
require($repInclude2 . "cFormForfaitHorsForfait.php");
?>
<script type="text/javascript">
<?php
require($repInclude . "_fonctionsValidFichesFrais.inc.js");
?>
</script>
<?php
require($repInclude . "_pied.inc.html");
require($repInclude . "_fin.inc.php");
?>