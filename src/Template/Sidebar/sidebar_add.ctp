<h1>Add Sidebar</h1>
<?php echo $this->Form->create($sidebar, array('enctype'=>'multipart/form-data'));?>
<fieldset>
<legend>Add Sidebar</legend>
<?php
echo $this->Form->input('title', array('id' => 'title', 'type' => 'text'));
echo $this->Form->input('body', array('id' => 'title', 'class' => 'mceNoEditor', 'type' => 'textarea'));
?>
</fieldset>
<?php echo $this->Form->button(__('Submit')); ?>
<?php echo $this->Form->end() ?>