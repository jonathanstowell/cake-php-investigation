<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 03/06/12
 * Time: 16:04
 * To change this template use File | Settings | File Templates.
 */

class PostsController extends AppController {
    var $name = 'Posts';
    var $components = array('Session', 'Auth', 'Acl', 'Access');

    function beforeFilter(){
        $this->Auth->userModel = 'User';
        $this->Auth->allow(array('index', 'view'));
    }

    function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    function all() {
        $this->set('posts', $this->Post->find('all'));
        $this->view = 'Json';
        $this->set('json', 'posts');
    }

    function view($id) {
        $this->Post->id = $id;
        $this->Post->recursive = 2;
        $this->set('post', $this->Post->read());

    }

    function add() {
        if (!empty($this->data) && $this->Auth->user('id')) {
            $this->data['Post']['user_id'] = $this->Auth->user('id');
            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been saved.', 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The Post could not be saved. Please, try again.', 'flash_error');
            }
        }
    }

    function edit($id = null) {
        $this->Post->id = $id;
        if (empty($this->data)) {
            $this->data = $this->Post->read();
            if($this->data['Post']['user_id'] != $this->Access->getMy('id')) $this->cakeError('error404');
        } else {
            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.', 'flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function delete($id) {
        $this->Post->id = $id;
        $this->data = $this->Post->read();
        if($this->data['Post']['user_id'] != $this->Access->getMy('id')) $this->cakeError('error404');

        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.', 'flash_error');
            $this->redirect(array('action' => 'index'));
        }
    }

    function addComment($id = null) {
        if (!empty($this->data) && $this->Auth->user('id')) {
            $this->data['Comment']['user_id'] = $this->Auth->user('id');

            $this->Post->Comment->create();
            if ($this->Post->Comment->save($this->data)) {
                $this->Session->setFlash('Your comment has been saved.', 'flash_success');
                $this->redirect(array('action' => 'view', $id), null, true);
            } else {
                $this->Session->setFlash('The Comment could not be saved. Please, try again.', 'flash_error');
                $this->redirect(array('action' => 'view', $id), null, true);
            }
        }
    }
}
?>