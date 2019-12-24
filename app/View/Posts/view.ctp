<?php echo $this->Html->css('post'); ?>
<?php echo $this->Html->script('post/view.js') ?>

<div class="d-flex">
    <?php
        $base = $this->Html->url( "/files/image/attachment/" );
        $cnt = count($post['Image']);
        for ($i = 0; $i < $cnt; $i++) :
    ?>
        <a class="modal-open" href="">
            <?php
                echo $this->Html->image( $base . $post['Image'][$i]["dir"] . "/" . $post['Image'][$i]["attachment"], array('class' => 'img-thumnail', 'alt' => 'img'));
            ?>
        </a>
    <?php endfor; ?>
</div>
<div class="modal">
    <div class="modal-bg modal-close"></div>
    <div id="slide" class="modal-content">
        <?php for ($i = 0; $i < $cnt; $i++): ?>
            <?php
                echo $this->Html->image( $base . $post['Image'][$i]["dir"] . "/" . $post['Image'][$i]["attachment"], array('class' => 'img-modal', 'alt' => 'img'));
            ?>
        <?php endfor; ?>
        <div class="wr-nav">
            <?php if($cnt > 1): ?>
                <div id="nav-l"><a href="#"><i class="fas fa-angle-left fa-2x"></i></a></div>
                <div id="nav-r"><a href="#"><i class="fas fa-angle-right fa-2x"></i></a></div>
            <?php endif; ?>
        </div>
        <a class="modal-close"><i class="fas fa-times fa-2x"></i></a>
    </div>
</div>

<div class="wrapper">
    <h1 class="my-3"><?php echo h($post['Post']['title']); ?></h1>
    <p><small>投稿日: <?php echo $post['Post']['created']; ?></small></p>
    <p>カテゴリ：<?php echo h($post['Category']['name']); ?></p>
    <p>
        <?php foreach ($post['Tag'] as $viewTag): ?>
            <button type="button" class="btn btn-light btn-sm blog-post-tag "><?php echo h($viewTag['name']); ?></button>
        <?php endforeach; ?>
    </p>
    <p><?php echo nl2br(h($post['Post']['body'])); ?></p>
</div>