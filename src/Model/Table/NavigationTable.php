<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NavigationTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('navigation');
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('title', 'A title is required')
            ->notEmpty('url', 'A url is required');
    }

}