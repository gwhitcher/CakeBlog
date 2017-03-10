<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoryTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('categories');
        $this->hasOne('Article', [
            'foreignKey' => 'category_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('title', 'A title is required');
    }

}