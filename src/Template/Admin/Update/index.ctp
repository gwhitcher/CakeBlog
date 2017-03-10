<h1 class="page-header">Update</h1>
<p>Here you can update your CakeBlog website.  Composer update will run "composer update" of your current composer.json.  It is always suggested to run "composer update" from command line.  CakeBlog Update will download the latest files from the GIT repository and copy them to your root directory.  <i>Please make a backup of your files and databases before updating</i>.</p>
<?php
echo $this->Form->create('', array('enctype'=>'multipart/form-data'));

echo '<div class="row">';

echo '<div class="col-sm-6">';
echo $this->Form->submit('Update', array('class' => 'confirm btn btn-primary center-block', 'name' => 'cakeblog_update'));
echo '</div>';

echo '<div class="col-sm-6">';
echo $this->Form->submit('Composer Update (BETA)', array('class' => 'confirm btn btn-primary center-block', 'name' => 'composer_update'));
echo '</div>';

echo '</div>';

echo $this->Form->end();