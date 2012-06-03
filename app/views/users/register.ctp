<div class="hero-unit">
    <h1>Register your account</h1>
</div>

<form method="POST" action="<?=$this->here; ?>">

    <p>
        Username
        <?=$form->text('User.username'); ?>
    </p>
    <p>
        Password
        <?=$form->password('User.password'); ?>
    </p>

    <?=$form->submit('Register', array('class' => 'btn btn-primary')); ?>
</form>