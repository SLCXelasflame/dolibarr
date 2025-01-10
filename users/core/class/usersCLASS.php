<?php
require_once __DIR__ .'/../../../../main.inc.php';

require_once __DIR__ . '/../lib/usersLIB.php';

function actions($perms){
    global $langs;
    $rowid = dol_escape_htmltag(GETPOST("rowid", "int"));
    $action = dol_escape_htmltag(GETPOST("action", "alpha"));
    $birthday = dol_escape_htmltag(GETPOST("birthday", "alpha"));
    $firstname = dol_escape_htmltag(GETPOST("firstname", "alpha"));
    $lastname = dol_escape_htmltag(GETPOST("lastname", "alpha"));
    $mail = dol_escape_htmltag(GETPOST("mail", "email"));
    $name = dol_escape_htmltag(GETPOST("name", "alpha"));
    
    if($name == '') $name = $langs->trans("HideUser");
    $name = $name == $langs->trans("ShowUser") ? $langs->trans("HideUser") : $langs->trans("ShowUser");
    $tab = '';
    if(!empty($action)){
        if ($action == 'create'&& isset($perms->admin) && $perms->admin == 1) {
            createUser($firstname, $lastname, $mail, $birthday);
        } else if ($action == 'show' && $name == $langs->trans("HideUser")) {
            $tab = make_show_tab();
        }
        else if ($action == 'edit'&& isset($perms->bureau) && $perms->bureau == 1) {
            editUser($rowid, $firstname, $lastname, $mail, $birthday);
        }
    }
    return [$name, $tab];
    }
?>