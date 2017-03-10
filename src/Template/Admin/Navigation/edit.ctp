<h1 class="page-header">Edit Navigation Item</h1>
<?php echo $this->Form->create($navigation, array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('parent_id', array('class' => 'form-control', 'type' => 'select', 'options' => $parent_ids, 'empty' => '(choose one or leave blank for top level)'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('title', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('url', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('target', array('class' => 'form-control', 'type' => 'select', 'options' => array('' => '(Empty)', '_blank' => '_blank')));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('position', array('class' => 'form-control', 'type' => 'select', 'options' => range(0,99)));
echo '</div>';

echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo $this->Form->end();