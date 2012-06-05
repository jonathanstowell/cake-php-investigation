<div class="hero-unit" xmlns="http://www.w3.org/1999/html">
    <h1><?php echo $post['Post']['title']?></h1>
</div>

<p><small>Created: <?php echo $post['Post']['created']?></small></p>

<p><?php echo $post['Post']['body']?></p>

<?php if(empty($post['Comment'])): ?>
    <p>No Comments yet. Be the first one to comment!</p>
<?php else: ?>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <th class="header green" colspan="4">Comments</th>
        </thead>
        <tbody>
            <?php foreach ($post['Comment'] as $comment): ?>
            <tr>
                <td><?php echo $comment['id']; ?></td>
                <td>
                    <?php echo $comment['body']; ?>
                </td>
                <td><?php echo $comment['User']['username']; ?></td>
                <? if($access->isLoggedin()): ?>
                <td>
                    <? if($comment['User']['id'] == $access->getMy('id')): ?>
                    <?php echo $this->Html->link('Edit',
                        array('controller' => 'comments', 'action' => 'edit', $comment['id']),
                        array('class' => 'btn btn-primary'));?>
                    <?php echo $this->Html->link(
                        'Delete',
                        array('controller' => 'comments', 'action' => 'delete', $comment['id']),
                        array('class' => 'btn btn-danger'),
                        'Are you sure?'
                    )?>
                    <? else: ?>
                    N/A
                    <? endif; ?>
                </td>
                <? endif; ?>
                <td><?php echo $comment['created']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if($access->isLoggedin()): ?>
    <?php echo($form->create('Comment', array('url' => array('controller' => 'posts', 'action' => 'addComment', $post['Post']['id']))));?>
    <?php echo($form->hidden('post_id', array('value' => $post['Post']['id']))); ?>
    <?php echo($form->input('body', array('label' => 'Comment'))); ?>
    <?php echo($form->submit('Post Your Comment', array('class' => 'btn btn-primary'))); ?>
    <?php echo($form->end()); ?>
<?php else: ?>
<p>To post an comment, please login or signup.</p>
<?php endif; ?>