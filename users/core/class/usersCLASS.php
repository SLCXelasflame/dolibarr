<?php
require_once __DIR__ .'/../../../../main.inc.php';

require_once __DIR__ . '/../lib/usersLIB.php';
function remove_accents($string) {
    $utf8_string = html_entity_decode($string, ENT_COMPAT, 'UTF-8');
    //$utf8_string = iconv('UTF-8', 'ASCII//TRANSLIT', $utf8_string);
    return $utf8_string;
}
function actions($perms){
    global $langs;
    $sexe = remove_accents(dol_escape_htmltag(GETPOST("sexe", "alpha")));
    $nom = remove_accents(dol_escape_htmltag(GETPOST("nom", "alpha")));
    $prenom = remove_accents(dol_escape_htmltag(GETPOST("prenom", "alpha")));
    $nompatronymique = remove_accents(dol_escape_htmltag(GETPOST("nompatronymique", "alpha")));
    $Adresse = remove_accents(dol_escape_htmltag(GETPOST("Adresse", "alpha")));
    $Adresse2 = remove_accents(dol_escape_htmltag(GETPOST("Adresse2", "alpha")));
    $CP = remove_accents(dol_escape_htmltag(GETPOST("CP", "alpha")));
    $ville = remove_accents(dol_escape_htmltag(GETPOST("ville", "alpha")));
    $tel = remove_accents(dol_escape_htmltag(GETPOST("tel", "alpha")));
    $tel2 = remove_accents(dol_escape_htmltag(GETPOST("tel2", "alpha")));
    $portable = remove_accents(dol_escape_htmltag(GETPOST("portable", "alpha")));
    $Mail = dol_escape_htmltag(GETPOST("Mail", "email"));
    $naissance = remove_accents(dol_escape_htmltag(GETPOST("naissance", "alpha")));
    $CPnaissance = remove_accents(dol_escape_htmltag(GETPOST("CPnaissance", "alpha")));
    $ddn = remove_accents(dol_escape_htmltag(GETPOST("ddn", "alpha")));
    $annee = remove_accents(dol_escape_htmltag(GETPOST("annee", "alpha")));
    $Actif = remove_accents(dol_escape_htmltag(GETPOST("Actif", "alpha")));
    $Pupitre = remove_accents(dol_escape_htmltag(GETPOST("Pupitre", "alpha")));
    $TailleVeste = remove_accents(dol_escape_htmltag(GETPOST("TailleVeste", "alpha")));
    $TailleChemise = remove_accents(dol_escape_htmltag(GETPOST("TailleChemise", "alpha")));
    $TaillePantalon = remove_accents(dol_escape_htmltag(GETPOST("TaillePantalon", "alpha")));
    $TailleGilet = remove_accents(dol_escape_htmltag(GETPOST("TailleGilet", "alpha")));
    $Casquette = remove_accents(dol_escape_htmltag(GETPOST("Casquette", "alpha")));
    $Profession = remove_accents(dol_escape_htmltag(GETPOST("Profession", "alpha")));
    $Musicien = remove_accents(dol_escape_htmltag(GETPOST("Musicien", "alpha")));
    $Convocation_Papier = remove_accents(dol_escape_htmltag(GETPOST("Convocation_Papier", "alpha")));
    $Convocation_Mail = remove_accents(dol_escape_htmltag(GETPOST("Convocation_Mail", "alpha")));
    $Commentaires = remove_accents(dol_escape_htmltag(GETPOST("Commentaires", "alpha")));
    $Clairon = remove_accents(dol_escape_htmltag(GETPOST("Clairon", "alpha")));
    $Tambour = remove_accents(dol_escape_htmltag(GETPOST("Tambour", "alpha")));
    $Mail_valide = remove_accents(dol_escape_htmltag(GETPOST("Mail_valide", "alpha")));
    $medaille = remove_accents(dol_escape_htmltag(GETPOST("medaille", "alpha")));
    $F1_envoi_taches = remove_accents(dol_escape_htmltag(GETPOST("F1_envoi_taches", "alpha")));
    $fic = remove_accents(dol_escape_htmltag(GETPOST("fic", "alpha")));
    $rowid = dol_escape_htmltag(GETPOST("id", "int"));


    $name = dol_escape_htmltag(GETPOST("name", "alpha"));
    $action = dol_escape_htmltag(GETPOST("action", "alpha"));

    if($name == '') $name = $langs->trans("HideUser");
    $name = $name == $langs->trans("ShowUser") ? $langs->trans("HideUser") : $langs->trans("ShowUser");
    $tab = '';
    if(!empty($action)){
        if ($action == 'create' && isset($perms->admin) && $perms->admin == 1) {
            createUser($sexe, $nom, $prenom, $nompatronymique, $Adresse, $Adresse2, $CP, $ville, $tel, $tel2, $portable, $Mail, $naissance, $CPnaissance, $ddn, $annee, $Actif, $Pupitre, $TailleVeste, $TailleChemise, $TaillePantalon, $TailleGilet, $Casquette, $Profession, $Musicien, $Convocation_Papier, $Convocation_Mail, $Commentaires, $Clairon, $Tambour, $Mail_valide, $medaille, $F1_envoi_taches, $fic);
        }
         else if ($action == 'show' && $name == $langs->trans("HideUser")) {
            $tab = make_show_tab();
        }
        else if ($action == 'edit'&& isset($perms->bureau) && $perms->bureau == 1) {
            editUser($sexe, $nom, $prenom, $nompatronymique, $Adresse, $Adresse2, $CP, $ville, $tel, $tel2, $portable, $Mail, $naissance, $CPnaissance, $ddn, $annee, $Actif, $Pupitre, $TailleVeste, $TailleChemise, $TaillePantalon, $TailleGilet, $Casquette, $Profession, $Musicien, $Convocation_Papier, $Convocation_Mail, $Commentaires, $Clairon, $Tambour, $Mail_valide, $medaille, $F1_envoi_taches, $fic, $rowid);
        }
        else if ($action == 'delete' && isset($perms->admin) && $perms->admin == 1) {
            deleteUser($rowid);
        }
    }
    else{
        return [$name, []];
    }
    return [$name, $tab];
    }
?>