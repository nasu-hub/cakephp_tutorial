<?php

class PostsController extends AppController {
  public $helpers = array('Html', 'Form', 'Flash');
  public $uses = array('Post', 'Category', 'Tag', 'Image');
  // PostsControllerの中でもPostモデル使う宣言は必要なのか？書かないとエラー出るのでとりあえず書いたが。Call to a member function find() on null

  public function index() {
    $this-> set('posts', $this->Post->find('all'));
  }

  public function view($id = null) {
    if (!$id) {
      throw new NotFoundException(__('Invalid post'));
    }

    $post = $this->Post->findById($id);
    if (!$post) {
      throw new NotFoundException(__('Invalid post'));
    }
    $this->set('post', $post);
  }

  public function add() {
    $this->set('category', $this->Category->find('list', array(
      'fields' => array('id', 'name')
    )));
    $this->set('tag', $this->Post->Tag->find('list', array(
      'fields' => array('id', 'name')
    )));

    if ($this->request->is('post')) {
      $this->request->data['Post']['category_id'] = $this->request->data['Category']['id'];
      $this->request->data['Tag']['Tag'] = $this->request->data['Tag']['id'];

      $cnt = count($this->request->data['Post']['Images']);
      for($i =0; $i < $cnt; $i++) {
        $this->request->data['Image'][$i]['attachment'] = $this->request->data['Post']['Images'][$i];
      }
      $this->Post->create();
      $this->request->data['Post']['user_id'] = $this->Auth->user('id');
      // debug($this->request->data);
      if ($this->Post->saveAll($this->request->data, array('deep' => true))) {
        $this->Flash->success(__('Your post has been saved.'));
        return $this->redirect(array('action' => 'index'));
      }
      $this->Flash->error(__('Unable to add your post.'));
    }
  }

  public function edit($id = null) {
    $this-> set('category', $this->Category->find('list', array(
      'fields' => array('id', 'name')
    )));
    $this->set('tag', $this->Post->Tag->find('list', array(
      'fields' => array('id', 'name')
    )));

    if (!$id) {
      throw new NotFoundException(__('Invalid post'));
    }

    $post =$this->Post->findById($id);
    if (!$post) {
      throw new NotFoundException(__('Invalid post'));
    }

    $tmpTag = array();
    foreach ($post['Tag'] as $tmp) {
      $tmpTag[] = $tmp['id'];
    }

    $this->set('selected', $tmpTag);

    if ($this->request->is(array('post', 'put'))) {
      $this->Post->$id;
      $this->request->data['Post']['category_id'] = $this->request->data['Category']['id'];
      $this->request->data['Tag']['Tag'] = $this->request->data['Tag']['id'];
      $cnt = count($this->request->data['Post']['Images']);
      for($i =0; $i < $cnt; $i++) {
        $this->request->data['Image'][$i]['attachment'] = $this->request->data['Post']['Images'][$i];
      }
      debug($this->request->data);
      if ($this->Post->saveAll($this->request->data)) {
        debug($this->request->data);
        $this->Flash->success(__('Your post has been updated.'));
        return $this->redirect(array('action' => 'index'));
      }
      $this->Flash->error(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
      $this->request->data =$post;
    }
  }

  public function delete($id) {
    if ($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }

    if ($this->Post->delete($id)) {
      $this->Flash->success(__('The Post with id: %s has been deleted.', h($id)));
    } else {
      $this->Flash->error(__('The Post with id %s could not be deleted.', h($id)));
    }
    return $this->redirect(array('action' => 'index'));
  }

  public function isAuthorized($user){
    // 登録済みユーザーは投稿できる
    if ($this->action === 'add') {
      return true;
    }

    // 投稿のオーナーは編集や削除ができる
    if (in_array($this->action, array('edit', 'delete'))) {
      $postId = (int) $this->request->params['pass'][0];
      if ($this->Post->isOwnedBy($postId, $user['id'])) {
        return true;
      }
    }
    return parent::isAuthorized($user);
  }
}

?>
