<?php
/** 
 * @author Aly
 * Page d'accueil de l'application web AppliFrais
 * @package default
 * @todo  RAS
 */
  //charge le dossier include qui contient bon nombre de controleur coté serveur
  $repInclude = './include/';
  require($repInclude . "_init.inc.php");

  // page execssible uniquement pour un utisalisateur valide dans la BDD
  if ( !estUtilisateurConnecte() ) 
  {
        header("Location: cSeConnecter.php");  
  }
  // charge de le  dosier include pour l'utilisation de l'entpete et du sommaire
  require($repInclude . "_entete.inc.html");
  require($repInclude . "_sommaire.inc.php");
?>
  <!-- Division principale -->
  <div id="contenu">
      <h2>Bienvenue sur l'Application Gestion des frais  de GSB</h2>
  </div>
<?php 
  //charge le dossier include pour l'utilisation du footer
  require($repInclude . "_pied.inc.html");
  require($repInclude . "_fin.inc.php");
?>
