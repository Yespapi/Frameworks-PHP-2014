<!-- File: /app/View/Items/view.ctp -->
<h1><?php echo h($item['Item']['title']); ?> (<?php echo h($item['Item']['year']); ?>)</h1>
<p><?php echo h($item['Category']['name']); ?></p>
<p>Length: <?php echo h($item['Item']['length']); ?></p>
<div><?php echo h($item['Item']['description']); ?></div>

<?php
echo $this->element('quote_block', array("quote"=>"Aly BA BA Coumba Nar"));
?>

<div class="itemDescription">
    
    <?php echo h($item['Item']['description']); ?>
    
</div>