<?php
require_once __DIR__ . '/../sql/instrumentSQL.php';

try {
    $external_db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpassword);
    $external_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $external_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
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
    $results = showInstrument();
    if (count($results) > 0) { // si au moins 1 membre
        $show = '<table id="dataTable" class="border" width="10" height="10">';
        $show .= '<tr class=liste_titre>
                <th>ID</th>
                <th>Perso</th>
                <th>N° Membre</th>
                <th>Type Instrument</th>
                <th>Membre</th>
                <th>N° Série</th>
                <th>Marque</th>
                <th>Propriétaire</th>
                <th>Référence</th>
                <th>Remarques</th>
                </tr>';
           
        $type = "impair";
        
        foreach ($results as $obj) { //  affichage des résultats
            if(!empty($obj)){
                $type = ($type == 'pair') ? 'impair' : 'pair';
                $show .= '<tr class='.$type.' onClick="updateClick(this)">';
                $show .= '<td>' . htmlspecialchars($obj["ID"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["perso"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["N°membre"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["type_instrument"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["membre"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["N°série"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["marque"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["propriétaire"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Référence"]) . '</td>';
                $show .= '<td>' . htmlspecialchars($obj["Remarques"]) . '</td>';
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