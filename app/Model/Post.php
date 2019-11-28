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
            'className'              => 'Tag',
            'joinTable'              => 'posts_tags',
            'foreignKey'             => 'post_id',
            'associationForeignKey'  => 'tag_id',
            'with'                   => 'PostsTag',
        )
    );

    public $hasMany = array(
        'Image' => array(
            'dependent' => true,
        )
    );

    public $actsAs = array(
        'Search.Searchable',
        'Containable'
    );

    public $filterArgs = array(
        'category_id' => array('type' => 'value'),
        'title' => array('type' => 'like'),
        'tag_id' => array(
            'type' => 'subquery',
            'field' => 'Post.id',
            'method' => 'searchTag'
        )
    );

    public function searchTag($data = array()) {
        $this->PostsTag->Behaviors->attach('Containable', array('autoFields' => false));
        $this->PostsTag->Behaviors->attach('Search.Searchable');

        if ($data['tag_id'][0]) {
            $tag_ids = $data['tag_id'];
            $query = $this->PostsTag->getQuery('all', array(
                'conditions' => array('PostsTag.tag_id' => $tag_ids),
                'group' => 'PostsTag.post_id HAVING COUNT(PostsTag.post_id) >= '.count($tag_ids),
                'fields' => array('post_id'),
                'contain' => array('Tag')
            ));
            return $query;
        };
    }
}

?>
