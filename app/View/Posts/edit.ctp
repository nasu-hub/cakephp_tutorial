<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('Category.id', array(
    'type' => 'select',
    'options' => $category,
    'label' => 'Category'
    ));
echo $this->Form->input('Tag.id', array(
    'type' => 'select',
    'options' => $tag,
    'multiple' => 'checkbox',
    'label' => 'Tag',
    'selected' => $selected
));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('Attachment.0.attachment', array('type' => 'file', 'label' => 'Image'));
echo $this->Form->end('Save Post');
?>