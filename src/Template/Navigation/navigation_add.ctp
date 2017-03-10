<h1>Add Navigation</h1>
<?php echo $this->Form->create($navigation, array('enctype'=>'multipart/form-data'));?>
<fieldset>
<legend>Add Navigation</legend>
<?php
echo $this->Form->input('parent_id', array('options' => $existing_navigation, 'type' => 'select', 'empty' => '(choose one)'));
echo $this->Form->input('title', array('id' => 'title', 'type' => 'text'));
echo $this->Form->input('url', array('id' => 'title', 'type' => 'text'));
echo $this->Form->input('target', array('options' => array('_blank' => '_blank', 'new' => 'new', '_parent' => '_parent', '_self' => '_self', '_top' => '_top'), 'type' => 'select', 'empty' => '(choose one)'));
?>
</fieldset>
<?php echo $this->Form->button(__('Submit')); ?>
<?php echo $this->Form->end() ?>