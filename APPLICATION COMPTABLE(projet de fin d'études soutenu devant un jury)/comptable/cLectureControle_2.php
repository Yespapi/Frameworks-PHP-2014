<?php

/**
 * @author Aly BA <aly.ba2009@gmail.com>
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @todo 
 */
$repInclude = './include/';
require($repInclude . "_init.inc.php");

// Page inaccessible si utilisateur non connecté
if (!estUtilisateurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

// acquisition des données entrées, ici l'id de visiteur, le mois et l'étape du traitement
$idVisiteur = lireDonnee("lstVisiteur", "");
$idMois = lireDonnee("lstMois", "");
$etape = lireDonnee("etape", "");

// structure de décision sur les différentes étapes du cas d'utilisation
if ($etape == "mettreEnPaiementFicheFrais") {
    modifierEtatFicheFrais($idConnexion, $idMois, $idVisiteur, 'MP');
}
?>

<!-- Division principale -->
<div id="contenu">
    <?php
    $lgVisiteur = obtenirDetailUtilisateur($idConnexion, $idVisiteur);
    $noMois = intval(substr($idMois, 4, 2));
    $annee = intval(substr($idMois, 0, 4));
    // Gestion des messages d'informations
    if ($etape == "mettreEnPaiementFicheFrais") {
        ?>
        <p class="info">La fiche de frais de <?php echo $lgVisiteur['nom'] . ' ' . $lgVisiteur['prenom']; ?> de <?php echo obtenirLibelleMois($noMois) . ' ' . $annee; ?> a bien été mise en paiement</p>        
        <?php
    }
    ?>       
?>
