<?php snippet('header') ?>

<section class="hero theme-dark" style="background-color:hsl(208, 39.3%, 37.5%)">
  <div class="container">
      <header>
        <h1>Zoekresultaten</h1>
      </header>
  </div>
</section>

<section class="article theme-dark">
  <div class="container">
    <article class="text">
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

<?php snippet('partners') ?>

<?php snippet('footer') ?>