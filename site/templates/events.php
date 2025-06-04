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
        <h1><?= $page->heroHeadline()->html()->or($page->title()->html()) ?></h1>
      </header>
  </div>
</section>

<section class="article theme-dark">
  <div class="container">
    <article>

      <div class="text">
        <h3>Geplande activiteiten</h3>
        <?php if (count($page->children()->template('event')) > 0): // check if exists ?>
          <table>
            <thead>
              <tr>
                <th>Type</th>
                <th>Titel</th>
                <th>Datum</th>
                <th>Locatie</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($page->children()->template('event')->sortBy('eventFrom', 'asc') as $event): ?>
                <?php
                  $currentDate = date('Y-m-d');
                  $eventStartDate = $event->eventFrom()->toDate('Y-m-d');
                  $eventEndDate = $event->eventTo()->toDate('Y-m-d');
                  if ($eventStartDate >= $currentDate || $eventEndDate >= $currentDate): ?>
                    <tr>
                      <td style="width:20%"><?= $event->eventType()->html() ?></td>
                      <td style="width:40%"><?= $event->title()->link() ?></td>
                      <td style="width:13%"><?= $event->eventFrom()->toDate('d/m/Y') ?> <?php if ($event->eventTo()->value()): // check if exists ?>- <?= $event->eventTo()->toDate('d/m/Y') ?><?php endif ?></td>
                      <td style="width:13%"><?= $event->eventLocation()->html() ?></td>
                      <td style="width:13%"><a href="<?= $event->url() ?>">Meer info</a></td>
                    </tr>
                  <?php endif ?>
              <?php endforeach ?>
            </tbody>
          </table>

            <h3>Voorbije activiteiten</h3>

          <table>
            <thead>
              <tr>
                <th>Type</th>
                <th>Titel</th>
                <th>Datum</th>
                <th>Locatie</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($page->children()->template('event')->sortBy('eventFrom', 'asc') as $event): ?>
              <?php
                $currentDate = date('Y-m-d');
                $eventStartDate = $event->eventFrom()->toDate('Y-m-d');
                if ($eventStartDate < $currentDate): ?>
                    <tr>
                      <td style="width:20%"><?= $event->eventType()->html() ?></td>
                      <td style="width:40%"><?= $event->title()->link() ?></td>
                      <td style="width:13%"><?= $event->eventFrom()->toDate('d/m/Y') ?> <?php if ($event->eventTo()->value()): // check if exists ?>- <?= $event->eventTo()->toDate('d/m/Y') ?><?php endif ?></td>
                      <td style="width:13%"><?= $event->eventLocation()->html() ?></td>
                      <td style="width:13%"><a href="<?= $event->url() ?>">Meer info</a></td>
                    </tr>
                  <?php endif ?>
              <?php endforeach ?>
            </tbody>
          </table>

        <?php else: // fallback ?>
          <div class="box box-warning">Deze pagina heeft nog geen content.</div>
        <?php endif ?>
      </div>
    </article>

  </div>
</section>

<?php snippet('partners') ?>

<?php endif ?>

<?php snippet('footer') ?>