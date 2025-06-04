<?php if($block->text()->isNotEmpty()): // check if exists ?>
  <div class="box box-<?= $block->boxType() ?>">
    <?= $block->text() ?>
  </div>
<?php endif; ?>