<?php
require_once __DIR__ . '/../sql/usersSQL.php';

try {
    $external_db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpassword);
    $external_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base externe : " . $e->getMessage());
}

function loaduser(){
    global $user;
    $socid = GETPOST('socid', 'int');
    if (true || (isset($user->socid) && $user->socid > 0 && !empty($user->admin))) {
        $action = '';
        $socid = $user->socid;
    } else {
        accessforbidden();
    }

    if(isset($user->rights->users)){
        $perms = $user->rights->users->users;
    }
    else{
        $perms = null;
    }
    return $perms;
}




function make_show_tab(){
    $results = showUser();
    if (count($results) > 0) { // si au moins 1 membre
        $show = '<table class="border" width="100%">';
        $show .= '<tr class=liste_titre>
                <th>Id</th>
                <th>Sexe</th>
                <th>Titre</th>
                <th>NP</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nom Patronyme</th>
                <th>Adresse</th>
                <th>Adresse2</th>
                <th>CP</th>
                <th>Ville</th>
                <th>Tél</th>
                <th>Tél2</th>
                <th>Portable</th>
                <th>Email</th>
                <th>Naissance</th>
                <th>CP Naissance</th>
                <th>DDN</th>
                <th>Année</th>
                <th>Actif</th>
                <th>Pupitre</th>
                <th>Taille Veste</th>
                <th>Taille Chemise</th>
                <th>Taille Pantalon</th>
                <th>Taille Gilet</th>
                <th>Casquette</th>
                <th>Profession</th>
                <th>Musicien</th>
                <th>Convocation Papier</th>
                <th>Convocation Mail</th>
                <th>Commentaires</th>
                <th>Clairon</th>
                <th>Tambour</th>
                <th>Mail Valide</th>
                <th>Médaille</th>
                <th>F1 Envoi Tâches</th>
                <th>FIC</th>
                </tr>';
           
        $type = "impair";
        
        foreach ($results as $obj) { //  affichage des résultats
            if(!empty($obj)){
                $type = ($type == 'pair') ? 'impair' : 'pair';
                $show .= '<tr class='.$type.' onClick="updateClick(this)">';
                $show .= '<td>' . htmlspecialchars($obj["ID"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["sexe"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["titre"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["np"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["nom"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["prénom"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["nompatronymique"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Adresse"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Adresse2"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["CP"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["ville"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["tél"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["tél2"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["portable"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Mail"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["naissance"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["CPnaissance"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["ddn"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["année"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Actif"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Pupitre"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["TailleVeste"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["TailleChemise"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["TaillePantalon"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["TailleGilet"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Casquette"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Profession"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Musicien"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Convocation_Papier"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Convocation_Mail"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Commentaires"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Clairon"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Tambour"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Mail_valide"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["médaille"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["F1_envoi_tâches"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["fic"]) . '</td>';
                $show .= '</tr>';
            }
        }
             
        $show .= '</table>';
    } else { // sinon 0 membres
        $show = "No users found in the database.";
    }
    return $show;
}



?>