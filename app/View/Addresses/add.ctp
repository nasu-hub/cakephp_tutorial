<div class="container">
    <h1 class="my-3">Import CSV</h1>
    <?php
        echo $this->Form->create('csv', array(
            'type' => 'file',
            'onsubmit' => 'return confirm("データを更新します。本当によろしいですか？");'
        ));
        echo $this->Form->input('csv', array(
            'type' => 'file',
            'accept' => '.csv',
            'label' => false
        ));
        echo $this->Form->button('Import', array(
            'class' => 'btn btn-info my-3'
        ));
        echo $this->Form->end();
    ?>
</div>
<?php echo $this->element('sql_dump'); ?>