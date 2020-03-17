<?php

namespace app\components;

use yii\base\Component;

class MyDbConnection extends Component {
    
    public function connection() {
        $dsn = 'mysql:host=localhost;dbname=hierarchy_php';
        $username = 'root';
        $password = '';

        $connection = new \yii\db\Connection([
            'dsn' => $dsn,
            'username' => $username,
            'password' => $password,
        ]);
        
        return $connection;
    }
}
