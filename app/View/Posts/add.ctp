<h1>Add Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('Category.id', array(
    'type' => 'select',
    'options' => $category,
    'label' => 'Category'
    ));
echo $this->Form->input('Tag.id', array(
    'type' => 'select',
    'options' => $tag,
    'multiple' => 'checkbox',
    'label' => 'Tag'
    ));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post');
?>