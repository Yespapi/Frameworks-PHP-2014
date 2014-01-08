<h2>Users</h2>
<p><?php echo $this->Html->link('Add User', array('action' => 'add')); ?></p>

<table cellpadding="0" cellspacing="0">
	<tr>
        <th><?php echo $this->Paginator->sort('first_name'); ?></th>
        <th><?php echo $this->Paginator->sort('last_name'); ?></th>
        <th><?php echo $this->Paginator->sort('username'); ?></th>        
        <th>Actions</th>
	</tr>
	<?php foreach ($users as $user): ?>
        <tr>            
            <td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?> | 
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?> | 
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
</div>
