<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table {

    public function initialize(array $config) {
        $this->table('articles');

        /*
        $this->belongsTo('categories', [
            'foreignKey' => 'category_id'
        ]);
        */
        $this->belongsToMany('categories', [
            'className' => 'Categories',
            'joinTable' => 'article_categories',
        ]);
        $this->belongsTo('users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('post_type', [
            'foreignKey' => 'post_type_id'
        ]);
    }
}