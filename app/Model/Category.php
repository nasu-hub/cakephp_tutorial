<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 */
class Category extends AppModel {
    public $hasMany = 'Post';
}
