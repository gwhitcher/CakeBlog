<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CategoriesTable extends Table {

    public function initialize(array $config) {
        $this->table('categories');

        $this->belongsTo('post_type', [
            'foreignKey' => 'post_type_id'
        ]);
    }
}