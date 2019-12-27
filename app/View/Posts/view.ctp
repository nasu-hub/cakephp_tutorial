<?php echo $this->Html->css('post'); ?>
<?php echo $this->Html->script('post/view.js') ?>

<div class="container">
    <div class="images mt-4">
        <?php
            $base = $this->Html->url( "/files/image/attachment/" );
            $cnt = count($post['Image']);
        ?>
        <?php for ($i = 0; $i < $cnt; $i++) : ?>
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

    <div class="contents">
        <h1 class="my-3"><?php echo h($post['Post']['title']); ?></h1>
        <p><small>投稿日: <?php echo $post['Post']['created']; ?></small></p>
        <p>カテゴリ：<?php echo h($post['Category']['name']); ?></p>
        <ul class="blog-post-tag">
            <?php foreach ($post['Tag'] as $viewTag): ?>
                <li><a href="#"><?php echo h($viewTag['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
        <p><?php echo nl2br(h($post['Post']['body'])); ?></p>
    </div>
</div>