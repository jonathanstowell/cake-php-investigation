<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 05/06/12
 * Time: 16:48
 * To change this template use File | Settings | File Templates.
 */
class Comment extends AppModel
{
    var $name = 'Comment';

    var $belongsTo = array(
        'Post' => array(
            'className'    => 'Post'
        ),
        'User' => array(
            'className'    => 'User'
        )
    );

    var $validate = array(
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    private function updateCounter()
    {
        if ($this->cache) {
            $tag = '_' . 'Post';
            Cache::write($tag, 1 + (int)Cache::read($tag));
            $tag = '_' . $this->name;
            Cache::write($tag, 1 + (int)Cache::read($tag));
        }
    }

    function afterDelete()
    {
        $this->updateCounter();
        parent::afterDelete();
    }

    function afterSave($created)
    {
        $this->updateCounter();
        parent::afterSave($created);
    }
}
?>