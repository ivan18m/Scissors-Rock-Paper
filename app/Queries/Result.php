<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

final class Result
{

    /**
     * @param int $userElementId
     * @param int $randomElementId
     * @return string
     */
    public static function getResult(int $userElementId, int $randomElementId)
    {
        if($userElementId == $randomElementId) {
            return "Tie";    
        }

        $sql = "SELECT COUNT(*) AS result FROM element_strength WHERE element_id = ? AND strength_id = ?";
        $params = [$userElementId, $randomElementId];
        $result = DB::select($sql, $params)[0]->result;

        if($result > 0) {
            return "Win";
        }
        else {
            return "Lose";
        }
    }
}