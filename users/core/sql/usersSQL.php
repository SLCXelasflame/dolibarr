<?php



$host = 'localhost';
$dbname = 'harmonie';
$dbuser = 'dolibarruser';
$dbpassword = 'dolibarr';
global $external_db;
global $db;

function createUser($firstname, $lastname, $mail, $birthday) {
    global $external_db, $action, $sql_add_member;
    if (empty($firstname) || empty($lastname) || empty($mail) || empty($birthday)) {
        setEventMessage("Error: All fields are required", 'errors');
        return;
    }
    
    $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/add_member.sql'));
    if ($stmt) {
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
        
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




function editUser($rowid, $firstname, $lastname, $mail, $birthday) {
    global $external_db;
    global $action, $sql_edit_member;
  

    if (empty($firstname) || empty($lastname) || empty($mail) || empty($birthday) || empty($rowid)) {
        setEventMessage("Error: All fields are required", 'errors');
        return;
    }

    $stmt = $external_db->prepare(file_get_contents(__DIR__ . '/../../sql/edit_member.sql'));
    if ($stmt) {
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
        $stmt->bindValue(':rowid', $rowid, PDO::PARAM_INT);
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



?>