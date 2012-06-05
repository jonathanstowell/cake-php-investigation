<div class="hero-unit">
    <h1>Edit Comment</h1>
</div>
<?php
	echo $this->Form->create('Comment', array('action' => 'edit'));
	echo $this->Form->input('body', array('label' => 'Comment', 'rows' => '3'));
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->input('post_id', array('type' => 'hidden'));
    echo $this->Form->submit('Save Comment', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
?>
