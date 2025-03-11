<script src="./js/instrumentSCRIPT.js"></script>
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
require_once __DIR__ . '/core/lib/instrumentLIB.php';
require_once __DIR__ . '/core/sql/instrumentSQL.php';
require_once __DIR__ . '/core/class/instrumentCLASS.php';

$perms = loaduser();
$res = actions($perms);
$name = $res[0];
$tab = $res[1];
llxHeader("", $langs->trans("UsersArea"), '', '', 0, 0, '', '', '', 'mod-users page-index');

print load_fiche_titre($langs->trans("UsersArea"), '', 'users.png@users');

print '<div class="fichecenter"><div class="fichethirdleft">';

$token = newToken();
// Form for creating a user
$types = array_slice(getInstrumentTypes(), 1);

print '<div id="toggleBar" onClick="toggleForm(this)">Cliquez pour dérouler le formulaire de création
        </div>';

if($perms !=null && isset($perms->admin) && $perms->admin == 1){
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'" id="createForm">';
print '<table id="createTable" class="border" width="100%" style="display:none">';
print '<tr><td colspan="2"><input type="hidden" name="action" value="create"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Perso").'</td><td><input type="checkbox" name="perso" value="1"></td></tr>';
print '<tr><td class="flat">'.$langs->trans("N°membre").'</td><td><input type="text" name="num_member" maxlength="3" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("N°Type_instrument").'</td><td><select name="num_type_instrument">';
foreach ($types as $type) {
    print '<option value="'.$type['num'].'">'.$type['num'].' - '.$type['type_instrument'].'</option>';
}
print '<tr><td class="flat">'.$langs->trans("Membre").'</td><td><input type="text" name="membre" maxlength="28" value=""></td></tr>';
print '</select></td></tr>';print '<tr><td class="flat">'.$langs->trans("Membre").'</td><td><input type="text" name="membre" maxlength="23" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("N°série").'</td><td><input type="text" name="num_serie" maxlength="21" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Marque").'</td><td><input type="text" name="marque" maxlength="31" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Propriétaire").'</td><td><input type="text" name="proprietaire" maxlength="10" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Référence").'</td><td><input type="text" name="reference" maxlength="23" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Remarques").'</td><td><input type="text" name="remarques" maxlength="44" value=""></td></tr>';
print '<input type="hidden" name="token" value="'.$token.'">';
print '</table>';
print '<div class="center">';
print '<input id="createButton" type="submit" class="button" value="'.$langs->trans("CreateInstrument").'" style="display:none">';
print '</div>';
print '</form>';
}

print '<br>';
print '<br>';
print '<br>';
print '<div id="toggleBar2" onClick="toggleForm(this)">Cliquez pour dérouler le formulaire de modification
        </div>';

if($perms !=null && isset($perms->bureau) && $perms->bureau == 1){
    print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'" id="editForm">';
    print '<table id = "editTable" class="border" width="100%" style="display:none">';
    print '<tr><td colspan="2"><input type="hidden" name="action" value="edit"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Perso").'</td><td><input type="checkbox" name="perso" value="1"></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("N°membre").'</td><td><input type="text" name="num_membre" maxlength="3" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("N°Type_instrument").'</td><td><select name="num_type_instrument">';
    foreach ($types as $type) {
        print '<option value="'.$type['num'].'">'.$type['num'].' - '.$type['type_instrument'].'</option>';
    }
    print '</select></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Membre").'</td><td><input type="text" name="membre" maxlength="28" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("N°série").'</td><td><input type="text" name="num_serie" maxlength="21" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Marque").'</td><td><input type="text" name="marque" maxlength="31" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Propriétaire").'</td><td><input type="text" name="proprietaire" maxlength="10" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Référence").'</td><td><input type="text" name="reference" maxlength="23" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("Remarques").'</td><td><input type="text" name="remarques" maxlength="44" value=""></td></tr>';
    print '<input type="hidden" name="id" value="">';

    print '<input type="hidden" name="token" value="'.$token.'">';
    print '</table>';
    print '<div class="center">';
    print '<input id="editButton" type="submit" class="button" value="'.$langs->trans("EditInstrument").'" style="display:none">';
    print '</div>';
    print '</form>';
}

print '<br>';
print '<br>';
print '<br>';
print '<div id="toggleBar3" onClick="toggleForm(this)">Cliquez pour dérouler le formulaire de suppression</div>';
if ($perms != null && isset($perms->admin) && $perms->admin == 1) {
    print '<form id="deleteForm" method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    print '<table id="deleteTable" class="border" width="100%" style="display:none">';
    print '<tr><td class="flat">'.$langs->trans("Membre").'</td><td><input type="text" name="membre" maxlength="23" value=""></td></tr>';
    print '<tr><td class="flat">'.$langs->trans("N°série").'</td><td><input type="text" name="num_serie" maxlength="21" value=""></td></tr>';
    print '</table>';
    print '<input type="hidden" name="action" value="delete">';
    print '<input type="hidden" name="id" value="">';
    print '<div class="center">';
    print '<input id="deleteButton" type="submit" class="button" value="'.$langs->trans("DeleteInstrument").'" style="display:none">';
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

   
