<h1 class="page-header">Add Category</h1>
<?php echo $this->Form->create($category, array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('post_type_id', array('class' => 'form-control', 'id' => 'post_type_id', 'empty' => 'Please choose', 'options' => $post_type_ids));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('title', array('class' => 'form-control', 'id' => 'title', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('metadescription', array('class' => 'form-control', 'label' => 'Meta Description', 'id' => 'metadescription', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('metakeywords', array('class' => 'form-control', 'label' => 'Meta Keywords', 'id' => 'metakeywords', 'type' => 'text'));
echo '</div>';

echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo $this->Form->end();