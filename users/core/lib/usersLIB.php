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
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Birthday</th>
                </tr>';
           
    $type = "impair";
    foreach ($results as $obj) { //  affichage des résultats
        if(!empty($obj)){
            $type = ($type == 'pair') ? 'impair' : 'pair';
            $show .= '<tr class='.$type.' onClick="updateClick(this)">';
            $show .= '<td>' . htmlspecialchars($obj["rowid"]) . '</td>';
            $show .= '<td>' . htmlspecialchars($obj["firstname"]) . '</td>';
            $show .= '<td>' . htmlspecialchars($obj["lastname"]) . '</td>';
            $show .= '<td>' . htmlspecialchars($obj["mail"]) . '</td>';
            $show .= '<td>' . htmlspecialchars($obj["birthday"]) . '</td>';
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