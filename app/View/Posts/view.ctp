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

<?php
    $base = $this->Html->url( "/files/image/attachment/" );
    $cnt = count($post['Image']);
    for ($i = 0; $i < $cnt; $i++) {
        echo $this->Html->image( $base . $post['Image'][$i]["dir"] . "/" . $post['Image'][$i]["attachment"], array('width' => '400', 'height' => '300'));
    }

?>
