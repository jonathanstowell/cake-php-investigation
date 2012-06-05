<div class="hero-unit">
    <h1>Register your account</h1>
</div>

<?php
echo $this->Form->create('User');
echo $this->Form->input('username', array('type'=>'text'));
echo $this->Form->input('email', array('type'=>'text'));
echo $this->Form->input('password', array('value' => ''));
echo $this->Form->input('password2', array('value' => '', 'label' => 'Confirm Password', 'type' => 'password'));
echo $this->Form->submit('Register', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>