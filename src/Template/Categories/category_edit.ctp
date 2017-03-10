<h1>Edit Category</h1>
<?php echo $this->Form->create($category, array('enctype'=>'multipart/form-data'));?>
<fieldset>
<legend>Edit Category</legend>
<?php
echo $this->Form->input('title', array('id' => 'title', 'type' => 'text'));
echo $this->Form->input('metadescription', array('label' => 'Meta Description', 'id' => 'metadescription', 'type' => 'text'));
echo $this->Form->input('metakeywords', array('label' => 'Meta Keywords', 'id' => 'metakeywords', 'type' => 'text'));
?>
</fieldset>
<?php echo $this->Form->button(__('Submit')); ?>
<?php echo $this->Form->end() ?>