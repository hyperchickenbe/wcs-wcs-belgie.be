<?php snippet('header') ?>

<?php if ($query): // check if search is true ?>

  <section class="hero theme-dark" style="background-color:hsl(208, 39.3%, 37.5%)">
  <div class="container">
    <header>
      <h1>Zoekresultaten <?= $count > 0 ? "($count)" : '' ?></h1>
    </header>
  </div>
</section>

  <?php if ($count == 0): // check if true ?>

  <section class="article article-search theme-dark">
    <div class="container">
      <article class="text">
        <header>
          <h4>Geen resultaten gevonden voor: '<strong><?= $query ?></strong>'.</h4>
        </header>
      </article>
    </div>
  </section>

  <?php else: // fallback ?>

  <section class="article article-search theme-dark">
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

<?php if ($page->text()->value()): // check if exists ?>
<section class="theme-dark" style="padding-top: 6rem">
  <div class="container">
    <article>
        <div class="text">
          <?= $page->text()->toBlocks() ?>
        </div>
    </article>
  </div>
</section>
<?php endif ?>

<section class="article theme-dark" style="padding-bottom: 6rem">
  <div class="container">

    <?php foreach ($page->children()->listed() as $item): // get listed pages ?>
    <div class="wrapper grid">
        <div class="item flex">
          <header>
            <a href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
          </header>
        </div>
        <?php if($image = $item->cover()->toFile()): ?>
          <?= $image->crop(640, 480, 80) ?>
        <?php endif ?>
    </div>
    <?php endforeach ?>

  </div>
</section>

<?php snippet('partners') ?>

<?php endif ?>

<?php snippet('footer') ?>