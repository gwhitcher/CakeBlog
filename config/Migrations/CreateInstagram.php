<?php
use Migrations\AbstractMigration;

class CreateInstagram extends AbstractMigration
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
        $table = $this->table('instagram', ['primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $table->addColumn('title', 'text');
        $table->addColumn('created_time', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('link', 'text');
        $table->addColumn('image', 'text');
        $table->addColumn('status', 'integer', [
            'limit' => 11
        ]);
        $table->create();
    }
}
