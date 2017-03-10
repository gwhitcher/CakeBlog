<?php
use Migrations\AbstractMigration;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users', ['primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'limit' => 11
        ]);
        $table->addColumn('full_name', 'text');
        $table->addColumn('username', 'string', [
            'limit' => 50
        ]);
        $table->addColumn('password', 'string', [
            'limit' => 255
        ]);
        $table->addColumn('role', 'string', [
            'limit' => 20
        ]);
        $table->addColumn('body', 'text');
        $table->addColumn('profile_image', 'text');
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('updated', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();

        //CREATE MAIN USER
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->newEntity();
        $user->username = 'admin';
        $user->password = (new DefaultPasswordHasher)->hash('admin');
        $user->role = 'admin';
        $user->created = date('Y-m-d H:i:s');
        $user->modified = date('Y-m-d H:i:s');
        $usersTable->save($user);
    }
}
