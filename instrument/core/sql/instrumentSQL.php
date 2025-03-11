<?php



$host = 'localhost';
$dbname = 'harmonie';
$dbuser = 'dolibarruser';
$dbpassword = 'dolibarr';
global $external_db;
global $db;
function createInstrument($perso, $Nmembre, $NType_instrument, $membre, $Nserie, $marque, $proprietaire, $Reference, $Remarques) {
    global $external_db, $action;

    // Charger la requête SQL depuis le fichier
    $sql = file_get_contents(__DIR__ . '/../../sql/add_instrument.sql');
    $stmt = $external_db->prepare($sql);

    // Tableau de paramètres
    $params = [
        ':perso' => $perso,
        ':Nmembre' => $Nmembre,
        ':NType_instrument' => $NType_instrument,
        ':membre' => $membre,
        ':Nserie' => $Nserie,
        ':marque' => $marque,
        ':proprietaire' => $proprietaire,
        ':Reference' => $Reference,
        ':Remarques' => $Remarques
    ];

    // Remplacer les valeurs vides par null
    foreach ($params as $key => $value) {
        if (empty($value)) {
            $params[$key] = null;
        }
    }

    if ($stmt) {
        // Lier les valeurs aux paramètres
        foreach ($params as $key => $value) {
            $paramType = is_null($value) ? PDO::PARAM_NULL : PDO::PARAM_STR;
            $stmt->bindValue($key, $value, $paramType);
        }

        // Exécuter la requête
        if ($stmt->execute()) {
            setEventMessage("Instrument successfully created");
        } else {
            setEventMessage("Error: " . implode(", ", $stmt->errorInfo()), 'errors');
        }
    } else {
        setEventMessage("Error: Unable to prepare the SQL statement", 'errors');
    }

    $action = '';
}



function editInstrument($rowid, $perso, $Nmembre, $NType_instrument, $membre, $Nserie, $marque, $proprietaire, $Reference, $Remarques) {
    global $external_db, $action;

    // Charger la requête SQL depuis le fichier
    $sql = file_get_contents(__DIR__ . '/../../sql/edit_instrument.sql');
    $stmt = $external_db->prepare($sql);
    // Tableau de paramètres
    $params = [
        ':rowid' => $rowid,
        ':perso' => $perso,
        ':Nmembre' => $Nmembre,
        ':NType_instrument' => $NType_instrument,
        ':membre' => $membre,
        ':Nserie' => $Nserie,
        ':marque' => $marque,
        ':proprietaire' => $proprietaire,
        ':Reference' => $Reference,
        ':Remarques' => $Remarques
    ];
    
    // Remplacer les valeurs vides par null
    foreach ($params as $key => $value) {
        if (empty($value)) {
            $params[$key] = null;
        }
    }
    print_r($params);
    if ($stmt) {
        // Lier les valeurs aux paramètres
        foreach ($params as $key => $value) {
            $paramType = is_null($value) ? PDO::PARAM_NULL : PDO::PARAM_STR;
            if($key == ':rowid') {
                $paramType = PDO::PARAM_INT;
            }
            $stmt->bindValue($key, $value, $paramType);
        }

        // Exécuter la requête
        if ($stmt->execute()) {
            setEventMessage("Instrument successfully edited");
        } else {
            setEventMessage("Error: " . implode(", ", $stmt->errorInfo()), 'errors');
        }
    } else {
        setEventMessage("Error: Unable to prepare the SQL statement", 'errors');
    }

    $action = '';
}

    



function showInstrument() {
    global $external_db, $action, $sql_show_member;

    try {
        $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/show_instrument.sql'));
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($users) {
            return $users; // Retourne le tableau des utilisateurs
        } else {
            setEventMessage("No instruments found.", 'warnings');
            return [];
        }
        
    } catch (PDOException $e) {
        setEventMessage("Database error: ".htmlspecialchars($e->getMessage()), 'errors');
        return [];
    } finally {
        $action = '';
    }
}

function deleteInstrument($rowid) {
    global $external_db, $action;

    if (empty($rowid)) {
        setEventMessage("Error: User ID is required", 'errors');
        return;
    }

    try {
        $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/delete_instrument.sql'));
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

function getInstrumentTypes() {
    global $external_db;

    try {
        $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/select_instrument_type.sql'));
        $stmt->execute();
        $types = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($types) {
            return $types; 
        } else {
            setEventMessage("No instrument types found.", 'warnings');
            return [];
        }
        
    } catch (PDOException $e) {
        setEventMessage("Database error: ".htmlspecialchars($e->getMessage()), 'errors');
        return [];
    }
}


?>