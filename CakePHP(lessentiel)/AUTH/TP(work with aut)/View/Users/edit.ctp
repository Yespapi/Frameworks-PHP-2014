<h2>Create a User</h2>
<?php 
echo $this->Form->create('User');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('first_name');
echo $this->Form->input('last_name');
echo $this->Form->input('username');
echo $this->Form->end(__('Submit')); 
?>

<div class="subMenu">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
