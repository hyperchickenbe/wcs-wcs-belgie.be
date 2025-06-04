<section class="partners theme-light">
  <div class="container">
      <div><?php if (page('partners')->hasChildren()): // check if page has children ?>
        <?php foreach (page('partners')->children()->listed() as $partner): ?>
          <div><a target="_blank" href="<?= $partner->partnerUrl()->url() ?>"><img src="<?= $site->url() ?>/<?= $partner->images() ?>"></a></div>
        <?php endforeach ?>
      <?php else: // fallback ?>
        <?= page('partners')->fallback()->html() ?>
      <?php endif ?>
      </div>
  </div>
</section>