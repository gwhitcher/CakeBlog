<h1 class="page-header-top">Contact</h1>
<?php
echo $this->Form->create('Contact', array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('full_name', array('class' => 'form-control', 'type' => 'text', 'label' => 'Full Name', 'placeholder' => 'Full Name', 'required' => true));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('email_address', array('class' => 'form-control', 'type' => 'email', 'placeholder' => 'Email Address', 'required' => true));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('message', array('class' => 'form-control', 'type' => 'textarea', 'placeholder' => 'Message', 'required' => true));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('file', array('class' => 'btn btn-default btn-file', 'type' => 'file'));
echo '</div>';

echo '<div class="form-group">';
echo '<div class="row">';
echo '<div class="col-sm-6">';
echo $this->Form->input('captcha', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'CAPTCHA', 'required' => true));
echo '</div>';
echo '<div class="col-sm-6">';
echo '<p><br /><strong>+ 5 = 12</strong></p>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->submit('Send', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo '</div>';

echo $this->Form->end();