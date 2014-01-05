<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @author aly
 * @descrption:  script de sélection des utilisateur à payer
 */
?>
<h1>Suivi des paiement des fiches de frais</h1>
    <?php
    $req = "SELECT utilisateur.id, nom, prenom, ficheFrais.mois, SUM(FraisF.montantForfaitNoKm + IndemKm.montantIndemKm) AS montantForfait,";
    $req .= "      (ficheFrais.montantValide - SUM(FraisF.montantForfaitNoKm + IndemKm.montantIndemKm)) AS montantHorsForfait, ficheFrais.montantValide AS totalFicheFrais";
    $req .= " FROM utilisateur ";
    $req .= "      INNER JOIN ficheFrais ON (utilisateur.id=ficheFrais.idVisiteur)";
    $req .= "      INNER JOIN (";
    $req .= "	     SELECT utilisateur.id, ficheFrais.mois, SUM(lignefraisforfait.quantite * fraisForfait.montant) AS montantForfaitNoKm";
    $req .= "         FROM utilisateur INNER JOIN ficheFrais ON utilisateur.id=ficheFrais.idVisiteur";
    $req .= "                          INNER JOIN lignefraisforfait ON (ficheFrais.idVisiteur = lignefraisforfait.idVisiteur  AND ficheFrais.mois = lignefraisforfait.mois)";
    $req .= "                          INNER JOIN fraisForfait ON lignefraisforfait.idFraisForfait = fraisForfait.id";
    $req .= "         WHERE ficheFrais.idEtat = 'VA'";
    $req .= "           AND utilisateur.idType = 'V'";
    $req .= "           AND lignefraisforfait.idFraisForfait != 'KM'";
    $req .= "	      GROUP BY utilisateur.id, ficheFrais.mois";
    $req .= "         ) AS FraisF ON (ficheFrais.idVisiteur = FraisF.id AND ficheFrais.mois = FraisF.mois)";
    $req .= "      INNER JOIN(";
    $req .= "         SELECT utilisateur.id, ficheFrais.mois, SUM(lignefraisforfait.quantite * indemniteKm) AS montantIndemKm";
    $req .= "         FROM utilisateur INNER JOIN ficheFrais ON utilisateur.id=ficheFrais.idVisiteur";
    $req .= "                          INNER JOIN lignefraisforfait ON (ficheFrais.idVisiteur = lignefraisforfait.idVisiteur  AND ficheFrais.mois = lignefraisforfait.mois)";
    $req .= "                          INNER JOIN typeVehicule ON fichefrais.idTypeVehicule = typeVehicule.id";
    $req .= "         WHERE ficheFrais.idEtat = 'VA'";
    $req .= "           AND utilisateur.idType = 'V'";
    $req .= "           AND lignefraisforfait.idFraisForfait = 'KM'";
    $req .= "	      GROUP BY utilisateur.id, ficheFrais.mois";
    $req .= "         ) AS IndemKm ON (FraisF.id = IndemKm.id AND FraisF.mois = IndemKm.mois)";
    $req .= " WHERE ficheFrais.idEtat = 'VA'";
    $req .= "   AND utilisateur.idType = 'V'";
    $req .= " GROUP BY utilisateur.id, nom, prenom, ficheFrais.mois";
    $idJeuFicheAPayer = mysql_query($req, $idConnexion);
    ?>
