<div class="hero-unit">
    <h1>Blog posts</h1>
</div>

<? if($access->isLoggedin()): ?>
    <p><?php echo $this->Html->link("Add Post", array('action' => 'add'), array('class' => 'btn btn-primary')); ?></p>
<? endif; ?>
<table class="table table-striped table-bordered table-condensed">
    <tr>
        <th class="header yellow">Id</th>
        <th class="header green">Title</th>
        <? if($access->isLoggedin()): ?>
        <th class="header red">Actions</th>
        <? endif; ?>
        <th class="header purple">Created</th>
    </tr>

    <!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?>
        </td>
        <? if($access->isLoggedin()): ?>
        <td>
            <?php echo $this->Html->link('Edit',
                array('action' => 'edit', $post['Post']['id']),
                array('class' => 'btn btn-primary'));?>
            <?php echo $this->Html->link(
            'Delete',
            array('action' => 'delete', $post['Post']['id']),
            array('class' => 'btn btn-danger'),
            'Are you sure?'
            )?>
        </td>
        <? endif; ?>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>