<?php
// src/Model/Table/UserTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class UserTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('users');
    }

}