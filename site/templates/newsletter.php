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
      <script>
      var fm = (function () {
        return {
          load: function () {
            var e = document,
              t = e.getElementById("iframe_flxml_form"),
              n = e.getElementById("flx-styles"),
              r = n ? n.innerHTML : "";
            t
              ? t.contentWindow.postMessage(r, "https://return.flexmail.eu")
              : alert("Flexmail: Frame not found!");
          },
        };
      })();
    </script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;900&display=swap');
</style>

<style id="flx-styles">
    /* Form labels */
    #flxml_frm > table > tbody > tr > td:nth-child(1) { ; }

    /* Form input elements */
    #flxml_frm input[type="text"] { ; }

    /* Form submit button */
    #flxml_frm button[type="submit"] { 
        background-color: #0f2233;
        background-image: none;
        text-transform: uppercase;
    }
        #flxml_frm button[type="submit"]:hover {
        background-color: #122a3f;
        } 
    
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

<?php if ($query): // check if search is true ?>

  <section class="hero theme-dark" style="background-color:hsl(208, 39.3%, 37.5%)">
  <div class="container">
    <header>
      <h1>Zoekresultaten <?= $count > 0 ? "($count)" : '' ?></h1>
    </header>
  </div>
</section>

  <?php if ($count == 0): // check if true ?>

  <section class="article theme-dark">
    <div class="container">
      <article class="text">
        <header>
          <h4>Geen resultaten gevonden voor: '<strong><?= $query ?></strong>'.</h4>
        </header>
      </article>
    </div>
  </section>

  <?php else: // fallback ?>

  <section class="article theme-dark">
    <div class="container">
      <article class="text">
        <header>
          <h4>Gezocht op: '<strong><?= $query ?></strong>'</h4>
        </header>
        <ul>
          <?php foreach ($results as $result): ?>
          <li>
            <a href="<?= $result->url() ?>">
              <?= $result->title() ?>
            </a>
          </li>
          <?php endforeach ?>
        </ul>
      </article>
    </div>
  </section>

  <?php endif ?>

<?php else: // fallback ?>

<section class="hero theme-dark" style="background-color:hsl(208, 39.3%, 37.5%)">
  <div class="container">
      <header>
        <h1><?= $page->heroHeadline()->html()->or($page->title()->html()) ?></h1>
      </header>
  </div>
</section>

<section class="article theme-dark">
  <div class="container">
    <article>
      <div class="text">
        <?php snippet('form-error') ?>
        <?php if ($page->text()->value()): // check if exists ?>
          <?= $page->text()->toBlocks() ?>
        <?php else: // fallback ?>
          <div class="box box-warning">Deze pagina heeft nog geen content.</div>
        <?php endif ?>


        <section class="newsletter-form">
          <header>
            <h2>Formulier</h2>
            <div class="box box-info"><?= $page->formRequired()->html() ?></div>
          </header>

    <iframe
      id="iframe_flxml_form"
      onload="javascript: fm.load();"
      src="https://return.flexmail.eu/page/opt-in-form/eyJ0eXAiOiJKV1QiLCJhbGciOiJFZERTQSJ9.eyJzdWIiOiJyZXR1cm4vb3B0LWluIiwiaWF0IjoxNzQxMTE5NzMyLjcyMTkzNywiYWlkIjo3NDg5NCwib3B0ZnBrIjoiMjA2OTQwZmE1MDgxNDViN2I5ZDUyZmI5ZmNiM2ZkNzYxMDU3In0.UX_hgV1pruv7xQ2egtM13df8l6gVb8JWwhMg_tSYy1XXx-4JwNsr43gTH6C5YSU0m0ke7_0-ZXTeF2jkN-dKAw"
      frameborder="0"
      scrolling="no"
      style="overflow: hidden; height: 345px; width: 100%"
      height="100%"
      width="100%"
    ></iframe>
        </section>
      </div>
    </article>

    <aside>
      <?php snippet('agenda') ?>
      <?php snippet('subscribe') ?>
    </aside>

  </div>
</section>

<?php snippet('partners') ?>

<?php endif ?>

<?php snippet('footer') ?>