<?php
use Migrations\AbstractMigration;

class CreateNavigation extends AbstractMigration
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
        $table = $this->table('navigation', ['primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $table->addColumn('parent_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('title', 'text');
        $table->addColumn('url', 'text');
        $table->addColumn('target', 'string', [
            'limit' => 255
        ]);
        $table->addColumn('position', 'integer', [
            'limit' => 11
        ]);
        $table->create();
    }
}
