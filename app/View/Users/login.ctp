<?php echo $this->Html->css('common'); ?>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12 p-4">
                    <?php
                        echo $this->Form->create('User', array(
                            'inputDefaults' => array(
                                'div' => array('class' => 'form-group'),
                                'class' => 'form-control',
                            )
                        ));
                    ?>
                    <h3 class="text-center">Login</h3>
                    <?php
                        echo $this->Form->input('username');
                        echo $this->Form->input('password');
                        echo $this->Form->input('remember', array(
                            'type' => 'checkbox',
                            'label' => 'Remember me',
                            'class' => 'form-check form-check-inline'
                        ));
                        echo $this->Form->button('Login', array(
                            'class' => 'btn btn-login mb-3 d-flex justify-content-center'
                        ));
                        echo $this->Form->end();
                        echo $this->Html->link('Register here',array(
                            'controller' => 'users',
                            'action' => 'add',
                            ),
                            array(
                                'class' => 'd-flex justify-content-center'
                            )
                        );
                    ?>
                    <!-- <div class="form-group">
                        <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                        <?php //echo $this->Form->end(__('Login')); ?>
                    </div>
                    <div id="register-link" class="text-right">
                        <a href="#" class="text-info">Register here</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>