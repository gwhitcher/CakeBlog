<h1 class="page-header">Add Page</h1>
<?php echo $this->Form->create($page, array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('title', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('slug', array('class' => 'form-control', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('body', array('class' => 'form-control', 'id' => 'body', 'type' => 'textarea'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('metadescription', array('class' => 'form-control', 'label' => 'Meta Description', 'id' => 'metadescription', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('metakeywords', array('class' => 'form-control', 'label' => 'Meta Keywords', 'id' => 'metakeywords', 'type' => 'text'));
echo '</div>';

echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo $this->Form->end();