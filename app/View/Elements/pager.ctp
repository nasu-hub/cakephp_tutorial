<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center pagers">
    <?php
      echo $this->Paginator->prev('&lsaquo;', array('class' => 'page-item page-link disabled', 'tag' => 'li', 'escape' => false));
      echo $this->Paginator->numbers($pager_numbers);
      echo $this->Paginator->next('&rsaquo;', array('class' => 'page-item page-link disabled', 'tag' => 'li', 'escape' => false));
    ?>
  </ul>
</nav>