<?php

class PostsController extends AppController {
  public $helpers = array('Html', 'Form', 'Flash');
  public $uses = array('Post', 'Category', 'Tag', 'Image', 'PostsTag');
  public $components = array('Search.Prg');
  public $presetVars = array(
    'category_id' => array('type' => 'value'),
    'title' => array('type' => 'value'),
    'tag_id' => array('type' => 'checkbox'),
    'sort' => array('type' => 'value')
  );

  public function index() {
    $pager_numbers = array(
      'before' => '-',
      'after' => '-',
      'modules' => 10,
      'separator' => ' ',
      'class' => 'pagenumbers'
    );
    $this->set('pager_numbers', $pager_numbers);
    $this->set('posts', $this->Post->find('all'));

    $this->Prg->commonProcess();
    $this->paginate = array(
      'conditions' => $this->Post->parseCriteria($this->passedArgs),
      'limit' => 5,
    );
    $this->set('posts', $this->paginate());
    $categories = $this->Post->Category->find('list');
    $this->set(compact('categories'));

    $tags = $this->Post->Tag->find('list');
    $this->set(compact('tags'));
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
    $categories = $this->Post->Category->find('list');
    $this->set(compact('categories'));

    $tags = $this->Post->Tag->find('list');
    $this->set(compact('tags'));
  }

  public function add() {
    $this->set('categories', $this->Category->find('list', array(
      'fields' => array('id', 'name')
    )));
    $this->set('tags', $this->Post->Tag->find('list', array(
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
    $this-> set('categories', $this->Category->find('list', array(
      'fields' => array('id', 'name')
    )));
    $this->set('tags', $this->Post->Tag->find('list', array(
      'fields' => array('id', 'name')
    )));

    if (!$id) {
      throw new NotFoundException(__('Invalid post'));
    }

    $post =$this->Post->findById($id);
    if (!$post) {
      throw new NotFoundException(__('Invalid post'));
    }
    // debug($post);

    $tmpTag = array();
    foreach ($post['Tag'] as $tmp) {
      $tmpTag[] = $tmp['id'];
    }

    $this->set('selected', $tmpTag);
    $this->set('post', $post);

    $dirArr = array();
    foreach ($post['Image'] as $tmpImg) {
      $dirArr[] = $tmpImg['dir'];
    }
    // debug($dirArr);

    if ($this->request->is(array('post', 'put'))) {
      // debug($this->request->data);
      $this->Post->$id;
      $this->request->data['Post']['category_id'] = $this->request->data['Category']['id'];
      $this->request->data['Tag']['Tag'] = $this->request->data['Tag']['id'];

      $cnt = count($this->request->data['Post']['Images']);
      for($i =0; $i < $cnt; $i++) {
        // $this->request->data['Image'][$i]['attachment'] = $this->request->data['Post']['Images'][$i];

        $fileName = $this->request->data['Post']['Images'][$i];

        if (array_key_exists($i, $dirArr)) {
          $move_to_dir = "../webroot/files/image/attachment/" . $dirArr[$i];
        } else {
          $move_to_dir = null;
        }

        if (file_exists($move_to_dir) && $this->request->data['Post']['Images'][$i]['name']) {
          // ファイル更新
          foreach (glob($move_to_dir. "/" .'*') as $file) {
            if ($file) {
              unlink($file);
            }
          }
          move_uploaded_file($fileName['tmp_name'], $move_to_dir. "/" .$fileName['name']);

          $data = array(
            'id' => $dirArr[$i],
            'attachment' => $fileName['name']
          );
          $this->Image->save($data);
        } elseif ((file_exists($move_to_dir) === false) && $this->request->data['Post']['Images'][$i]['name']) {
          // ファイル追加
          $this->request->data['Image'][$i]['attachment'] = $this->request->data['Post']['Images'][$i];
        }
      }

      // debug($this->request->data);
      if ($this->Post->saveAll($this->request->data)) {
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
