<h2>Log in to your account</h2>

<?php echo $this->Form->create('User'); ?>

    <?=$form->error('User.username'); ?>
    <p>
        Username
        <?=$form->text('User.username'); ?>
    </p>
    <p>
        Password
        <?=$form->password('User.password'); ?>

    </p>
<?php
    echo $this->Form->submit('Login', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
?>