<h1 class="page-header">Install <?php echo SITE_TITLE; ?></h1>
<?php echo $this->Form->create('Install');?>
<?php
echo '<div class="form-group">';
echo $this->Form->input('name', array('class' => 'form-control', 'type' => 'text', 'required' => true));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('username', array('class' => 'form-control', 'type' => 'text', 'required' => true));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('password', array('class' => 'form-control', 'type' => 'password', 'required' => true));

echo '<div class="form-group">';
echo $this->Form->input('body', array('class' => 'form-control'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo '</div>';

echo $this->Form->end();
?>