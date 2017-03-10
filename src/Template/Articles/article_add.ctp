<h1>Add Article</h1>
<?php echo $this->Form->create($article, array('enctype'=>'multipart/form-data'));?>
<fieldset>
<legend>Add Article</legend>
<?php
echo $this->Form->input('category_id', array('id' => 'client_id', 'empty' => 'Please choose'));
echo $this->Form->input('title', array('id' => 'title', 'type' => 'text'));
echo $this->Form->input('body', array('id' => 'body', 'type' => 'textarea'));
echo $this->Form->input('featured', array('id' => 'featured', 'type' => 'file'));
echo $this->Form->input('metadescription', array('label' => 'Meta Description', 'id' => 'metadescription', 'type' => 'text'));
echo $this->Form->input('metakeywords', array('label' => 'Meta Keywords', 'id' => 'metakeywords', 'type' => 'text'));
echo $this->Form->input('slider', array('id' => 'slider', 'type' => 'select', 'options' => array('0' => 'No', '1' => 'Yes')));
echo $this->Form->input('status', array('id' => 'status', 'type' => 'select', 'options' => array('1' => 'Draft', '0' => 'Published')));
?>
</fieldset>
<?php echo $this->Form->button(__('Submit')); ?>
<?php echo $this->Form->end() ?>