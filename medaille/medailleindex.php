<script src="./js/medailleSCRIPT.js"></script>
<style>
    .table-container {
    width: 50%; /* Largeur du conteneur */
    max-height: 400px; /* Hauteur maximale du conteneur */
    overflow: auto; /* Active le défilement */
    border: 1px solid #ccc; /* Bordure pour le conteneur */
}
</style>
<?php
/**
 *	\file       htdocs/medaille/index.php
 *	\ingroup    medaille
 *	\brief      This file is the main entry point for the users module.
 *	\version    $Id$
 */

// Load Dolibarr environment

require_once '../../main.inc.php';

// Load translation files required by the page
$langs->loadLangs(array("users@users")); //users -> gestion des users et @users -> nom du fichier de langue

// Inclure les fichiers nécessaires
require_once __DIR__ . '/core/lib/medailleLIB.php';
require_once __DIR__ . '/core/sql/medailleSQL.php';
require_once __DIR__ . '/core/class/medailleCLASS.php';

$perms = loaduser();


llxHeader("", $langs->trans("MedailleArea"), '', '', 0, 0, '', '', '', 'mod-users page-index');
print load_fiche_titre($langs->trans("MedailleArea"), '', 'users.png@users');


$token = newToken();

afficherMedailleMembre();


?>

<?php llxFooter();
?>
   