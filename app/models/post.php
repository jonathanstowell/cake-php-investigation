<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 03/06/12
 * Time: 16:14
 * To change this template use File | Settings | File Templates.
 */

class Post extends AppModel
{
    var $name = 'Post';

    var $hasMany = array(
        'Comment' => array(
            'className'     => 'Comment'
        )
    );

    var $belongsTo = array(
        'User' => array(
            'className'    => 'User'
        )
    );

    var $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
}
?>
