<?php if ($form->error($field)): ?>
  <p class="error"><?php echo implode('<br>', $form->error($field)) ?></p>
<?php endif; ?>