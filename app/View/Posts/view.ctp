<h1><?php echo h($post['Post']['title']); ?></h1>
<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>
<p>カテゴリ：<?php echo h($post['Category']['name']); ?></p>
<p>タグ：
    <?php
        foreach ($post['Tag'] as $viewTag) {
            echo '#', $viewTag['name'], '&ensp;';
        }
    ?>
</p>
<p><?php echo h($post['Post']['body']); ?></p>