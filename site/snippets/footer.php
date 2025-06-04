</main>

<footer class="site-footer theme-dark">
  <div class="container">
    <nav>
      <h3>Menu</h3><?php foreach ($site->children()->listed() as $item): ?><?= $item->title()->link() ?><?php endforeach ?></nav>
    <nav>
      <h3>WCS</h3>
      <?php if (page('over-ons')): // check if true ?><a href="<?= page('over-ons')->url() ?>"><?= page('over-ons')->title() ?></a><?php endif ?>
      <?php if (page('jobs')): // check if true ?><a href="<?= page('jobs')->url() ?>"><?= page('jobs')->title() ?></a><?php endif ?>
      <?php if (page('agenda')): // check if true ?><a href="<?= page('agenda')->url() ?>"><?= page('agenda')->title() ?></a><?php endif ?>
      <?php if (page('contact')): // check if true ?><a href="<?= page('contact')->url() ?>"><?= page('contact')->title() ?></a><?php endif ?>
    </nav>
    <nav>
      <h3>Abonneer</h3>
      <a href="<?= page('page://j4jEIKkLEeXIsAQU')->url() ?>"><?= page('page://j4jEIKkLEeXIsAQU')->title() ?></a>
      <a href="<?= page('page://biLoG716JtfxyabL')->url() ?>"><?= page('page://biLoG716JtfxyabL')->title() ?></a>
    </nav>
    <section>
      <div>&copy; <?= date('Y') ?> <?= $site->copyright()->html()->or($site->title()->html()) ?> | <?php if (page('privacyverklaring')): // check if exists ?><?= page('privacyverklaring')->title()->link() ?><?php endif ?>
        <ul class="social">
        <?php foreach ($site->social()->toStructure() as $social): ?>
          <li><a href="<?= $social->url() ?>"><img loading="lazy" src="<?= $social->logo()->toFile()->url() ?>" width="" height="" alt=""></a></li>
        <?php endforeach ?>
      </ul>
      </div>
      <a class="logo" href="<?= $site->url() ?>">
        <img src="content/logo-neutral.svg">
      </a>
    </section>
  </div>
</footer>

<?php snippet('snipcart') ?>

</body>

</html>