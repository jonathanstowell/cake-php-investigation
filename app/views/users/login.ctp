<h2>Log in to your account</h2>

<form method="POST" action="<?=$this->here; ?>">

    <?=$form->error('User.username'); ?>
    <p>
        Username
        <?=$form->text('User.username'); ?>
    </p>
    <p>
        Password
        <?=$form->password('User.password'); ?>

    </p>
    <?=$form->submit('Log in'); ?>
</form>
