<?php
/**
 * 
 * @author Aly BA <aly.ba2009@gmail.com> 
 * @package default
 * @todo Script de contrôle et d'affichage 
 * du cas d'utilisation "Suivre le paiement fiche de frais
 */
?>
<?php
        //Chargement des données de visiteurs à payer
       $repInclude2 ='./comptable/';
       require($repInclude2 . "cLectureControle_2.php");
       require($repInclude2 . "cSelectionVisiteursApayer.php");
?>
        
    <form id="formChoixFichesAPayer" method="post" action="">
        <p>
            <input type="hidden" id="etape" name="etape" value="mettreEnPaiementFicheFrais" />
            <input type="hidden" id="lstVisiteur" name="lstVisiteur" value="" />
            <input type="hidden" id="lstMois" name="lstMois" value="" />
        </p>
        <?php //Affichage des  listes de visiteurs à Payer?>
        <div style="clear:left;"><h2>Fiches de frais validées</h2></div>
        <table style="color:white;" border="1">
            <tr><th rowspan="2" style="vertical-align:middle;">Visiteur&nbsp;médical</th><th rowspan="2" style="vertical-align:middle;">Mois</th><th colspan="3">Fiches de frais</th><th rowspan="2" style="vertical-align:middle;">Actions</th></tr>
            <tr><th>Forfait</th><th>Hors forfait</th><th>Total</th></tr>
            <?php
            while ($lgFicheAPayer = mysql_fetch_array($idJeuFicheAPayer)) {
                $mois = $lgFicheAPayer['mois'];
                $noMois = intval(substr($mois, 4, 2));
                $annee = intval(substr($mois, 0, 4));
                ?>
                <tr align="center">
                    <td style="width:80px;white-space:nowrap;color:black;"><?php echo $lgFicheAPayer['nom'] . ' ' . $lgFicheAPayer['prenom']; ?></td>
                    <td style="width:80px;white-space:nowrap;color:black;"><?php echo obtenirLibelleMois($noMois) . ' ' . $annee; ?></td>
                    <td style="width:80px;white-space:nowrap;color:black;text-align:right;"><?php echo $lgFicheAPayer['montantForfait']; ?></td>
                    <td style="width:80px;white-space:nowrap;color:black;text-align:right;"><?php echo $lgFicheAPayer['montantHorsForfait']; ?></td>
                    <td style="width:80px;white-space:nowrap;color:black;text-align:right;"><?php echo $lgFicheAPayer['totalFicheFrais']; ?></td>
                    <td style="width:80px;white-space:nowrap;color:black;">
                        <div id="actionsFicheFrais<?php echo $lgFicheAPayer['id']; ?>" class="actions">
                            <a class="actionsCritiques" onclick="mettreEnPaiementFicheFrais('<?php echo $lgFicheAPayer['id']; ?>',<?php echo $lgFicheAPayer['mois']; ?>);" title="Mettre en paiement la fiche de frais">&nbsp;<img src="images/mettreEnPaiementIcon.png" class="icon" alt="icone Mettre en paiment" />&nbsp;Mettre en paiement&nbsp;</a>
                        </div>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>
    </form>
</div>
<script type="text/javascript">
    function mettreEnPaiementFicheFrais(idVisiteur,idMois) {
        document.getElementById('lstVisiteur').value = idVisiteur;
        document.getElementById('lstMois').value = idMois;
        document.getElementById('formChoixFichesAPayer').submit();
    }
</script>
<?php
require($repInclude . "_pied.inc.html");
require($repInclude . "_fin.inc.php");
?>