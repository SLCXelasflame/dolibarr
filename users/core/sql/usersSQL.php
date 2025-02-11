<?php



$host = 'localhost';
$dbname = 'harmonie';
$dbuser = 'dolibarruser';
$dbpassword = 'dolibarr';
global $external_db;
global $db;
function createUser($sexe, $nom, $prenom, $nompatronymique, $Adresse, $Adresse2, $CP, $ville, $tel, $tel2, $portable, $Mail, $naissance, $CPnaissance, $ddn, $annee, $Actif, $Pupitre, $TailleVeste, $TailleChemise, $TaillePantalon, $TailleGilet, $Casquette, $Profession, $Musicien, $Convocation_Papier, $Convocation_Mail, $Commentaires, $Clairon, $Tambour, $Mail_valide, $medaille, $F1_envoi_taches, $fic) {
    global $external_db, $action;
    $titre = $sexe == 'F' ? 'Madame' : 'Monsieur';
    $np = "$nom $prenom";
    $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/add_member.sql'));

    // Replace empty parameters with null
    $params = [
        'sexe' => $sexe,
        'titre' => $titre,
        'np' => $np,
        'nom' => $nom,
        'prenom' => $prenom,
        'nompatronymique' => $nompatronymique,
        'Adresse' => $Adresse,
        'Adresse2' => $Adresse2,
        'CP' => $CP,
        'ville' => $ville,
        'tel' => $tel,
        'tel2' => $tel2,
        'portable' => $portable,
        'Mail' => $Mail,
        'naissance' => $naissance,
        'CPnaissance' => $CPnaissance,
        'ddn' => $ddn,
        'annee' => $annee,
        'Actif' => $Actif,
        'Pupitre' => $Pupitre,
        'TailleVeste' => $TailleVeste,
        'TailleChemise' => $TailleChemise,
        'TaillePantalon' => $TaillePantalon,
        'TailleGilet' => $TailleGilet,
        'Casquette' => $Casquette,
        'Profession' => $Profession,
        'Musicien' => $Musicien,
        'Convocation_Papier' => $Convocation_Papier,
        'Convocation_Mail' => $Convocation_Mail,
        'Commentaires' => $Commentaires,
        'Clairon' => $Clairon,
        'Tambour' => $Tambour,
        'Mail_valide' => $Mail_valide,
        'medaille' => $medaille,
        'F1_envoi_taches' => $F1_envoi_taches,
        'fic' => $fic
    ];

    foreach ($params as $key => $value) {
        if (empty($value)) {
            $params[$key] = null;
        }
    }

    if ($stmt) {
        foreach ($params as $key => $value) {
            $paramType = is_null($value) ? PDO::PARAM_NULL : PDO::PARAM_STR;
            $stmt->bindValue(":$key", $value, $paramType);
        }
        if ($stmt->execute()) {
            setEventMessage("User successfully created");
        } else {
            setEventMessage("Error: ".$stmt->error, 'errors');
        }

    } else {
        setEventMessage("Error: Unable to prepare the SQL statement", 'errors');
    }

    $action = '';
}


function editUser($sexe, $nom, $prenom, $nompatronymique, $Adresse, $Adresse2, $CP, $ville, $tel, $tel2, $portable, $Mail, $naissance, $CPnaissance, $ddn, $annee, $Actif, $Pupitre, $TailleVeste, $TailleChemise, $TaillePantalon, $TailleGilet, $Casquette, $Profession, $Musicien, $Convocation_Papier, $Convocation_Mail, $Commentaires, $Clairon, $Tambour, $Mail_valide, $medaille, $F1_envoi_taches, $fic, $rowid) {
    global $external_db, $action;

    if (empty($rowid)) {
        setEventMessage("Error: User ID is required", 'errors');
        return;
    }

    $titre = $sexe == 'F' ? 'Madame' : 'Monsieur';
    $np = "$nom $prenom";
    $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/edit_member.sql'));

    // Replace empty parameters with null
    $params = [
        'sexe' => $sexe,
        'titre' => $titre,
        'np' => $np,
        'nom' => $nom,
        'prenom' => $prenom,
        'nompatronymique' => $nompatronymique,
        'Adresse' => $Adresse,
        'Adresse2' => $Adresse2,
        'CP' => $CP,
        'ville' => $ville,
        'tel' => $tel,
        'tel2' => $tel2,
        'portable' => $portable,
        'Mail' => $Mail,
        'naissance' => $naissance,
        'CPnaissance' => $CPnaissance,
        'ddn' => $ddn,
        'annee' => $annee,
        'Actif' => $Actif,
        'Pupitre' => $Pupitre,
        'TailleVeste' => $TailleVeste,
        'TailleChemise' => $TailleChemise,
        'TaillePantalon' => $TaillePantalon,
        'TailleGilet' => $TailleGilet,
        'Casquette' => $Casquette,
        'Profession' => $Profession,
        'Musicien' => $Musicien,
        'Convocation_Papier' => $Convocation_Papier,
        'Convocation_Mail' => $Convocation_Mail,
        'Commentaires' => $Commentaires,
        'Clairon' => $Clairon,
        'Tambour' => $Tambour,
        'Mail_valide' => $Mail_valide,
        'medaille' => $medaille,
        'F1_envoi_taches' => $F1_envoi_taches,
        'fic' => $fic,
        'rowid' => $rowid
    ];

    foreach ($params as $key => $value) {
        if (empty($value)) {
            $params[$key] = null;
        }
    }

    if ($stmt) {
        foreach ($params as $key => $value) {
            $paramType = is_null($value) ? PDO::PARAM_NULL : PDO::PARAM_STR;
            if ($key == 'rowid') {
                $paramType = PDO::PARAM_INT;
            }
            $stmt->bindValue(":$key", $value, $paramType);
        }
        if ($stmt->execute()) {
            setEventMessage("User successfully edited");
        } else {
            setEventMessage("Error: ".$stmt->error, 'errors');
        }

    } else {
        setEventMessage("Error: Unable to prepare the SQL statement", 'errors');
    }

    $action = '';
}

    



function showUser() {
    global $external_db, $action, $sql_show_member;

    try {
        $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/show_member.sql'));
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($users) {
            return $users; // Retourne le tableau des utilisateurs
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

function deleteUser($rowid) {
    global $external_db, $action;

    if (empty($rowid)) {
        setEventMessage("Error: User ID is required", 'errors');
        return;
    }

    try {
        $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/delete_member.sql'));
        $stmt->bindValue(':rowid', $rowid, PDO::PARAM_INT);

        if ($stmt->execute()) {
            setEventMessage("User successfully deleted");
        } else {
            setEventMessage("Error: ".$stmt->error, 'errors');
        }
    } catch (PDOException $e) {
        setEventMessage("Database error: ".htmlspecialchars($e->getMessage()), 'errors');
    } finally {
        $action = '';
    }
}


?>