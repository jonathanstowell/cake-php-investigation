<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 03/06/12
 * Time: 22:40
 * To change this template use File | Settings | File Templates.
 */

class Group extends Model {
    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        return null;
    }
}