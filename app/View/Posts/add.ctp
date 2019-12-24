<?php echo $this->Html->css('post'); ?>
<?php echo $this->Html->script('post/add.img.pre.js') ?>
<div class="container">
    <h1 class="my-3">Add Post</h1>
    <?php
        echo $this->Form->create('Post', array(
            'type' => 'file',
            'inputDefaults' => array(
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
            )
        ));
        echo $this->Form->input('Category.id', array(
            'type' => 'select',
            'options' => $categories,
            'label' => 'Category'
            ));
        echo $this->Form->label('Tag.id', 'Tag');
        echo $this->Form->input('Tag.id', array(
            'type' => 'select',
            'options' => $tags,
            'multiple' => 'checkbox',
            'label' => false,
            'div' => array(
                'class' => 'checkbox'
            ),
            'class' => 'form-check form-check-inline',
            // 'input' => array(
            //     'class' => 'form-check-input',
            //     'label' => 'form-check-label'
            // )
        ));
        echo $this->Form->input('title');
        echo $this->Form->input('body', array('rows' => '3'));
        echo $this->Form->input('Images.', array(
            'type' => 'file',
            'label' => 'Image',
            'class' => 'form-control-file',
            'required' => false,
            'accept' => 'image/*',
            'multiple'));
        echo $this->Form->button('Save Post', array(
            'class' => 'btn btn-success mb-3 d-flex justify-content-end'
        ));
        echo $this->Form->end();
    ?>
</div>
<?php echo $this->element('sql_dump'); ?>