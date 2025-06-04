<!doctype html>
<html class="no-js" lang="nl" data-theme="light-branded">

<head>
  <meta charset="utf-8">
  <title>
    <?php if ($page->isHomePage()): // check if homepage ?>
      <?= $site->title()->html() ?> | <?= $page->marketingTitle()->html()->or($page->heroHeadline()->html()) ?>
    <?php else: ?>
      <?= $page->marketingTitle()->html()->or($page->title()->html()) ?> | <?= $site->title()->html() ?>
    <?php endif ?>
  </title>
  <meta name="description" content="<?= $page->marketingDescription()->html() ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= css(['assets/css/index.css']) ?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;900&display=swap');
</style>

<?php snippet('matomo') ?>

</head>

<body class="page-<?= $page->template() ?>">

<?php if ($site->notificationToggle()->toBool() === true): // check if true ?>
<section class="notification-bar">
  <div class="container">
    <p><?= $site->notificationText()->html() ?></p>
    <?php if ($site->notificationLink()->value()): // check if exists ?>
      <a class="button" href="<?= $site->notificationLink()->url() ?>"><?= $site->notificationLinkText()->html()->or($site->notificationLink()->html()) ?></a>
    <?php endif ?>
  </div>
</section>
<?php endif ?>

<nav class="top-nav theme-dark">
  <div class="container">
    <ul>
      <?php if (page('over-ons')): // check if true ?><li><a href="<?= page('over-ons')->url() ?>"><?= page('over-ons')->title() ?></a></li><?php endif ?>
      <?php if (page('missie-visie')): // check if true ?><li><a href="<?= page('missie-visie')->url() ?>"><?= page('missie-visie')->title() ?></a></li><?php endif ?>
      <?php if (page('agenda')): // check if true ?><li><a href="<?= page('agenda')->url() ?>"><?= page('agenda')->title() ?></a></li><?php endif ?>
      <?php if (page('contact')): // check if true ?><li><a href="<?= page('contact')->url() ?>"><?= page('contact')->title() ?></a></li><?php endif ?>
      <li>
        <form class="search">
          <svg viewBox="0 0 30 30"><path d="M24.339 26c.957 0 1.661-.743 1.661-1.68 0-.434-.15-.857-.473-1.177l-5.018-4.994a8.863 8.863 0 001.65-5.155c0-4.948-4.085-8.994-9.08-8.994C8.095 4 4 8.046 4 12.994c0 4.949 4.084 8.995 9.08 8.995a9.083 9.083 0 004.983-1.486l5.053 5.017c.334.32.761.48 1.223.48zm-11.26-6.411c-3.657 0-6.656-2.972-6.656-6.595 0-3.623 3-6.594 6.656-6.594 3.657 0 6.657 2.971 6.657 6.594s-3 6.595-6.657 6.595z"></path></svg>
          <input type="search" name="q" value="<?= html($query) ?>" placeholder="Zoeken...">
          <button type="submit">Submit</button>
        </form>
      </li>
    </ul>
  </div>
</nav>

<header class="site-header theme-light">
  <div class="container">
    <a class="logo" href="<?= $site->url() ?>">
      <img src="content/logo-kleur.svg">
    </a>
    <nav class="site-nav">
      <ul>
        <?php foreach ($site->children()->listed() as $item): ?>
          <li><a <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>"><?= $item->title()->html() ?></a></li>
        <?php endforeach ?>
      </ul>
    </nav>
  </div>
</header>

<main>