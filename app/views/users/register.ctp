<h2>Register your account</h2>

<form method="POST" action="<?=$this->here; ?>">

    <p>
        Username
        <?=$form->text('User.username'); ?>
    </p>
    <p>
        Password
        <?=$form->password('User.password'); ?>
    </p>

    <?=$form->submit('Register'); ?>
</form>