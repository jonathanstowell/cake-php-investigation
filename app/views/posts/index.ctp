<div class="hero-unit">
    <h1>Blog posts</h1>
</div>

<p><?php echo $this->Html->link("Add Post", array('action' => 'add'), array('class' => 'btn btn-primary')); ?></p>
<table class="table table-striped table-bordered table-condensed">
    <tr>
        <th class="header yellow">Id</th>
        <th class="header green">Title</th>
        <th class="header red">Action</th>
        <th class="header purple">Created</th>
    </tr>

    <!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?>
        </td>
        <td>
            <?php echo $this->Html->link(
            'Delete',
            array('action' => 'delete', $post['Post']['id']),
            array('class' => 'btn btn-danger'),
            'Are you sure?'
        )?>
            <?php echo $this->Html->link('Edit',
                array('action' => 'edit', $post['Post']['id']),
                array('class' => 'btn btn-primary'));?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>