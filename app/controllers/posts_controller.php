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
        $this->set('post', $this->Post->read());

    }

    function add() {
        if (!empty($this->data)) {
            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function edit($id = null) {
        if(!$this->Access->check('Post', 'update')) $this->cakeError('error404');

        $this->Post->id = $id;
        if (empty($this->data)) {
            $this->data = $this->Post->read();
        } else {
            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function delete($id) {
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
    }
}
?>