<h1 class="page-header">Edit User</h1>
<?php echo $this->Form->create($user, array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('full_name', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('username', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('password', array('class' => 'form-control', 'type' => 'password'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('role', array('class' => 'form-control', 'type' => 'select', 'options' => array('admin' => 'Admin', 'guest' => 'Guest')));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('profile_image', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('body', array('class' => 'form-control'));
echo '</div>';

echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo $this->Form->end();