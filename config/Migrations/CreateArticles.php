<?php
use Migrations\AbstractMigration;

class CreateArticles extends AbstractMigration
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
        $table = $this->table('articles', ['primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $table->addColumn('post_type_id', 'integer', [
            'limit' => 11
        ]);
        $table->addColumn('user_id', 'integer', [
            'limit' => 11
        ]);
        $table->addColumn('title', 'text');
        $table->addColumn('slug', 'string', [
            'limit' => 255
        ]);
        $table->addColumn('body', 'text');
        $table->addColumn('featured', 'text');
        $table->addColumn('slider', 'integer', [
            'limit' => 11
        ]);
        $table->addColumn('status', 'integer', [
            'limit' => 11
        ]);
        $table->addColumn('metadescription', 'text');
        $table->addColumn('metakeywords', 'text');
        $table->addColumn('created_at', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('updated_at', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
