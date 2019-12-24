<?php

class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        )
    );

    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }

    public $belongsTo = 'Category';

    public $hasAndBelongsToMany = array(
        'Tag' => array(
            'className'              => 'tag',
            'joinTable'              => 'posts_tags',
            'foreignKey'             => 'post_id',
            'associationForeignKey'  => 'tag_id',
        )
    );

    public $hasMany = array(
        'Image' => array(
            'dependent' => true,
        )
    );
}

?>
