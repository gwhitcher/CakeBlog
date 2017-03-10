<h1 class="page-header">Edit Instagram Image</h1>
<?php echo $this->Form->create($instagram, array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('title', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('status', array('class' => 'form-control', 'id' => 'status', 'type' => 'select', 'options' => array(0 => 'Draft', 1 => 'Published')));
echo '</div>';

echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo $this->Form->end();