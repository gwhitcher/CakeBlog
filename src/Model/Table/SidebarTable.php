<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SidebarTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('sidebar');
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('title', 'A title is required')
            ->notEmpty('body', 'A body is required');
    }

}