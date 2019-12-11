<?php
App::uses('AppModel', 'Model');

class Address extends AppModel {

    // public $validate = array(
    //     'id' => array(
    //         'rule1' => array(
    //             'rule' => 'notBlank',
    //             'message' => 'この項目は必須です。',
    //         ),
    //         'rule2' => array(
    //             'rule' => 'numeric',
    //             'message' => '数字のみ入力してください。',
    //         ),
    //         'rule3' => array(
    //             'rule' => array('maxLength', 9),
    //             'message' => '9桁まで入力可能です。',
    //         )
    //     ),
    //     'ken_id' => array(
    //         'rule1' => array(
    //             'rule' => 'notBlank',
    //             'message' => 'この項目は必須です。。',
    //         ),
    //         'rule2' => array(
    //             'rule' => 'numeric',
    //             'message' => '数字のみ入力してください。',
    //         ),
    //         'rule3' => array(
    //             'rule' => array('maxLength', 2),
    //             'message' => '2桁まで入力可能です。入力',
    //         )
    //     ),
    //     'city_id' => array(
    //         'rule1' => array(
    //             'rule' => 'notBlank',
    //             'message' => 'この項目は必須です。',
    //         ),
    //         'rule2' => array(
    //             'rule' => array('maxLength', 5),
    //             'message' => '5桁まで入力可能です。入力可能です',
    //         )
    //     ),
    //     'town_id' => array(
    //         'rule1' => array(
    //             'rule' => 'notBlank',
    //             'message' => 'この項目は必須です。',
    //         ),
    //         'rule2' => array(
    //             'rule' => 'numeric',
    //             'message' => '数字のみ入力してください。入力',
    //         ),
    //         'rule3' => array(
    //             'rule' => array('maxLength', 9),
    //             'message' => '9桁まで入力可能です。入力可能です。',
    //         )
    //     ),
    //     'zip' => array(
    //         'rule1' => array(
    //             'rule' => 'notBlank',
    //             'message' => 'この項目は必須です。',
    //         ),
    //         'rule2' => array(
    //             'rule' => array('postal', '/^[1-9][0-9]{2}-?[0-9]{4}$/'),
    //             'message' => '数字のみ入力してください。入力してください',
    //         ),
    //         'rule3' => array(
    //             'rule' => array('maxLength', 9),
    //             'message' => '9桁まで入力可能です。',
    //         )
    //     )
    // );

    public function importCsv($importFile) {

        $filename = $importFile['tmp_name'];
        $fp = fopen($filename, 'r');
        $count = 0;
        $sqlValue = "";
        $fileLine = count(file($filename));
        $colNum = 15;

        while (!feof($fp)) {
            $data = str_getcsv(mb_convert_encoding(fgets($fp), "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS"));

            if (count($data) === $colNum && ctype_digit($data[0])) {
                $saveData = "(\"$data[0]\", \"$data[1]\", \"$data[2]\", \"$data[3]\", \"$data[4]\", \"$data[5]\", \"$data[6]\", \"$data[7]\", \"$data[8]\", $data[9], $data[10], $data[11], $data[12], $data[13], $data[14])";

                $sqlValue .= $saveData .",";
            }
            $count++;

            if ($count % 10000 === 0 || $count === $fileLine) {
                $sqlValue = rtrim($sqlValue, ",");

                $sql = "INSERT INTO `cake_blog_tutorial`.`addresses` (
                    `city_id`, `zip_old`, `zip`, `ken_furi`, `city_furi`, `town_furi`, `ken_name`, `city_name`, `town_name`, `one_town_two_zip`, `koaza`, `with_chome`, `one_zip_tow_town`, `update`, `reason`) VALUES {$sqlValue}";

                $this->query($sql, false);
                $sqlValue = "";
            }
        }
        fclose($fp);
        debug($count);
    }
}