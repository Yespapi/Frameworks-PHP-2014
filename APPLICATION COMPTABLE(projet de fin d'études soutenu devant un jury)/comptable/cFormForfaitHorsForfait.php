<?php
/**
 * 
 * To change this template, choose Tools | Templates
 * @author Aly BA
 * and open the template in the editor.
 * @todo Charges les données forfaits et horsfait et actualise les donnes
 * de la personne concernée, interface compatable pour valider les fiches de frais;
 * respecte la convention de Nommage imposé du projet, au niveau des variables
 * et des nomenclaures de script.
 * Ce script fait appel aux fonctions du script _bdGestionDonnees & _utilitairesGEstionErreurs.lib.php
 *  dont les plus important sont les suivants:
 * obtenirDetailUtilisateur : detail utilisateur
 * obtenirReqListeVisiteurs : liste des visiteur
 * obtenirDetailFicheFrais  : detail d'une fiche de frais
 * obtenirReqMoisFicheFrais : fiche de frais pour un mois 
 * 
 */
?>
<!-- Division principale -->
<div id="contenu">
    <h1>Validation des frais par visiteur </h1>
    
    <?php
    // Gére  les messages d'informations  et controle le comportement du comptable
    
    //Controle d'actualssation du véhicule
    if ($etape == "actualiserVehicule") {
        if (nbErreurs($tabErreurs) > 0) {
            echo toStringErreurs($tabErreurs);
        } else {
            ?>
            <p class="info">L'actualisation du type de véhicule a bien été enregistré</p>        
            <?php
        }
    }
    //Controle l'actualisation du forfait
    if ($etape == "actualiserFraisForfait") {
        if (nbErreurs($tabErreurs) > 0) {
            echo toStringErreurs($tabErreurs);
        } else {
            ?>
            <p class="info">L'actualisation des quantités au forfait a bien été enregistrée</p>        
            <?php
        }
    }
    //Controle l'actualisation du HorsFofait
    if ($etape == "actualiserFraisHorsForfait") {
        if (nbErreurs($tabErreurs) > 0) {
            echo toStringErreurs($tabErreurs);
        } else {
            ?>
            <p class="info">L'actualisation de la ligne de frais hors forfait a bien été enregistrée</p>        
            <?php
        }
    }
    //Controle le report d'une ligne de frais
    if ($etape == "reporterLigneFraisHF") {
        ?>
        <p class="info">La ligne de frais hors forfait a bien été reportée</p>        
        <?php
    }
    //Controle l'actualisation du nombre de justifcatifs
    if ($etape == "actualiserNbJustificatifs") {
        if (nbErreurs($tabErreurs) > 0) {
            echo toStringErreurs($tabErreurs);
        } else {
            ?>
            <p class="info">L'actualisation du nombre de justificatifs a bien été enregistré</p>        
            <?php
        }
    }
    //Controle la validation d'une ligne de frais
    if ($etape == "validerFiche") {
        $lgVisiteur = obtenirDetailUtilisateur($idConnexion, $visiteurChoisi);
        ?>
        <p class="info">La fiche de frais du visiteur <?php echo $lgVisiteur['prenom'] . " " . $lgVisiteur['nom']; ?> pour <?php echo obtenirLibelleMois(intval(substr($moisChoisi, 4, 2))) . " " . intval(substr($moisChoisi, 0, 4)); ?> a bien été enregistrée</p>        
        <?php
        //Réinitialise le mois choisi pour forcer la disparition du bas de page, la réactualisation des mois et le choix d'un nouveau mois
        $moisChoisi = "";
    }
    ?>
 <?php//Partie principale de l'interface Comptable?>
        <?php //form choix d'un visiteur ?>
    <form id="formChoixVisiteur" method="post" action="">
        <p>
            <input type="hidden" name="etape" value="choixVisiteur" />
            <label class="titre">Choisir le visiteur :</label>
            <select name="lstVisiteur" id="idLstVisiteur" class="zone" onchange="changerVisiteur(this.options[this.selectedIndex].value);">
                <?php
                
                // invite à choisir un visiteur
                if ($visiteurChoisi == "") {
                    ?>
                    <option value="-1">=== Choisir un visiteur médical ===</option>
                    <?php
                }
                
                //propose tous les  des visteurs médicaux connus(dans la base de donnée)
                $req = obtenirReqListeVisiteurs();
                $idJeuVisiteurs = mysql_query($req, $idConnexion);
                while ($lgVisiteur = mysql_fetch_array($idJeuVisiteurs)) {
                    ?>
                    <option value="<?php echo $lgVisiteur['id']; ?>"<?php if ($visiteurChoisi == $lgVisiteur['id']) { ?> selected="selected"<?php } ?>><?php echo $lgVisiteur['nom'] . " " . $lgVisiteur['prenom']; ?></option>
                    <?php
                }
                mysql_free_result($idJeuVisiteurs);
                ?>
            </select>
        </p>
    </form>
    <?php
    
//Formulaire dynamique, le mois s'affiche que si un visiteur a été choisi
    if ($visiteurChoisi != "") {
        ?>
        <?php //form choix d'un mois ?>
        <form id="formChoixMois" method="post" action="">
            <p>
                <input type="hidden" name="etape" value="choixMois" />
                <input type="hidden" name="lstVisiteur" value="<?php echo $visiteurChoisi; ?>" />
                
                <?php
                //Propose tous les mois pour lesquels le visiteur dispose d'une fiche de frais cloturée
                $req = obtenirReqMoisFicheFrais($visiteurChoisi, 'CL');
                $idJeuMois = mysql_query($req, $idConnexion);
                $lgMois = mysql_fetch_assoc($idJeuMois);
                
                // si aucun  fiche de frais n'existe pour ce mois le système affiche "Pas de fiche de frais pour ce visiteur ce mois". Retour au à la situation précédente
                if (empty($lgMois)) {
                    ajouterErreur($tabErreurs, "Pas de fiche de frais à valider pour ce visiteur, veuillez choisir un autre visiteur");
                    echo toStringErreurs($tabErreurs);
                } else {
                    ?>
                    <label class = "titre">Mois :</label>
                    <select name="lstMois" id="idDateValid" class="zone" onchange="this.form.submit();">
                        <?php
                        //Invite à choisir un mois
                        if ($moisChoisi == "") {
                            ?>
                            <option value="-1">=== Choisir un mois ===</option>
                            <?php
                        }
                        while (is_array($lgMois)) {
                            $mois = $lgMois["mois"];
                            $noMois = intval(substr($mois, 4, 2));
                            $annee = intval(substr($mois, 0, 4));
                            ?>    
                            <option value="<?php echo $mois; ?>"<?php if ($moisChoisi == $mois) { ?> selected="selected"<?php } ?>><?php echo obtenirLibelleMois($noMois) . ' ' . $annee; ?></option>
                            <?php
                            $lgMois = mysql_fetch_assoc($idJeuMois);
                        }
                        mysql_free_result($idJeuMois);
                    }
                    ?>            
                </select>
            </p>        
        </form>
        <?php
    }
// Affiche le form de Gestion de Frais si un utilsaeur et un mois ont été bien choisi
    if ($visiteurChoisi != "" && $moisChoisi != "") {
        
        // Traite des frais si un visiteur et un mois ont été choisis
        $req = obtenirReqEltsForfaitFicheFrais($moisChoisi, $visiteurChoisi);
        $idJeuEltsForfait = mysql_query($req, $idConnexion);
        $lgEltsForfait = mysql_fetch_assoc($idJeuEltsForfait);
        
        while (is_array($lgEltsForfait)) {
            // Affiche les éléments du forfait
            switch ($lgEltsForfait['idFraisForfait']) {
                case "ETP":
                    $etp = $lgEltsForfait['quantite'];
                    break;
                case "KM":
                    $km = $lgEltsForfait['quantite'];
                    break;
                case "NUI":
                    $nui = $lgEltsForfait['quantite'];
                    break;
                case "REP":
                    $rep = $lgEltsForfait['quantite'];
                    break;
            }
            $lgEltsForfait = mysql_fetch_assoc($idJeuEltsForfait);
        }
        //Libére les ressources
        mysql_free_result($idJeuEltsForfait);
        ?>
        
        <?php //Form d'invittation de choix d'actualisation  d'un véhicule s'il y'a lieu ?>
        <form id="formChoixVehicule" method="post" action="">
            <table style="border:none;" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border:none;">
                        <p>
                            <input type="hidden" name="etape" value="actualiserVehicule" />
                            <input type="hidden" name="lstVisiteur" value="<?php echo $visiteurChoisi; ?>" />
                            <input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>" />
                            <label class="titre">Choisir le véhicule :</label>
                            <select name="lstVehicule" id="idLstVehicule" class="zone" onchange="afficheMsgInfosChangerVehicule();">
                                
                                <?php
                                $typeVehicule = obtenirTypeVehicule($idConnexion, $moisChoisi, $visiteurChoisi);
                                // Invite au choix d'une véhicule
                                if (!$typeVehicule) {
                                    ?>
                                    <option value="-1">=== Choisir un type de véhicule ===</option>
                                    <?php
                                }
                                //Propose tous les types de véhicules
                                $req = obtenirReqListeTypesVehicules();
                                $idJeuVehicules = mysql_query($req, $idConnexion);
                                while ($lgVehicule = mysql_fetch_array($idJeuVehicules)) {
                                    ?>
                                    <option value="<?php echo $lgVehicule['id']; ?>"<?php if ($typeVehicule != false and $typeVehicule['id'] == $lgVehicule['id']) { ?> selected="selected"<?php } ?>><?php echo $lgVehicule['libelleType'] . " (" . $lgVehicule['indemniteKm'] . ")"; ?></option>
                                    <?php
                                }
                                //Libére les ressources
                                mysql_free_result($idJeuVehicules);
                                ?>
                            </select>
                        </p>
                    </td>
                    <td style="border:none;">
                        <div id="actionsChoixVehicule" class="actions">
                            <a class="actions" id="lkActualiserTypeVehicule" onclick="actualiserTypeVehicule('<?php echo $typeVehicule['id']; ?>','<?php echo $typeVehicule['libelleType']; ?>');" title="Actualiser le type de véhicule">&nbsp;<img src="images/actualiserIcon.png" class="icon" alt="icone Actualiser" />&nbsp;Actualiser&nbsp;</a>
                            <a class="actions" id="lkReinitialiserTypeVehicule" onclick="reinitialiserTypeVehicule();" title="Réinitialiser le type de véhicule">&nbsp;<img src="images/reinitialiserIcon.png" class="icon" alt="icone Réinitialiser" />&nbsp;Réinitialiser&nbsp;</a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <div id="msgTypeVehicule" class="infosNonActualisees">Attention, la modification doit être actualisée pour être réellement prises en compte...</div>
        <form id="formFraisForfait" method="post" action="">
            <p>
                <input type="hidden" name="etape" value="actualiserFraisForfait" />
                <input type="hidden" name="lstVisiteur" value="<?php echo $visiteurChoisi; ?>" />
                <input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>" />
            </p>
            <div style="clear:left;"><h2>Frais au forfait</h2></div>
            <table style="color:white;" border="1">
                <tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Actions</th></tr>
                <tr align="center">
                    <td style="width:80px;"><input type="text" size="3" id="idREP" name="txtEltsForfait[REP]" value="<?php echo $rep; ?>" style="text-align:right;" onchange="afficheMsgInfosForfaitAActualisees();" /></td>
                    <td style="width:80px;"><input type="text" size="3" id="idNUI" name="txtEltsForfait[NUI]" value="<?php echo $nui; ?>" style="text-align:right;" onchange="afficheMsgInfosForfaitAActualisees();" /></td> 
                    <td style="width:80px;"><input type="text" size="3" id="idETP" name="txtEltsForfait[ETP]" value="<?php echo $etp; ?>" style="text-align:right;" onchange="afficheMsgInfosForfaitAActualisees();" /></td>
                    <td style="width:80px;"><input type="text" size="3" id="idKM" name="txtEltsForfait[KM]" value="<?php echo $km; ?>" style="text-align:right;" onchange="afficheMsgInfosForfaitAActualisees();" /></td>
                    <td>
                        <div id="actionsFraisForfait" class="actions">
                            <a class="actions" id="lkActualiserLigneFraisForfait" onclick="actualiserLigneFraisForfait(<?php echo $rep; ?>,<?php echo $nui; ?>,<?php echo $etp; ?>,<?php echo $km; ?>);" title="Actualiser la ligne de frais forfaitisé">&nbsp;<img src="images/actualiserIcon.png" class="icon" alt="icone Actualiser" />&nbsp;Actualiser&nbsp;</a>
                            <a class="actions" id="lkReinitialiserLigneFraisForfait" onclick="reinitialiserLigneFraisForfait();" title="Réinitialiser la ligne de frais forfaitisé">&nbsp;<img src="images/reinitialiserIcon.png" class="icon" alt="icone Réinitialiser" />&nbsp;Réinitialiser&nbsp;</a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <div id="msgFraisForfait" class="infosNonActualisees">Attention, les modifications doivent être actualisées pour être réellement prises en compte...</div>
        <p class="titre">&nbsp;</p>
        <div style="clear:left;"><h2>Hors forfait</h2></div>
        <?php
        //Récupère les lignes hors forfaits
        
        $req = obtenirReqEltsHorsForfaitFicheFrais($moisChoisi, $visiteurChoisi);
        $idJeuEltsHorsForfait = mysql_query($req, $idConnexion);
        $lgEltsHorsForfait = mysql_fetch_assoc($idJeuEltsHorsForfait);
        while (is_array($lgEltsHorsForfait)) {
            ?>
              <?php //Form d'affichage des éléments horsforfait ?>>
            <form id="formFraisHorsForfait<?php echo $lgEltsHorsForfait['id']; ?>" method="post" action="">
                <p>
                    <input type="hidden" id="idEtape<?php echo $lgEltsHorsForfait['id']; ?>" name="etape" value="actualiserFraisHorsForfait" />
                    <input type="hidden" name="lstVisiteur" value="<?php echo $visiteurChoisi; ?>" />
                    <input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>" />
                    <input type="hidden" name="txtEltsHorsForfait[id]" value="<?php echo $lgEltsHorsForfait['id']; ?>" />
                </p>
                <table style="color:white;" border="1">
                    <tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Actions</th></tr>
                    <?php
                    // Si les frais n'ont pas déjà été refusés, on affiche normalement
                    if (strpos($lgEltsHorsForfait['libelle'], 'REFUSÉ : ') === false) {
                        ?>
                        <tr>
                            <?php
                        }
                        // Sinon on met la ligne en grisée
                        else {
                            ?>
                        <tr style="background-color:gainsboro;">
                            <?php
                        }
                        ?>                          
                        <td style="width:100px;"><input type="text" size="12" id="idDate<?php echo $lgEltsHorsForfait['id']; ?>" name="txtEltsHorsForfait[date]" value="<?php echo convertirDateAnglaisVersFrancais($lgEltsHorsForfait['date']); ?>" onchange="afficheMsgInfosHorsForfaitAActualisees(<?php echo $lgEltsHorsForfait['id']; ?>);" /></td>
                        <td style="width:220px;"><input type="text" size="30" id="idLibelle<?php echo $lgEltsHorsForfait['id']; ?>" name="txtEltsHorsForfait[libelle]" value="<?php echo filtrerChainePourNavig($lgEltsHorsForfait['libelle']); ?>" onchange="afficheMsgInfosHorsForfaitAActualisees(<?php echo $lgEltsHorsForfait['id']; ?>);" /></td> 
                        <td style="width:90px;"><input type="text" size="10" id="idMontant<?php echo $lgEltsHorsForfait['id']; ?>" name="txtEltsHorsForfait[montant]" value="<?php echo $lgEltsHorsForfait['montant']; ?>" style="text-align:right;" onchange="afficheMsgInfosHorsForfaitAActualisees(<?php echo $lgEltsHorsForfait['id']; ?>);" /></td>
                        <td>
                            <div id="actionsFraisHorsForfait<?php echo $lgEltsHorsForfait['id']; ?>" class="actions">
                                <a class="actions" id="lkActualiserLigneFraisHF<?php echo $lgEltsHorsForfait['id']; ?>" onclick="actualiserLigneFraisHF(<?php echo $lgEltsHorsForfait['id']; ?>,'<?php echo convertirDateAnglaisVersFrancais($lgEltsHorsForfait['date']); ?>','<?php echo filtrerChainePourBD($lgEltsHorsForfait['libelle']); ?>',<?php echo $lgEltsHorsForfait['montant']; ?>);" title="Actualiser la ligne de frais hors forfait">&nbsp;<img src="images/actualiserIcon.png" class="icon" alt="icone Actualiser" />&nbsp;Actualiser&nbsp;</a>
                                <a class="actions" id="lkReinitialiserLigneFraisHF<?php echo $lgEltsHorsForfait['id']; ?>" onclick="reinitialiserLigneFraisHorsForfait(<?php echo $lgEltsHorsForfait['id']; ?>);" title="Réinitialiser la ligne de frais hors forfait">&nbsp;<img src="images/reinitialiserIcon.png" class="icon" alt="icone Réinitialiser" />&nbsp;Réinitialiser&nbsp;</a>
                                <?php
                                // L'option "Supprimer" n'est proposée que si les frais n'ont pas déjà été refusés
                                if (strpos($lgEltsHorsForfait['libelle'], 'REFUSÉ : ') === false) {
                                    ?>
                                    <a class="actionsCritiques" onclick="reporterLigneFraisHF(<?php echo $lgEltsHorsForfait['id']; ?>);" title="Reporter la ligne de frais hors forfait">&nbsp;<img src="images/reporterIcon.png" class="icon" alt="icone Reporter" />&nbsp;Reporter&nbsp;</a>
                                    <a class="actionsCritiques" onclick="refuseLigneFraisHF(<?php echo $lgEltsHorsForfait['id']; ?>);" title="Supprimer la ligne de frais hors forfait">&nbsp;<img src="images/refuserIcon.png" class="icon" alt="icone Supprimer" />&nbsp;Supprimer&nbsp;</a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="actionsCritiques" onclick="reintegrerLigneFraisHF(<?php echo $lgEltsHorsForfait['id']; ?>);" title="Réintégrer la ligne de frais hors forfait">&nbsp;<img src="images/reintegrerIcon.png" class="icon" alt="icone Réintégrer" />&nbsp;Réintégrer&nbsp;</a>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <div id="msgFraisHorsForfait<?php echo $lgEltsHorsForfait['id']; ?>" class="infosNonActualisees">Attention, les modifications doivent être actualisées pour être réellement prises en compte...</div>
            <?php
            $lgEltsHorsForfait = mysql_fetch_assoc($idJeuEltsHorsForfait);
        }
        ?>
        <form id="formNbJustificatifs" method="post" action="">
            <p>
                <input type="hidden" name="etape" value="actualiserNbJustificatifs" />
                <input type="hidden" name="lstVisiteur" value="<?php echo $visiteurChoisi; ?>" />
                <input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>" />
            </p>
            <?php // Affichage de la partie justification ?>
             <?php //Form d'affichage des justificatifatifs ?>>
            <div class="titre">Nombre de justificatifs :
                <?php
                $laFicheFrais = obtenirDetailFicheFrais($idConnexion, $moisChoisi, $visiteurChoisi);
                ?>
                <input type="text" class="zone" size="4" id="idNbJustificatifs" name="nbJustificatifs" value="<?php echo $laFicheFrais['nbJustificatifs']; ?>" style="text-align:center;" onchange="afficheMsgNbJustificatifs();" />
                <div id="actionsNbJustificatifs" class="actions">
                    <a class="actions" id="lkActualiserNbJustificatifs" onclick="actualiserNbJustificatifs(<?php echo $laFicheFrais['nbJustificatifs']; ?>);" title="Actualiser le nombre de justificatifs">&nbsp;<img src="images/actualiserIcon.png" class="icon" alt="icone Actualiser" />&nbsp;Actualiser&nbsp;</a>
                    <a class="actions" id="lkReinitialiserNbJustificatifs" onclick="reinitialiserNbJustificatifs();" title="Réinitialiser le nombre de justificatifs">&nbsp;<img src="images/reinitialiserIcon.png" class="icon" alt="icone Réinitialiser" />&nbsp;Réinitialiser&nbsp;</a>
                </div>
            </div>
        </form>
        <div id="msgNbJustificatifs" class="infosNonActualisees">Attention, le nombre de justificatifs doit être actualisé pour être réellement pris en compte...</div>

        <form id="formValidFiche" method="post" action="">
            <p>
                <input type="hidden" name="etape" value="validerFiche" />
                <input type="hidden" name="lstVisiteur" value="<?php echo $visiteurChoisi; ?>" />
                <input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>" />
                <input class="zone" type="button" onclick="changerVisiteur();" value="Changer de visiteur" />
                <input class="zone" type="button" onclick="validerFiche();" value="Valider cette fiche" />
            </p>
        </form>

        <?php
    }
    ?>
</div>
