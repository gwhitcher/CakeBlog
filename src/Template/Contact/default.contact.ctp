<h2>Contact</h2>
<?php 
echo $this->Form->create('Contact', array('type'=>'file'));
echo $this->Form->input('name');
echo $this->Form->input('email');
echo $this->Form->input('phone');
echo $this->Form->input('type', array(
    'options' => array('general' => 'General', 'support' => 'Support'),
    'empty' => '(choose one)'
));
echo $this->Form->input('message');
?>
<img class="captcha" id="captcha" src="<?php echo Configure::read('BASE_URL');?>/contact/captcha_image" alt="" /> <a href="javascript:void(0);" onclick="javascript:document.getElementById('captcha').src='<?php echo Configure::read('BASE_URL');?>/contact/captcha_image?' + Math.round(Math.random(0)*1000)+1;"><img class="form_refresh" src="<?php echo Configure::read('BASE_URL');?>/img/contact/refresh.png" /></a>
<?php
echo $this->Form->input('captcha');
echo $this->Form->button(__('Submit'));
echo $this->Form->end();
?>