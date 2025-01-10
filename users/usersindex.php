<script src="./js/usersSCRIPT.js"></script>

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


// Form for creating a user
if($perms !=null && isset($perms->admin) && $perms->admin == 1){
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<table class="border" width="100%">';
print '<tr><td class="flat">'.$langs->trans("Firstname").'</td><td><input type="text" name="firstname" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Lastname").'</td><td><input type="text" name="lastname" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Email").'</td><td><input type="email" name="mail" value=""></td></tr>';
print '<tr><td class="flat">'.$langs->trans("Birthday").'</td><td><input type="date" name="birthday" value=""></td></tr>';
print '<tr><td colspan="2"><input type="hidden" name="action" value="create"></td></tr>';
print '</table>';
print '<div class="center">';
print '<input type="submit" class="button" value="'.$langs->trans("CreateUser").'">';
print '</div>';
print '</form>';
}



print '<br>';
print '<br>';
print '<br>';
if($perms !=null && isset($perms->bureau) && $perms->bureau == 1){
    print '<form id="editForm" method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    print '<table class="border" width="100%">';
    print '<input type="hidden" name="rowid" value="">';
    print '<tr><td class="flat">'.$langs->trans("Firstname").'</td><td><input type="text" name="firstname" value=""></td></tr><br>';
    print '<tr><td class="flat">'.$langs->trans("Lastname").'</td><td><input type="text" name="lastname" value=""></td></tr><br>';
    print '<tr><td class="flat">'.$langs->trans("Email").'</td><td><input type="email" name="mail" value=""></td></tr><br>';
    print '<tr><td class="flat">'.$langs->trans("Birthday").'</td><td><input type="date" name="birthday" value=""></td></tr><br>';
    print '<tr><td colspan="2"><input type="hidden" name="action" value="edit"></td></tr>';
    print '<tr><td colspan="2"><input type="hidden" name="id" value=""></td></tr>';
    print '</table>';
    print '<div class="center">';
    print '<input type="submit" class="button" value="'.$langs->trans("EditUser").'">';
    print '</div>';
    print '</form>';
    }

    print '<br>';
    print '<br>';
print '<br>';
print $tab;
print '<br>';
print '<br>';

print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="name" value="' . $name.'">';
print '<input type="hidden" name="action" value="show">';
print '<div class="center"><input type="submit" class="button" value="'.$name.'"></div>';
print '</form>';



llxFooter();
?>
