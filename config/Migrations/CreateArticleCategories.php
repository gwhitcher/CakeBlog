<?php
use Migrations\AbstractMigration;

class CreateArticleCategories extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('article_categories', ['primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $table->addColumn('article_id', 'integer', [
            'limit' => 11
        ]);
        $table->addColumn('category_id', 'integer', [
            'limit' => 11
        ]);
        $table->create();
    }
}
