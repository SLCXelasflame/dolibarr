<?php



$host = 'localhost';
$dbname = 'harmonie';
$dbuser = 'dolibarruser';
$dbpassword = 'dolibarr';
global $external_db;
global $db;

function loadMedailles() {
    global $external_db, $action, $sql_show_member;

    try {
        $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/getmedaille.sql'));
        $stmt->execute();
        $medaille = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($medaille) {
            return $medaille; // Retourne le tableau des utilisateurs
        } else {
            setEventMessage("No users found.", 'warnings');
            return [];
        }
        
    } catch (PDOException $e) {
        setEventMessage("Database error: ".htmlspecialchars($e->getMessage()), 'errors');
        return [];
    } finally {
        $action = '';
    }
}

function getanneeMembres() {
    global $external_db, $action, $sql_show_member;

    try {
        $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/getmembres.sql'));
        $stmt->execute();
        $medaille = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($medaille) {
            return $medaille; // Retourne le tableau des utilisateurs
        } else {
            setEventMessage("No users found.", 'warnings');
            return [];
        }
        
    } catch (PDOException $e) {
        setEventMessage("Database error: ".htmlspecialchars($e->getMessage()), 'errors');
        return [];
    } finally {
        $action = '';
    }
}

function calculerAnnee($date_debut, $date_fin) {
    // Si la date de fin est nulle, on prend aujourd'hui +1 an
    if ($date_fin == null) {
        $date_fin = (new DateTime())->modify('+1 year')->format('Y');
    } else {
        $date_fin = DateTime::createFromFormat('d/m/Y', $date_fin)->format('Y');
    }

    // Si la date de début est nulle, on prend aujourd'hui
    if ($date_debut == null) {
        $date_debut = (new DateTime())->format('Y');
    } else {
        $date_debut = DateTime::createFromFormat('d/m/Y', $date_debut)->format('Y');
    }

    // Sécurité : on vérifie que les objets ont été bien créés
    if (!$date_debut || !$date_fin) {
        return 0;
    }

    //$interval = $date_debut->diff($date_fin);
    $interval = abs($date_debut - $date_fin);
    return $interval; // Retourne le nombre d'années
}


function loadDureeMembres(){
    $membres = getanneeMembres();
    $duree = [];
    $old = null;
    $i = 0;
    $temp = ["np" => '', "1" => 0, "2" => 0, "3" => 0];
    foreach ($membres as $membre) {
        if ($membre['np'] != $old) {
            // Sauvegarder le précédent (sauf au tout premier tour)
            if ($old !== null) {
                $duree[$i] = $temp;
                $i++;
            }

            // Réinitialiser pour le nouveau membre
            $temp = ["np" => $membre['np'], "1" => 0, "2" => 0, "3" => 0];
            $old = $membre['np'];
        }

        // Incrément du statut
        if ($membre['N°statuts'] == 1) {
            $temp['1']+=calculerAnnee($membre['Date début'], $membre['Date Fin']);
    
        } elseif ($membre['N°statuts'] == 2) {
            $temp['2']+=calculerAnnee($membre['Date début'], $membre['Date Fin']);
        } else {
            $temp['3']+=calculerAnnee($membre['Date début'], $membre['Date Fin']);
        }
    }

    // Ne pas oublier d'ajouter le dernier
    if ($old !== null) {
        $duree[$i] = $temp;
    }

    return $duree;
}

function afficherMedailleMembre(){
    $medaille = loadMedailles();
    $duree = loadDureeMembres();
    foreach ($duree as $d) {
        $médaillé = false;
        foreach ($medaille as $m) {
            if($m["Statut"] == 1 && $d["1"] == $m["NA"]){
                $médaillé = true;
                echo '<tr>';
                echo '<td>'.$d["np"].'</td>';
                echo '<td> '.$m["Nom"]. ' ' .$m["Métal"].' ' . $m["fédération"].  ' pour ' . $d["1"]  . ' ans </td>';
                echo '</tr></br>';
            }
            else if($m["Statut"] == 2 && $d["2"] == $m["NA"]){
                $médaillé = true;
                echo '<tr>';
                echo '<td> '.$d["np"].'</td>';
                echo '<td> '.$m["Nom"]. ' ' . $m["Métal"].' ' . $m["fédération"].' pour ' . $d["2"]  . ' ans </td>';
                echo '</tr></br>';
            }
            else if($m["Statut"] == 3 && $d["3"] == $m["NA"]){
                $médaillé = true;
                echo '<tr>';
                echo '<td> '.$d["np"].'</td>';
                echo '<td> '.$m["Nom"]  .' ' .$m["Métal"].' ' . $m["fédération"].' pour ' . $d["3"]  . ' ans </td>';
                echo '</tr></br>';
            }
        }
        if($médaillé){
         echo '</br>';}
    }
}


?>