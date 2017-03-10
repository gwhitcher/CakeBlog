<h1 class="page-header">Edit Sidebar</h1>
<?php echo $this->Form->create($sidebar, array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('title', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('body', array('class' => 'form-control mceNoEditor', 'id' => 'body', 'type' => 'textarea'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('position', array('class' => 'form-control', 'type' => 'select', 'options' => range(0,99)));
echo '</div>';

echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo $this->Form->end();