<h2>Add New User</h2>
<?php 
echo $this->Form->create('User');	
echo $this->Form->input('first_name');
echo $this->Form->input('last_name');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end(__('Add User')); 
?>
    
    
<div class="subMenu">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
