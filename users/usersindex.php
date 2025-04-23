<script src="./js/usersSCRIPT.js"></script>
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
 *	\file       htdocs/users/index.php
 *	\ingroup    users
 *	\brief      This file is the main entry point for the users module.
 *	\version    $Id$
 */

// Load Dolibarr environment

require_once '../../main.inc.php';

// Load translation files required by the page
$langs->loadLangs(array("users@users")); //users -> gestion des users et @users -> nom du fichier de langue

// Inclure les fichiers nécessaires
require_once __DIR__ . '/core/lib/usersLIB.php';
require_once __DIR__ . '/core/sql/usersSQL.php';
require_once __DIR__ . '/core/class/usersCLASS.php';

$perms = loaduser();
$res = actions($perms);
$name = $res[0];
$tab = $res[1];

llxHeader("", $langs->trans("UsersArea"), '', '', 0, 0, '', '', '', 'mod-users page-index');
print load_fiche_titre($langs->trans("UsersArea"), '', 'users.png@users');

print '<div class="fichecenter"><div class="fichethirdleft">';

$token = newToken();
// Form for creating a user

print '<div id="toggleBar" onClick="toggleForm(this)">Cliquez pour dérouler le formulaire de création
        ';print '
        </div>';

if($perms !=null && isset($perms->admin) && $perms->admin == 1){
    print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'" id="createForm">';
    print '<table id="createTable" class="border" width="100%" style="display:none">';
print '<tr><td colspan="2"><input type="hidden" name="action" value="create"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Sexe").'</td><td><select name="sexe" maxlength="7"><option value="M">M</option><option value="F">F</option></select></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Nom").'</td><td><input type="text" name="nom" maxlength="12" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Prénom").'</td><td><input type="text" name="prenom" maxlength="15" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("nompatronymique").'</td><td><input type="text" name="nompatronymique" maxlength="7" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Adresse").'</td><td><input type="text" name="adresse" maxlength="37" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Adresse2").'</td><td><input type="text" name="adresse2" maxlength="18" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("CP").'</td><td><input type="text" name="cp" maxlength="5" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Mail").'</td><td><input type="email" name="mail" maxlength="32" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Ville").'</td><td><input type="text" name="ville" maxlength="26" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Tel").'</td><td><input type="text" name="tel" maxlength="14" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Tel2").'</td><td><input type="text" name="tel2" maxlength="14" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Portable").'</td><td><input type="text" name="portable" maxlength="14" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Naissance").'</td><td><input type="text" name="naissance" maxlength="24" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("CPNaissance").'</td><td><input type="text" name="cpnaissance" maxlength="5" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("DDN").'</td><td><input type="date" name="ddn" maxlength="10" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Annee").'</td><td><input type="text" name="annee" maxlength="4" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Actif").'</td><td><input type="checkbox" name="actif" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Pupitre").'</td><td><input type="text" name="pupitre" maxlength="2" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("TailleVeste").'</td><td><input type="text" name="tailleveste" maxlength="8" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("TailleChemise").'</td><td><input type="text" name="taillechemise" maxlength="9" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("TaillePantalon").'</td><td><input type="text" name="taillepantalon" maxlength="12" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("TailleGilet").'</td><td><input type="text" name="taillegilet" maxlength="9" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Casquette").'</td><td><input type="text" name="casquette" maxlength="7" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Profession").'</td><td><input type="text" name="profession" maxlength="42" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Musicien").'</td><td><input type="checkbox" name="musicien" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("ConvocationPapier").'</td><td><input type="checkbox" name="convocation_papier" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("ConvocationMail").'</td><td><input type="checkbox" name="convocation_mail" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Commentaires").'</td><td><input type="text" name="commentaires" maxlength="150" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Clairon").'</td><td><input type="checkbox" name="clairon" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Tambour").'</td><td><input type="checkbox" name="tambour" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("MailValide").'</td><td><input type="checkbox" name="mail_valide" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Medaille").'</td><td><input type="text" name="medaille" maxlength="2" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("F1EnvoiTaches").'</td><td><input type="checkbox" name="f1_envoi_taches" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Fic").'</td><td><input type="text" name="fic" maxlength="4" value=""></td></tr>';
print '<input type="hidden" name="token" value="'.$token.'">';
print '</table>';
print '<div class="center">';
print '<input type="submit" class="button" id="createButton" value="'.$langs->trans("CreateUser").'" style="display:none">';
print '</div>';
print '</form>';
}


print '<br>';
print '<br>';
print '<br>';
print '<div id="toggleBar2" onClick="toggleForm(this)">Cliquez pour dérouler le formulaire de modification
        ';print '
        </div>';
if($perms !=null && isset($perms->bureau) && $perms->bureau == 1){
    print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'" id="editForm">';
    print '<table id = "editTable" class="border" width="100%" style="display:none">';
    print '<input type="hidden" name="rowid" value="">';
    print '<tr><td class="flat">'.$langs->trans("Sexe").'</td><td><select name="sexe"><option value="M">M</option><option value="F">F</option></select></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Nom").'</td><td><input type="text" name="nom" value="" maxlengh=12></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Prénom").'</td><td><input type="text" name="prenom" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("nompatronymique").'</td><td><input type="text" name="nompatronymique" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Adresse").'</td><td><input type="text" name="adresse" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Adresse2").'</td><td><input type="text" name="adresse2" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("CP").'</td><td><input type="text" name="cp" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Ville").'</td><td><input type="text" name="ville" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Tel").'</td><td><input type="text" name="tel" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Tel2").'</td><td><input type="text" name="tel2" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Portable").'</td><td><input type="text" name="portable" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Mail").'</td><td><input type="email" name="mail" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Naissance").'</td><td><input type="date" name="naissance" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("CPNaissance").'</td><td><input type="text" name="cpnaissance" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("DDN").'</td><td><input type="date" name="ddn" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Annee").'</td><td><input type="text" name="annee" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Actif").'</td><td><input type="checkbox" name="actif" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Pupitre").'</td><td><input type="text" name="pupitre" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("TailleVeste").'</td><td><input type="text" name="tailleveste" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("TailleChemise").'</td><td><input type="text" name="taillechemise" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("TaillePantalon").'</td><td><input type="text" name="taillepantalon" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("TailleGilet").'</td><td><input type="text" name="taillegilet" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Casquette").'</td><td><input type="text" name="casquette" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Profession").'</td><td><input type="text" name="profession" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Musicien").'</td><td><input type="checkbox" name="musicien" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("ConvocationPapier").'</td><td><input type="checkbox" name="convocation_papier" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("ConvocationMail").'</td><td><input type="checkbox" name="convocation_mail" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Commentaires").'</td><td><input type="text" name="commentaires" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Clairon").'</td><td><input type="checkbox" name="clairon" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Tambour").'</td><td><input type="checkbox" name="tambour" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("MailValide").'</td><td><input type="checkbox" name="mail_valide" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Medaille").'</td><td><input type="text" name="medaille" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("F1EnvoiTaches").'</td><td><input type="checkbox" name="f1_envoi_taches" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Fic").'</td><td><input type="text" name="fic" value=""></td></tr>';
    print '<tr><td colspan="2"><input type="hidden" name="action" value="edit"></td></tr>';
    print '<tr><td colspan="2"><input type="hidden" name="id" value=""></td></tr>';
    print '<input type="hidden" name="token" value="'.$token.'">';
    print '</table>';
    print '<div class="center">';
    print '<input type="submit" class="button" id="editButton"  value="'.$langs->trans("EditUser").'" style="display:none">';
    print '</div>';
    print '</form>';
}

print '<br>';
print '<br>';
print '<br>';
print '<div id="toggleBar3" onClick="toggleForm(this)">Cliquez pour dérouler le formulaire de suppression
        ';print '
        </div>';
if ($perms != null && isset($perms->admin) && $perms->admin == 1) {
    print '<form id="deleteForm" method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    print '<table id="deleteTable" class="border" width="100%" style="display:none">';
    print '<tr><td class="flat">'.$langs->trans("Nom").'</td><td><input type="text" name="nom" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Prénom").'</td><td><input type="text" name="prenom" value=""></td></tr>';
    print '</table>';
    print '<input type="hidden" name="action" value="delete">';
    print '<input type="hidden" name="id" value="">';
    print '<div class="center">';
    print '<input type="submit" class="button" id="deleteButton"  value="'.$langs->trans("DeleteUser").'" style="display:none">';
    print '</div>';
    print '<input type="hidden" name="token" value="'.$token.'">';
    print '</form>';
}

print '<br>';
print ' <iframe id="tableFrame" width="100%" height="400">
    </iframe>';

print '<br>';
print '<br>';

print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="name" value="' . $name.'">';
print '<input type="hidden" name="action" value="show">';
print '<div class="center"><input type="submit" class="button" value="'.$name.'"></div>';
print '<input type="hidden" name="token" value="'.$token.'">';
print '</form>';

llxFooter();
?>
<script>
    loadTable(<?php echo json_encode($tab); ?>);
</script>

   