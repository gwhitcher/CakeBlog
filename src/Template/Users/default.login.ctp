<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create(); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->button(__('Submit')); ?>
<?php echo $this->Form->end() ?>