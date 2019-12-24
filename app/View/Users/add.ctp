<?php echo $this->Html->css('user'); ?>
<?php echo $this->Html->script('address/search.address.js') ?>
<div class="container">

	<div class="users form col-md-4">
	<?php
		echo $this->Form->create('User',  array(
            'inputDefaults' => array(
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
            )
		));
	?>
		<fieldset>
			<legend><h1 class="my-3">Add User</h1></legend>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->input('role', array(
				'options' => array(
					'admin' => 'Admin',
					'author' => 'Author'
				)
			));
			echo $this->Form->input('postalCode', array(
				'type' => 'text',
				'maxlength' => '7',
				'id' => 'zip',
				'placeholder' => '0123456'
			));
			echo $this->Form->input('prefecture', array(
				'type' => 'select',
				'empty' => '選択してください',
				'options' => $prefectures,
			));
			echo $this->Form->input('city', array(
				'type' => 'select',
				'empty' => '選択してください',
			));
			echo $this->Form->input('address');
		?>
		</fieldset>
		<?php
			echo $this->Form->button('Add User', array(
				'class' => 'btn btn-success my-3'
			));
			echo $this->Form->end();
		?>
	</div>
</div>
