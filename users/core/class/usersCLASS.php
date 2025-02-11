<?php
require_once __DIR__ .'/../../../../main.inc.php';

require_once __DIR__ . '/../lib/usersLIB.php';

function actions($perms){
    global $langs;
    $sexe = dol_escape_htmltag(GETPOST("sexe", "alpha"));
    $nom = dol_escape_htmltag(GETPOST("nom", "alpha"));
    $prenom = dol_escape_htmltag(GETPOST("prenom", "alpha"));
    $nompatronymique = dol_escape_htmltag(GETPOST("nompatronymique", "alpha"));
    $Adresse = dol_escape_htmltag(GETPOST("Adresse", "alpha"));
    $Adresse2 = dol_escape_htmltag(GETPOST("Adresse2", "alpha"));
    $CP = dol_escape_htmltag(GETPOST("CP", "alpha"));
    $ville = dol_escape_htmltag(GETPOST("ville", "alpha"));
    $tel = dol_escape_htmltag(GETPOST("tel", "alpha"));
    $tel2 = dol_escape_htmltag(GETPOST("tel2", "alpha"));
    $portable = dol_escape_htmltag(GETPOST("portable", "alpha"));
    $Mail = dol_escape_htmltag(GETPOST("Mail", "email"));
    $naissance = dol_escape_htmltag(GETPOST("naissance", "alpha"));
    $CPnaissance = dol_escape_htmltag(GETPOST("CPnaissance", "alpha"));
    $ddn = dol_escape_htmltag(GETPOST("ddn", "alpha"));
    $annee = dol_escape_htmltag(GETPOST("annee", "alpha"));
    $Actif = dol_escape_htmltag(GETPOST("Actif", "alpha"));
    $Pupitre = dol_escape_htmltag(GETPOST("Pupitre", "alpha"));
    $TailleVeste = dol_escape_htmltag(GETPOST("TailleVeste", "alpha"));
    $TailleChemise = dol_escape_htmltag(GETPOST("TailleChemise", "alpha"));
    $TaillePantalon = dol_escape_htmltag(GETPOST("TaillePantalon", "alpha"));
    $TailleGilet = dol_escape_htmltag(GETPOST("TailleGilet", "alpha"));
    $Casquette = dol_escape_htmltag(GETPOST("Casquette", "alpha"));
    $Profession = dol_escape_htmltag(GETPOST("Profession", "alpha"));
    $Musicien = dol_escape_htmltag(GETPOST("Musicien", "alpha"));
    $Convocation_Papier = dol_escape_htmltag(GETPOST("Convocation_Papier", "alpha"));
    $Convocation_Mail = dol_escape_htmltag(GETPOST("Convocation_Mail", "alpha"));
    $Commentaires = dol_escape_htmltag(GETPOST("Commentaires", "alpha"));
    $Clairon = dol_escape_htmltag(GETPOST("Clairon", "alpha"));
    $Tambour = dol_escape_htmltag(GETPOST("Tambour", "alpha"));
    $Mail_valide = dol_escape_htmltag(GETPOST("Mail_valide", "alpha"));
    $medaille = dol_escape_htmltag(GETPOST("medaille", "alpha"));
    $F1_envoi_taches = dol_escape_htmltag(GETPOST("F1_envoi_taches", "alpha"));
    $fic = dol_escape_htmltag(GETPOST("fic", "alpha"));
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
    return [$name, $tab];
    }
?>