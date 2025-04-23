<?php
require_once __DIR__ .'/../../../../main.inc.php';

require_once __DIR__ . '/../lib/medailleLIB.php';

function remove_accents($string) {
    $utf8_string = html_entity_decode($string, ENT_COMPAT, 'UTF-8');
    //$utf8_string = iconv('UTF-8', 'ASCII//TRANSLIT', $utf8_string);
    return $utf8_string;
}

?>