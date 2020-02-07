<?php foreach ($this->articles as $article) :?>
<?= $this->insert('article', $article)?>
<?php endforeach;?>
