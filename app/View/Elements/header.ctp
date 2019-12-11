<?php echo $this->Html->css('header'); ?>
<?php echo $this->Html->script('header.js') ?>

<nav class="nav d-inline-flex align-items-center">
    <?php
        echo $this->Html->link('Home',array(
            'controller' => 'posts',
            'action' => 'index'
        ));
        echo $this->Html->link('Add Post',array(
            'controller' => 'posts',
            'action' => 'add'
        ));
        echo $this->Html->link('Import CSV',array(
            'controller' => 'addresses',
            'action' => 'add'
        ));
        if (isset($userForHeader)) {
            echo $this->Html->link('Account', array(
                'controller' => 'users',
                'action' => 'view', $userForHeader['id']
            ));
            echo $this->Html->link('Logout', array(
                'controller' => 'users',
                'action' => 'logout'
            ));
        } else {
            echo $this->Html->link('Login',array(
                'controller' => 'users',
                'action' => 'login'
            ));
            echo $this->Html->link('Signup',array(
                'controller' => 'users',
                'action' => 'add'
            ));
        }
    ?>

    <div class="user-status col text-right">
        <span><?php

            if (isset($userForHeader['username'])) {
                echo "こんにちは！{$userForHeader['username'] }さん。";
            }
        ?></span>
    </div>
    <div class="icon-search"><i class="fas fa-search fa-2x"></i></div>
    <?php echo $this->element('searchForm') ?>
</nav>