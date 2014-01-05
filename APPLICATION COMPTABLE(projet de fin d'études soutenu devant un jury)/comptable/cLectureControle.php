<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @author Aly BA <aly.ba2009@gmail.com>
 * @package default
 * @todo  Script de contrôle et d'affichage du cas d'utilisation "Valider fiche de frais"
 * lit des données du comportement comptable, importe le script _init.inc.php/
 * respect des conventiosn de codage et de nommage.
 */
$repInclude = './include/';
require($repInclude . "_init.inc.php");

//Page accessible que  par connexion
if (!estUtilisateurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

// Affecte du mois précédent pour la validation des fiches de frais
$mois = sprintf("%04d%02d", date("Y"), date("m"));

// Cloture des fiches de frais antérieur au mois courant et au besoin, création des fiches pour le mois courant
cloturerFichesFrais($idConnexion, $mois);

// Unité de traitement, Lecture des données entrées, ici l'id de visiteur, le mois et l'étape du traitement
$visiteurChoisi = lireDonnee("lstVisiteur", "");
$moisChoisi = lireDonnee("lstMois", "");
$nouveauTypeVehicule = lireDonnee("lstVehicule", "");
$etape = lireDonnee("etape", "");

// Lecture des quantités des éléments forfaitisés 
$tabQteEltsForfait = lireDonneePost("txtEltsForfait", "");

// Lecture des informations des éléments hors forfait
$tabEltsHorsForfait = lireDonneePost("txtEltsHorsForfait", "");
$nbJustificatifs = lireDonneePost("nbJustificatifs", "");

// controleur du comportement  du comptable
if ($etape == "choixVisiteur") {
    
// Le comptable a choisi un visiteur
} elseif ($etape == "choixMois") {
    
// Le Comptable a choisi un mois
} elseif ($etape == "actualiserVehicule") {
    
    // Le Comptable actualise le type de vehicule
    modifierTypeVehiculeFicheFrais($idConnexion, $moisChoisi, $visiteurChoisi, $nouveauTypeVehicule);
    
} elseif ($etape == "actualiserFraisForfait") {
// Le comptable actualise les informations des frais forfaitisés
// Le comptable  valide les éléments forfaitisés         
// Vérifiecation   des quantités des éléments forfaitisés
    $ok = verifierEntiersPositifs($tabQteEltsForfait);
    if (!$ok) {
        ajouterErreur($tabErreurs, "Chaque quantité doit être renseignée et numérique positive.");
    } else { // Mise à jour des quantités des éléments forfaitisés
        modifierEltsForfait($idConnexion, $moisChoisi, $visiteurChoisi, $tabQteEltsForfait);
    }
    
} elseif ($etape == "actualiserFraisHorsForfait") {
// Le comptable actualise les informations des frais hors forfait
// Le comptable  valide les éléments non forfaitisés      
// Une suppression est donc considérée comme une actualisation puisque c'est 
// Le libellé qui est mis à jour   
    foreach ($tabEltsHorsForfait as $cle => $val) {
        switch ($cle) {
            case 'libelle':
                $libelleFraisHorsForfait = $val;
                break;
            case 'date':
                $dateFraisHorsForfait = $val;
                break;
            case 'montant':
                $montantFraisHorsForfait = $val;
                break;
        }
    }
// Vérification de la validité des données d'une ligne de frais hors forfait
    verifierLigneFraisHF($dateFraisHorsForfait, $libelleFraisHorsForfait, $montantFraisHorsForfait, $tabErreurs);
    if (nbErreurs($tabErreurs) == 0) {
// Mise à jour des quantités des éléments non forfaitisés
        modifierEltsHorsForfait($idConnexion, $tabEltsHorsForfait);
    }
} elseif ($etape == "reporterLigneFraisHF") {
// Le comptable  demande le report d'une ligne hors forfait dont les justificatifs ne sont pas arrivés à temps
    reporterLigneHorsForfait($idConnexion, $tabEltsHorsForfait['id']);
} elseif ($etape == "actualiserNbJustificatifs") {
// Le comptable  actualise le nombre de justificatifs
    $ok = estEntierPositif($nbJustificatifs);
    if (!$ok) {
        ajouterErreur($tabErreurs, "Le nombre de justificatifs doit être renseigné et numérique positif.");
    } else {
// Mise à jour du nombre de justificatifs
        modifierNbJustificatifsFicheFrais($idConnexion, $moisChoisi, $visiteurChoisi, $nbJustificatifs);
    }
} elseif ($etape == "validerFiche") {
// Le Comptable  valide la fiche
    modifierEtatFicheFrais($idConnexion, $moisChoisi, $visiteurChoisi, 'VA');
}
?>

?>
