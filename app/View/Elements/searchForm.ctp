<div class="search-box">
    <fieldset class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
            <legend><h2>Search</h2></legend>
            <?php
                echo $this->Form->create('Post', array(
                    'url' => array_merge(array('action' => 'index'), $this->params['pass']),
                    'novalidate' => true,
                    'inputDefaults' => array(
                        'div' => array('class' => 'form-group'),
                        'class' => 'form-control',
                    )
                ));

                echo $this->Form->input('category_id', array(
                    'type' => 'select',
                    'label' => 'カテゴリ',
                    'options' => $categories,
                    'empty' => '選択してください'
                ));

                echo $this->Form->input('title', array(
                    'label' => 'タイトル'
                ));

                echo $this->Form->input('tag_id', array(
                    'type' => 'select',
                    'label' => 'タグ',
                    'multiple' => 'checkbox',
                    'options' => $tags,
                ));

                echo $this->Form->button('検索', array(
                    'class' => 'btn btn-info mb-3'
                ));

                echo $this->Form->button('検索条件をクリア', array(
                    'type'=>'reset',
                    'class' => 'btn btn-secondary btn-sm mb-3 btn-reset'
                ));

                echo $this->Form->end();
            ?>
            </div>
            <div class="col"></div>
        </div>
    </fieldset>
</div>