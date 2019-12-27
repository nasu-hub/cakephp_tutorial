<?php echo $this->Html->css('post'); ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-sm-8 blog-main">
            <?php foreach ($posts as $post): ?>
                <div class="blog-post card mb-3">
                    <div>
                        <?php
                            $base = $this->Html->url( "/files/image/attachment/" );
                            // $cnt = count($post['Image']);
                            // for ($i = 0; $i < $cnt; $i++) {
                            //     echo $this->Html->image($base . $post['Image'][$i]["dir"] . "/" . $post['Image'][$i]["attachment"], array('width' => '100%'));
                            // }
                            if ($post['Image']) {
                            echo $this->Html->image($base . $post['Image'][0]["dir"] . "/" . $post['Image'][0]["attachment"], array('width' => '100%'));
                            };
                        ?>
                    </div>
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
                        <ul class="blog-post-tag">
                            <?php foreach ($post['Tag'] as $viewTag): ?>
                                <li><a href="#"><?php echo h($viewTag['name']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <p class="blog-post-body card-text"><?php echo nl2br(h($post['Post']['body'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php unset($post); ?>
        </div>
    </div>
</div>
<div class="my-3">
    <?php echo $this->element('pager') ?>
</div>

<?php echo $this->element('sql_dump'); ?>