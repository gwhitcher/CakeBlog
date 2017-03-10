<?php
use Migrations\AbstractMigration;

class CreatePostType extends AbstractMigration
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
        $table = $this->table('post_type', ['primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $table->addColumn('title', 'text');
        $table->addColumn('slug', 'string', [
            'limit' => 255
        ]);
        $table->addColumn('body', 'text');
        $table->addColumn('metadescription', 'text');
        $table->addColumn('metakeywords', 'text');
        $table->create();
    }
}
