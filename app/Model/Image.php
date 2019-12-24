<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 * @property Post $Post
 */
class Image extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'post_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'image' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

	public $actsAs = array(
		'Upload.Upload' => array(
			'attachment' => array(
				'thumbnailSizes' => array(
					'xvga' => '1024x768',
					'vga' => '640x480',
					'thumb' => '80x80',
				),
			),
		),
	);

	public $belongsTo = 'Post';

}
