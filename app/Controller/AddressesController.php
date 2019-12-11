<?php
App::uses('AppController', 'Controller');
/**
 * Addresses Controller
 */
class AddressesController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $uses = array('Address');
    public $components = array('Session');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('search', 'settingCity');
      }

    public function add() {
        set_time_limit(0);
        if ($this->request->is('post')) {
            $importFile = $this->request->data['csv']['csv'];

            // あとで消す
            debug($importFile);
            $timeStart = microtime(true);
            echo memory_get_usage();
            echo "<br>";
            // ここまで

            if ($importFile['error'] === 0) {
                $this->Address->importCsv($importFile);
            } else {
                $this->Flash->error(__('Failed upload file.'));
            }
            $this->Flash->success(__('Finished!'));

            // あとで消す
            echo memory_get_usage();
            $time = microtime(true) - $timeStart;
            debug($time);
            // ここまで
        }
    }

    public function isAuthorized($user) {
        if ($this->action === 'add') {
            return true;
        }

        return parent::isAuthorized($user);
    }

    // public function importCsv($importFile) {
    //     $saveData = $this->Address->importCsv2($importFile);
    //     // $this->Address->shapeCsvData($importFile);

    //     // var_dump($saveData);
    //     $this->Address->create();
    //     if ($this->Address->saveMany($saveData)) {
    //         $this->Flash->success(__('Success import.'));
    //     } else {
    //         $this->Flash->error(__('Failed import'));
    //     }
    //     $this->Flash->success(__('Finished!'));
    // }

    public function search(){
        $this->autoRender = false;
        $this->response->type('json');

        if ($this->request->is('ajax')) {
            $zip = $this->params->query['param'];
            if ($zip) {
                $address = $this->Address->findByZip($zip);
                return json_encode($address);
            }
        }
    }

    public function settingCity() {
        $this->autoRender = false;
        $this->response->type('json');

        if ($this->request->is('ajax')) {
            $cityName = $this->params->query['param'];
            $city = $this->Address->find('all', array(
                'fields' => 'city_name',
                'conditions' => array('ken_name' => $cityName),
                'group' => 'city_name',
                'order' => 'city_id'
            ));

            return json_encode($city);
        }
    }


}
