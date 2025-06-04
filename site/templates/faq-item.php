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
        <h1>Forum Vraagstelling</h1>
      </header>
  </div>
</section>

<section class="article theme-dark">
  <div class="container">
    <article>
      <nav class="back">
        <a href="<?= $page->parent()->url() ?>">&larr; Terug naar alle vragen</a>
      </nav>
      <?php if ($page->answer()->value()): // check if exists ?>
        <div class="text">
          <h3>De vraag die gesteld werd is:</h3>
          <?= $page->question()->kt() ?>
          <h3>Antwoord:</h3>
          <?= $page->answer()->toBlocks() ?>
        </div>
      <?php else: // fallback ?>
        <div class="box box-warning">Deze pagina heeft nog geen content.</div>
      <?php endif ?>
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