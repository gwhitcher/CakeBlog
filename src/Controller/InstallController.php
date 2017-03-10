<?php
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;

class InstallController extends AppController {

    public function index() {
        //Security
        $base_dir = str_replace("webroot", "", getcwd());
        $filename = $base_dir.'src/Template/Themes/cakeblog/install.lock';
        if (file_exists($filename)) {
            $this->Flash->set('CakeBlog already installed.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'success'
                    ]]
            );
            return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
        }

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('install.index');

        if ($this->request->is(['post', 'put'])) {
            $connection = ConnectionManager::get('default');

            $sql_articles = "CREATE TABLE IF NOT EXISTS articles(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								post_type_id INT( 11 ) NOT NULL,
								user_id INT( 11 ) NOT NULL,
								title TEXT NOT NULL,
								slug VARCHAR(255) NOT NULL,
								body TEXT NOT NULL,
								featured TEXT NOT NULL,
								slider INT( 11 ) NOT NULL,
								status INT( 11 ) NOT NULL,
								metadescription TEXT NULL,
								metakeywords TEXTa NULL,
								created_at TIMESTAMP NOT NULL,
								updated_at TIMESTAMP NOT NULL,
								PRIMARY KEY (id),
								UNIQUE slug (slug)
								)";
            $connection->query($sql_articles);

            $sql_categories = "CREATE TABLE IF NOT EXISTS categories(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								post_type_id INT( 11 ) NOT NULL,
								title TEXT NOT NULL,
								slug VARCHAR(255) NOT NULL,
								body TEXT NOT NULL,
								metadescription TEXT NULL,
								metakeywords TEXT NULL,
								PRIMARY KEY (id),
								UNIQUE slug (slug)
								)";
            $connection->query($sql_categories);

            $sql_article_categories = "CREATE TABLE IF NOT EXISTS article_categories(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								article_id INT( 11 ) NOT NULL,
								category_id INT( 11 ) NOT NULL
								)";
            $connection->query($sql_article_categories);

            $sql_navigation = "CREATE TABLE IF NOT EXISTS navigation(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								parent_id INT( 11 ) NULL,
								title TEXT NOT NULL,
								url TEXT NOT NULL,
								target TEXT NOT NULL,
								position INT( 11 ) NOT NULL,
								PRIMARY KEY (id)
								)";
            $connection->query($sql_navigation);

            $sql_pages = "CREATE TABLE IF NOT EXISTS pages(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								title TEXT NOT NULL,
								slug VARCHAR(255) NOT NULL,
								body TEXT NOT NULL,
								metadescription TEXT NULL,
								metakeywords TEXT NULL,
								PRIMARY KEY (id),
								UNIQUE slug (slug)
								)";
            $connection->query($sql_pages);

            $sql_post_type = "CREATE TABLE IF NOT EXISTS post_type(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								title TEXT NOT NULL,
								slug VARCHAR(255) NOT NULL,
								body TEXT NOT NULL,
								metadescription TEXT NULL,
								metakeywords TEXT NULL,
								PRIMARY KEY (id),
								UNIQUE slug (slug)
								)";
            $connection->query($sql_post_type);

            $sql_users = "CREATE TABLE IF NOT EXISTS users(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								full_name VARCHAR( 255 ) NOT NULL,
								username VARCHAR( 255 ) NOT NULL,
								password VARCHAR( 255 ) NOT NULL,
								role VARCHAR( 255 ) NOT NULL,
								body TEXT NOT NULL,
								profile_image TEXT NOT NULL,
								PRIMARY KEY (id),
								UNIQUE username (username)
								)";
            $connection->query($sql_users);

            $sql_instagram = "CREATE TABLE IF NOT EXISTS instagram(
								id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
								title TEXT NOT NULL,
								created_time VARCHAR( 255 ) NULL,
								link TEXT NOT NULL,
								image TEXT NOT NULL,
								status INT( 11 ) NOT NULL,
								PRIMARY KEY (id)
								)";
            $connection->query($sql_instagram);

            $full_name = $this->request->data['full_name'];
            $username = $this->request->data['username'];
            $password_hash = new DefaultPasswordHasher;
            $password = $password_hash->hash($this->request->data['password']);
            $role = 'admin';
            $body = $this->request->data['body'];
            $sql_insert_user = "INSERT INTO users (id, full_name, username, password, role, body, profile_image) VALUES (NULL, '".$full_name."', '".$username."', '".$password."', '".$role."', $body, '');";
            $connection->query($sql_insert_user);

            $search_sidebar = '<h2>Search</h2>
        <form action="<?php echo BASE_URL; ?>/search" method="get">
            <input name="category" type="hidden" value="1" />
            <div class="row">
                <div class="col-sm-8">
                    <input class="form-control" name="keyword" type="text" placeholder="Search..." />
                </div>
                <div class="col-sm-4">
                    <input class="btn btn-primary" name="Search" type="submit" />
                </div>
            </div>
        </form>';
            $sql_insert_sidebar = "INSERT INTO sidebar (id, title, body, position) VALUES (NULL, 'Search', '".$search_sidebar."', 0);";
            $connection->query($sql_insert_sidebar);

            $categories_sidebar = '<div class="list-group">
<?php
$base_url = BASE_URL;
foreach ($cat_array as $sidebar_category) {
//if($sidebar_category[\'post_type\'] == 2) {
    echo \'<a class="list-group-item" href="\'.$base_url.\'/category/\'.$sidebar_category[\'slug\'].\'">\'.$sidebar_category[\'title\'].\' <span class="badge">\'.$sidebar_category[\'count\'].\'</span></a>\';
	}
//}
?>
</div>';
            $sql_insert_sidebar = "INSERT INTO sidebar (id, title, body, position) VALUES (NULL, 'Categories', '".$categories_sidebar."', 1);";
            $connection->query($sql_insert_sidebar);

            $about_page_body = '<p>CakeBlog is an open source blogging software. Written by <a href="http://georgewhitcher.com">George Whitcher</a> in PHP with the CakePHP framework.</p>
<p>This project was started for my personal blogging and has been rewritten in Codeigniter, Laravel and now CakePHP. CakePHP is my favorite framework and more can be learned about CakePHP by visiting their <a title="CakePHP" href="http://cakephp.org" target="_blank">website</a>. </p>
<p>If you are having issues with CakeBlog please submit them to the "issues" section on it&apos;s repository.</p>';
            $about_page_metadescription = 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.';
            $about_page_metakeywords = 'cakeblog, cakephp, blog, open source';
            $sql_insert_about_page = "INSERT INTO pages (id, title, slug, body, metadescription, metakeywords) VALUES (NULL, 'About', 'about', '".$about_page_body."', '".$about_page_metadescription."', '".$about_page_metakeywords."');";
            $connection->query($sql_insert_about_page);

            $article_body = '<p>Welcome to CakeBlog! &nbsp;An open source blog software. &nbsp;Written by <a title="George Whitcher - Web Developer" href="http://georgewhitcher.com" target="_blank">George Whitcher</a>&nbsp;in PHP with the CakePHP framework.</p>';
            $article_featured = BASE_URL.'/uploads/articles/featured/cover-1200x400.jpg';
            $article_metadescription = 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.';
            $article_metakeywords = 'cakeblog, cakephp, blog, open source';
            $article_date = date('Y-m-d H:i:s');
            $sql_insert_article = "INSERT INTO articles (id, post_type_id, user_id, category_id,  title, slug, body, featured, slider, status, metadescription, metakeywords, created_at, updated_at) VALUES (NULL, 0, 1, 1, 'Welcome to CakeBlog', 'welcome-to-cakeblog', '".$article_body."', '".$article_featured."', 1, 1 '".$article_metadescription."', '".$article_metakeywords."', '".$article_date."', '".$article_date."');";
            $connection->query($sql_insert_article);

            $category_metadescription = 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.';
            $category_metakeywords = 'cakeblog, cakephp, blog, open source';
            $sql_insert_category = "INSERT INTO categories (id, title, slug, body, metadescription, metakeywords) VALUES (NULL, 'Uncategorized', 'uncategorized', '".$category_metadescription."', '".$category_metakeywords."');";
            $connection->query($sql_insert_category);

            //lock
            fopen($filename, "w");

            $this->Flash->set('CakeBlog has been installed.  Please delete "/src/InstallController.php" for your security.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'success'
                    ]]
            );
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }
    }
}