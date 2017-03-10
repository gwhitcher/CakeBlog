<!-- File: src/Template/Users/login.ctp -->
<h1 class="page-header">Login</h1>
<div id="login">
    <?= $this->Form->create() ?>
    <div class="form-group">
        <?= $this->Form->input('username', array('class' => 'form-control')) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->input('password', array('class' => 'form-control')) ?>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-10">
                <?= $this->Form->input('captcha', array('class' => 'form-control')) ?>
            </div>
            <div class="col-sm-2">
                <br />
                <p><strong>+ 3 = 10</strong></p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $this->Form->submit('Login', array('class' => 'btn btn-primary', 'title' => 'Login')); ?>
    </div>
    <?= $this->Form->end() ?>
</div>