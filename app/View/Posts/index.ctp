<?php echo $this->Html->css('post'); ?>
<!-- <?php echo $this->Html->script('post/image.slide.js') ?> -->

<div class="container">
    <div class="blog-header">
        <h1 class="blog-title my-3">Cooking Blog</h1>
    </div>
    <div class="row">
        <div class="col-sm-8 blog-main">
            <?php foreach ($posts as $post): ?>
                <div class="blog-post card border-secondary mb-3">
                    <div>
                        <?php
                            $base = $this->Html->url( "/files/image/attachment/" );
                            $cnt = count($post['Image']);
                            for ($i = 0; $i < $cnt; $i++) {
                                // echo '<p class="wrapper-img">';
                                echo $this->Html->image( $base . $post['Image'][$i]["dir"] . "/" . $post['Image'][$i]["attachment"], array('width' => '100%'));
                                // echo '</p>';
                            }
                        ?>
                    </div>
                    <!-- <div class="wrapper">
                        <p id="nav-r"><a href="#">次へ</a></p>
                        <p id="nav-l"><a href="#">戻る</a></p> -->
                    <div class="card-body">
                        <div class="d-flex bd-highlight mb-3">
                            <h2 class="blog-post-title card-title mr-auto">
                                <?php
                                    echo $this->Html->link(
                                        $post['Post']['title'],
                                        array('action' => 'view', $post['Post']['id'])
                                    );
                                ?>
                            </h2>
                            <button type="button" class="btn btn-sm mb-3 mr-3 btn-action">
                                <?php
                                    echo $this->Html->link(
                                        'Edit',
                                        array('action' => 'edit', $post['Post']['id'])
                                    );
                                ?>
                            </button>
                            <button type="button" class="btn btn-sm mb-3 btn-action">
                                <?php
                                    echo $this->Form->postLink(
                                        'Delete',
                                        array('action' => 'delete', $post['Post']['id']),
                                        array('confirm' => 'Are you sure?')
                                    );
                                ?>
                            </button>
                        </div>
                        <p class="blog-post-created">投稿日：<?php echo $post['Post']['created']; ?></p>
                        <p class="blog-post-category">カテゴリ：<?php echo $post['Category']['name']; ?></p>
                        <p>
                            <?php foreach ($post['Tag'] as $viewTag): ?>
                                <button type="button" class="btn btn-light btn-sm blog-post-tag "><?php echo h($viewTag['name']); ?></button>
                            <?php endforeach; ?>
                        </p>
                        <p class="blog-post-body card-text"><?php echo nl2br(h($post['Post']['body'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php unset($post); ?>
        </div>
        <!-- <div class="col-sm-3 col-cm-offset-1 blog-sidebar">
            <?php //echo $this->element('searchForm') ?>
        </div> -->
    </div>
</div>
<div class="my-3">
    <?php echo $this->element('pager') ?>
</div>

<?php echo $this->element('sql_dump'); ?>