<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 03/06/12
 * Time: 22:34
 * To change this template use File | Settings | File Templates.
 */
class GroupsController
{
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('*'));
    }
}
