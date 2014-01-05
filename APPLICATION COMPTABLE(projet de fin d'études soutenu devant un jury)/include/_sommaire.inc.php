<?php
/** 
 * @author Aly BA <aly.ba2009@gmail.com>
 * Assure la transition et le transfert des utilsateur suivant leur categorie 
 * ou groupe à lequel il appartient
 * Contient la division pour le sommaire
 * @todo  RAS rien à signaler spécialement à part transiter les types d'utlisateur
 */

?>
    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    <?php
    
      /**
       *Si utilisateur connecté
       * On recupere son nom, prenom, et son type: groupe d'appartenance
       */
      if (estUtilisateurConnecte() ) {
          $idUser = obtenirIdUserConnecte() ;
          $lgUser = obtenirDetailUtilisateur($idConnexion, $idUser);
          $nom = $lgUser['nom'];
          $prenom = $lgUser['prenom'];
          $libelleType = $lgUser['libelleType'];
    ?>
        <h2>
    <?php  
            echo $nom . " " . $prenom ;
    ?>
        </h2>
        <h3>
    <?php
            echo $libelleType ;
    ?>
        </h3>        
    <?php
       }
    ?>  
      </div>  
<?php      
  if (estUtilisateurConnecte() ) {
?>
        <ul id="menuList">
           <li class="smenu">
              <a href="cAccueil.php" title="Page d'accueil">Accueil</a>
           </li>
           <li class="smenu">
              <a href="cSeDeconnecter.php" title="Se déconnecter">Se déconnecter</a>
           </li>
    <?php
     //Affiche les applications dont le visiteur a accés
      if ($libelleType == "Visiteur médical") {
    ?>
           <li class="smenu">
              <a href="cSaisieFicheFrais.php" title="Saisie fiche de frais du mois courant">Saisie fiche de frais</a>
           </li>
           <li class="smenu">
              <a href="cConsultFichesFrais.php" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
           </li>
    <?php
      }
      //Affiche les applications dont le comptable a accés
      if ($libelleType == "Comptable") {
    ?>
           <li class="smenu">
               <a href="cValidFichesFrais.php" title="Validation des fiches de frais du mois précédent">Validation des fiches de frais</a>
           </li>
           <li class="smenu">
               <a href="cMisePaiementFichesFrais.php" title="Suivre le paiment des fiches de frais du mois précédent">Suivre le paiement des fiches de frais</a>
           </li>
    <?php
      }
    ?>
         </ul>
        <?php
          // Affiche  erreurs déjà détectées
          if ( nbErreurs($tabErreurs) > 0 ) {
              echo toStringErreurs($tabErreurs) ;
          }
  }
        ?>
    </div>
    