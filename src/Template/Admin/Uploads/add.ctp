<?php
if(!empty($_GET['folder'])) {
    $folder = ' to '.trim($_GET['folder'], "/");
} else {
    $folder = '';
};
?>
    <h1 class="page-header">Add Upload <?php echo $folder; ?></h1>
<?php echo $this->Form->create('Upload', array('enctype'=>'multipart/form-data'));?>
<?php
echo '<div class="form-group">';
echo $this->Form->input('file', array('class' => 'btn btn-default btn-file', 'type' => 'file'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo '</div>';

echo $this->Form->end();
?>