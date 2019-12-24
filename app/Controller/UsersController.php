<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 */
class UsersController extends AppController {

	public $uses = array('User', 'Address');
	public $components = array('Session');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
	}

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->findById($id));
	}

	public function add() {
		$this->set('prefectures', $this->Address->find('list', array(
			'fields' => array('ken_name', 'ken_name'), //１番目はvalueにセットされる。２番目はセレクトボックスに表示される。
			'group' => 'ken_name',
			'order' => 'city_id'
		  )));

		  $this->set('cities', $this->Address->find('list', array(
			'fields' => array('city_name', 'city_name'), //１番目はvalueにセットされる。２番目はセレクトボックスに表示される。
			'group' => 'city_name',
			'order' => 'city_id'
		  )));
		if ($this->request->is('post')) {
			// 郵便番号と住所が一致するか確認してから保存する処理を後で入れる。
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
	}

	public function edit ($id = null) {
		$this->User->id =$id;
		if(!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		} else {
			$this->request->data = $this->User->findBy($id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->User->id = $id;
		if ($this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Flash->success(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Flash->error(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}

	public function login() {
		// var_dump($this->Session->check('Auth.User'));
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Flash->error(__('Invalid username or password, try again'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function isAuthorized($user) {
        if ($this->action === 'view') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
