<?php
/** 
 *@author Aly BA <aly.ba2009@gmail.com>
 * @todo script d'initialisation de l'application et de pages importennt de maniére unique
 * les scritps  _bdGestionDonnees.lib.php" gestionSession.lib.php" 
 *  _utilitairesEtGestionErreurs.lib.php"
 */
  require("_bdGestionDonnees.lib.php");
  require("_gestionSession.lib.php");
  require("_utilitairesEtGestionErreurs.lib.php");
  // Démarrage ou Reprise de la session
  initSession();
  // Etat initiale, aucune erreur ...
  $tabErreurs = array();
    
  // Demande-t-on une déconnexion ?
  $demandeDeconnexion = lireDonneeUrl("cmdDeconnecter");
  if ( $demandeDeconnexion == "on") {
      deconnecterUtilisateur() ;
      header("Location: cAccueil.php");
  }
    
  // Etablissement d'une connexion avec le serveur de données 
  //Sélection de la base de donnée
  $idConnexion=connecterServeurBD();
  if (!$idConnexion) {
      ajouterErreur($tabErreurs, "Echec de la connexion au serveur MySql");
  }
  elseif (!activerBD($idConnexion)) {
      ajouterErreur($tabErreurs, "La base de données gsb_frais est inexistante ou non accessible");
  }
  
?>