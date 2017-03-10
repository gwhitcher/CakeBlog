<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PageTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('pages');
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('title', 'A title is required');
    }

}