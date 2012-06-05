<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jonathan Stowell
 * Date: 05/06/12
 * Time: 17:03
 * To change this template use File | Settings | File Templates.
 */
class CommentsController extends AppController {
    var $name = 'Comments';
    var $components = array('Session', 'Auth', 'Acl', 'Access');

    function beforeFilter(){
        $this->Auth->userModel = 'User';
    }

    function edit($id = null) {
        $this->Comment->id = $id;

        if (empty($this->data)) {
            $this->data = $this->Comment->read();
            if($this->data['Comment']['user_id'] != $this->Access->getMy('id')) $this->cakeError('error404');
        } else {
            $this->old = $this->Comment->read();
            if($this->old['Comment']['user_id'] != $this->Access->getMy('id')) $this->cakeError('error404');

            if ($this->Comment->save($this->data)) {
                $this->Session->setFlash('Your comment has been updated.', 'flash_success');
                $this->redirect(array('controller' => 'posts', 'action' => 'view', $this->old["Post"]["id"]), null, true);
            }
        }
    }

    function delete($id) {
        $this->Comment->id = $id;
        $this->data = $this->Comment->read();

        if($this->data['Comment']['user_id'] != $this->Access->getMy('id')) $this->cakeError('error404');

        if ($this->Comment->delete($id)) {
            $this->Session->setFlash('The comment with id: ' . $id . ' has been deleted.', 'flash_success');
            $this->redirect(array('controller' => 'posts', 'action' => 'view', $this->data["Post"]["id"]), null, true);
        }
    }
}
?>