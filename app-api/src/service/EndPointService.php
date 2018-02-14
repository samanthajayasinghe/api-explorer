<?php

/**
 * @author Samantha Jayasinghe
 *
 * End Point Service
 */

namespace APIExplorer\Service;

use \SQLite3;

class EndPointService
{
    public function getEndPoints(){
        $endPoints = array();
        $db = new SQLite3(__DIR__."/../db/api");
        $result = $db->query('SELECT * FROM end_point');

        while($res = $result->fetchArray(SQLITE3_ASSOC)){
            array_push($endPoints, $res);
        }
        return $endPoints;
    }
}
