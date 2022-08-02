<?php

namespace App\Services\Users;

use App\Consts\UserConsts;
use App\Databases\Database;

class UserLoginService
{
    public function login($data): array
    {
        $DB = new Database();

        $query = "SELECT * FROM ";
        $query .= UserConsts::USERS_TABLE_NAME . " WHERE ";

        foreach ($data as $key => $value) {
            $query .= "$key='$value' AND ";
        }

        if (str_ends_with($query, ' AND ')){
            $query = substr($query, 0, -5);
        }

        $data = $DB->query($query);

        $result = [];

        if (isset($data[0])) {
            $result['authorized'] = true;
            $result['username'] = $data[0]['username'];
        } else {
            $result['authorized'] = false;
        }

        return $result;
    }
}