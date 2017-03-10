<?php
use Migrations\AbstractMigration;

class CreateSidebar extends AbstractMigration
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
        $table = $this->table('sidebar', ['primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $table->addColumn('title', 'text');
        $table->addColumn('body', 'text');
        $table->addColumn('position', 'integer', [
            'limit' => 11
        ]);
        $table->create();
    }
}
