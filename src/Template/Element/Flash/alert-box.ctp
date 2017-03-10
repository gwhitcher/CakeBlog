<?php
$class = 'alert-';
if (!empty($params['class'])) {
    $class .= $params['class'];
}
?>
<div class="alert <?php echo $class;?>">
    <?php echo $message; ?>
    <a href="#" class="close" onclick="$(this).parent().fadeOut();return false;">&times;</a>
</div>