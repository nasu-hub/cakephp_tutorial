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
                $this->importCsv($importFile);
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

    public function importCsv($importFile) {

        $filename = $importFile['tmp_name'];
        $file = new SplFileObject($filename);
        $file->setFlags(SplFileObject::READ_CSV);
        file_put_contents($filename, mb_convert_encoding(file_get_contents($filename), 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS'));

        $saveData = [];
        $sql_update = "UPDATE `cake_blog_tutorial`.`addresses` SET city_id = ?, zip_old = ?, zip = ?, ken_furi = ?, city_furi = ?, town_furi = ?, ken_name = ?, city_name = ?, town_name = ?, one_town_two_zip = ?, koaza = ?, with_chome = ?, one_zip_tow_town = ?, update_flg = ?, reason = ? WHERE city_id = ? and zip_old = ? and zip = ? and ken_name = ? and city_name = ? and town_name = ? and with_chome = ? and one_zip_tow_town = ?";

        $cnt = 0;
        foreach ($file as $line) {
            if ($line[0]) {
                $data = $this->Address->find('all', array(
                    'conditions' => array(
                        'and' => array(
                            'Address.city_id'   => $line[0],
                            'Address.zip_old'   => $line[1],
                            'Address.zip'       => $line[2],
                            'Address.ken_name'  => $line[6],
                            'Address.city_name' => $line[7],
                            'Address.town_name' => $line[8],
                            'Address.with_chome' => $line[11],
                            'Address.one_zip_tow_town' => $line[12],
                        )
                    )
                ));

                if ($data) {

                    $params = array_merge($line, array($data[0]['Address']['city_id'], $data[0]['Address']['zip_old'], $data[0]['Address']['zip'], $data[0]['Address']['ken_name'], $data[0]['Address']['city_name'], $data[0]['Address']['town_name'], $line[11], $line[12]));

                    $this->Address->query($sql_update, $params);

                } else {
                    $saveData[] = array(
                        'Address' => array(
                            'city_id'          => $line[0],
                            'zip_old'          => $line[1],
                            'zip'              => $line[2],
                            'ken_furi'         => $line[3],
                            'city_furi'        => $line[4],
                            'town_furi'        => $line[5],
                            'ken_name'         => $line[6],
                            'city_name'        => $line[7],
                            'town_name'        => $line[8],
                            'one_town_two_zip' => $line[9],
                            'koaza'            => $line[10],
                            'with_chome'       => $line[11],
                            'one_zip_tow_town' => $line[12],
                            'update_flg'       => $line[13],
                            'reason'           => $line[14],
                        )
                    );
                }
                $cnt++;
            }
        }
        var_dump($cnt);

        if ($saveData) {
            $this->Address->create();
            if ($this->Address->saveMany($saveData)) {
                $this->Flash->success(__('Success import.'));
            } else {
                $this->Flash->error(__('Failed import'));
            }
        }
    }

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
