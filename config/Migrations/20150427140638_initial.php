<?php
use Phinx\Migration\AbstractMigration;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class Initial extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('articles');
        $table
            ->addColumn('category_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('title', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slug', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('featured', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('metadescription', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('metakeywords', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slider', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('status', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => '0000-00-00 00:00:00',
                'limit' => null,
                'null' => false,
            ])
            ->create();
        $table = $this->table('captcha', ['id' => false, 'primary_key' => ['captcha_id']]);
        $table
            ->addColumn('captcha_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('captcha_time', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('ip_address', 'string', [
                'default' => 0,
                'limit' => 16,
                'null' => false,
            ])
            ->addColumn('word', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->create();
        $table = $this->table('categories');
        $table
            ->addColumn('title', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slug', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('metadescription', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('metakeywords', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();
        $table = $this->table('navigation');
        $table
            ->addColumn('parent_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('title', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('url', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('target', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('position', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();
        $table = $this->table('pages');
        $table
            ->addColumn('title', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slug', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('metadescription', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('metakeywords', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();
        $table = $this->table('sidebar');
        $table
            ->addColumn('title', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('position', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();
        $table = $this->table('users');
        $table
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('role', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        //CREATE MAIN USER
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->newEntity();
        $user->username = 'admin';
        $user->password = (new DefaultPasswordHasher)->hash('admin');
        $user->role = 'admin';
        $user->created = date('Y-m-d H:i:s');
        $user->modified = date('Y-m-d H:i:s');
        $usersTable->save($user);

        //CREATE INITIAL POST
        $articlesTable = TableRegistry::get('Articles');
        $article = $articlesTable->newEntity();
        $article->category_id = 1;
        $article->title = 'Welcome to CakeBlog!';
        $article->slug = 'welcome_to_cakeblog';
        $article->body = '<p>Welcome to CakeBlog! &nbsp;An open source blog software. &nbsp;Written by <a title="George Whitcher - Web Developer" href="http://georgewhitcher.com" target="_blank">George Whitcher</a>&nbsp;in PHP with the CakePHP framework.</p>';
        $article->featured = 'cover.jpg';
        $article->metadescription = 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.';
        $article->metakeywords = 'cakeblog, cakephp, blog, open source';
        $article->slider = 1;
        $article->status = 0;
        $article->created_at = date('Y-m-d H:i:s');
        $article->updated_at = date('Y-m-d H:i:s');
        $articlesTable->save($article);

        //CREATE UNCATEGORIZED CATEGORY
        $categoriesTable = TableRegistry::get('Categories');
        $category = $categoriesTable->newEntity();
        $category->title = 'Uncategorized';
        $category->slug = 'uncategorized';
        $category->metadescription = 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.';
        $category->metakeywords = 'cakeblog, cakephp, blog, open source';
        $categoriesTable->save($category);

        //CREATE NAVIGATION ITEMS
        $navigationitemsTable = TableRegistry::get('Navigation');
        $navigationitem = $navigationitemsTable->newEntity();
        $navigationitem->parent_id = NULL;
        $navigationitem->title = 'Home';
        $navigationitem->url = '';
        $navigationitem->target = '';
        $navigationitem->position = 1;
        $navigationitemsTable->save($navigationitem);

        $navigationitemsTable = TableRegistry::get('Navigation');
        $navigationitem = $navigationitemsTable->newEntity();
        $navigationitem->parent_id = NULL;
        $navigationitem->title = 'About';
        $navigationitem->url = '/about';
        $navigationitem->target = '';
        $navigationitem->position = 2;
        $navigationitemsTable->save($navigationitem);

        $navigationitemsTable = TableRegistry::get('Navigation');
        $navigationitem = $navigationitemsTable->newEntity();
        $navigationitem->parent_id = NULL;
        $navigationitem->title = 'Contact';
        $navigationitem->url = '/contact';
        $navigationitem->target = '';
        $navigationitem->position = 3;
        $navigationitemsTable->save($navigationitem);

        //CREATE ABOUT PAGE
        $pagesTable = TableRegistry::get('Pages');
        $pageitem = $pagesTable->newEntity();
        $pageitem->title = 'About';
        $pageitem->slug = 'about';
        $pageitem->metadescription = 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.';
        $pageitem->metakeywords = 'cakeblog, cakephp, blog, open source';
        $pageitem->body = '<p>CakeBlog is an open source blogging software. Written by <a href="http://georgewhitcher.com">George Whitcher</a> in PHP with the CakePHP framework.</p>
<p>This project was started for my personal blogging and has been rewritten in Codeigniter, Laravel and now CakePHP. &nbsp;CakePHP is my favorite framework and more can be learned about CakePHP by visiting their <a title="CakePHP" href="http://cakephp.org" target="_blank">website</a>. </p>
<p>If you are having issues with CakeBlog please submit them to the "issues" section on it&apos;s repository.</p>';
        $pagesTable->save($pageitem);

        //CREATE SIDEBAR CATEGORY LISTINGS
        $sidebaritemsTable = TableRegistry::get('Sidebar');
        $sidebaritem = $sidebaritemsTable->newEntity();
        $sidebaritem->title = 'Categories';
        $sidebarcategorybody = '<ul>
        <?php
        $base_url = Configure::read("BASE_URL");
        foreach ($sidebar_categories as $sidebar_category)
        {
echo <<<EOT
<li><a href="$base_url/category/$sidebar_category->id/$sidebar_category->slug">$sidebar_category->title</a></li>
EOT;
        }
        ?>
        </ul>';
        $sidebaritem->body = $sidebarcategorybody;
        $sidebaritem->position = 1;
        $sidebaritemsTable->save($sidebaritem);
    }

    public function down()
    {
        $this->dropTable('articles');
        $this->dropTable('captcha');
        $this->dropTable('categories');
        $this->dropTable('navigation');
        $this->dropTable('pages');
        $this->dropTable('sidebar');
        $this->dropTable('users');
    }
}
