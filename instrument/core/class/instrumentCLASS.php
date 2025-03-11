<?php
require_once __DIR__ .'/../../../../main.inc.php';
require_once __DIR__ . '/../sql/instrumentSQL.php';
require_once __DIR__ . '/../lib/instrumentLIB.php';
function remove_accents($string) {
    $utf8_string = html_entity_decode($string, ENT_COMPAT, 'UTF-8');
    //$utf8_string = iconv('UTF-8', 'ASCII//TRANSLIT', $utf8_string);
    return $utf8_string;
}
function actions($perms){
    global $langs;
    $perso = GETPOST("perso", "none");
    $num_membre = dol_escape_htmltag(GETPOST("num_membre", "alphanohtml"));
    $num_type_instrument = GETPOST("num_type_instrument", "none");
    $membre = dol_escape_htmltag(GETPOST("membre", "alphanohtml"));
    $num_serie = dol_escape_htmltag(GETPOST("num_serie", "alphanohtml"));
    $marque = dol_escape_htmltag(GETPOST("marque", "alphanohtml"));
    $proprietaire = dol_escape_htmltag(GETPOST("proprietaire", "alphanohtml"));
    $reference = dol_escape_htmltag(GETPOST("reference", "alphanohtml"));
    $remarques = dol_escape_htmltag(GETPOST("remarques", "alphanohtml"));
    // Remove accents from parameters
    $perso = remove_accents($perso);
    $num_membre = remove_accents($num_membre);
    $num_type_instrument = remove_accents($num_type_instrument);
    $membre = remove_accents($membre);
    $num_serie = remove_accents($num_serie);
    $marque = remove_accents($marque);
    $proprietaire = remove_accents($proprietaire);
    $reference = remove_accents($reference);
    $remarques = remove_accents($remarques);
    

   
    
    $rowid = dol_escape_htmltag(GETPOST("id", "int"));
    $name = dol_escape_htmltag(GETPOST("name", "alphanohtml"));
    $action = dol_escape_htmltag(GETPOST("action", "alphanohtml"));
    
    if($name == '') $name = $langs->trans("HideUser");
    $name = $name == $langs->trans("ShowInstrument") ? $langs->trans("HideInstrument") : $langs->trans("ShowInstrument");
    $tab = '';
    if(!empty($action)){
        if ($action == 'create' && isset($perms->admin) && $perms->admin == 1) {
            createInstrument($rowid, $perso, $num_membre, $num_type_instrument, $membre, $num_serie, $marque, $proprietaire, $reference, $remarques);
        }
         else if ($action == 'show' && $name == $langs->trans("HideInstrument")) {
            $tab = make_show_tab();
        }
        else if ($action == 'edit'&& isset($perms->bureau) && $perms->bureau == 1) {
            editInstrument($rowid, $perso, $num_membre, $num_type_instrument, $membre, $num_serie, $marque, $proprietaire, $reference, $remarques);
        }
        else if ($action == 'delete' && isset($perms->admin) && $perms->admin == 1) {
            deleteInstrument($rowid);
        }
    }
    else{
        return [$name, []];
    }
    return [$name, $tab];
    }
?>