<div class="pager">
  <ul class="pagination justify-content-center">
    <?php
      echo $this->Paginator->prev('&lsaquo;	&ensp; 前へ', array('class' => 'pre disabled', 'tag' => 'li', 'escape' => false));
      echo $this->Paginator->numbers($pager_numbers);
      echo $this->Paginator->next('次へ	&ensp; &rsaquo;', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
    ?>
  </ul>
</div>