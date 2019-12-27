<?php echo $this->Html->css('post'); ?>
<?php echo $this->Html->script('post/edit.img.js') ?>
<div class="container">
    <h1 class="my-3">Edit Post</h1>
    <?php
        // debug($post);
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
            'selected' => $selected,
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
        echo $this->Form->input('id', array('type' => 'hidden'));
        // echo $this->Form->input('Images.', array(
        //     'type' => 'file',
        //     'label' => 'Image',
        //     'class' => 'form-control-file',
        //     'required' => false,
        //     'multiple'));
    ?>
    <?php echo $this->Form->label('Image'); ?>
    <div id="file-list" class="preview-image d-flex">
        <?php
            $base = $this->Html->url( "/files/image/attachment/" );
            $cnt = count($post['Image']);
        ?>
        <?php for ($i = 0; $i < $cnt; $i++): ?>
            <div class="wrapper-img">
            <div class="image-box">
                <?php
                    echo $this->Html->image( $base . $post['Image'][$i]["dir"] . "/" . $post['Image'][$i]["attachment"], array('width' => '200', 'height' => '150'));
                ?>
                <div class="icon-clear">
                    <i class="far fa-times-circle fa-lg"></i>
                </div>
            </div>
            <?php
                echo $this->Form->input('Images.', array(
                    'type' => 'file',
                    'label' => false,
                    'class' => 'form-control-file file-input',
                    'accept' => 'image/*',
                    'required' => false,
                    'multiple'
                ));
            ?>
            </div>
        <?php endfor; ?>
    </div>
    <button type="button" class="btn btn-plus align-items-center"><i class="fas fa-plus-circle fa-3x"></i></button>

    <?php
        echo $this->Form->button('Update Post', array(
            'class' => 'btn btn-success mb-3 d-flex justify-content-end'
        ));
        echo $this->Form->end();
    ?>
</div>