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
        <h1><?= $page->eventHeadline()->html()->or($page->title()->html()) ?></h1>
      </header>
  </div>
</section>

<section class="article theme-dark">
  <div class="container">
    <article>
      <nav class="back">
        <a href="<?= $page->parent()->url() ?>">&larr; Terug naar agenda</a>
      </nav>

      <div class="text">

        <h3>Datum</h3>
        <?php if ($page->eventFrom()->value()): // check if exists ?>
          <p><?= $page->eventFrom()->toDate('d/m/Y') ?> <?php if ($page->eventTo()->value()): // check if exists ?>- <?= $page->eventTo()->toDate('d/m/Y') ?><?php endif ?></p>
        <?php endif ?>

        <h3>Locatie</h3>
        <?php if ($page->eventLocation()->value()): // check if exists ?>
          <p><?= $page->eventLocation()->html() ?></p>
        <?php endif ?>

        <?php if ($page->text()->value()): // check if exists ?>
          <h3>Beschrijving</h3>
          <?= $page->text()->toBlocks() ?>
        <?php endif ?>

        <?php if ($page->documents()->template('document')->first()): // check if exists ?>
          <?php if (count($page->documents()->template('document')) > 1): // count ?>
            <h3>Documenten</h3>
          <?php else: ?>
            <h3>Document</h3>
          <?php endif ?>

          <ul>
            <?php foreach ($page->documents()->template('document') as $document): ?>
              <li><a href="<?= $document->url() ?>"><?= $document->name() ?></a> (<?= $document->extension() ?> - <?= $document->niceSize() ?>)</li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>

        <?php if ($page->eventGoogleMaps()->value()): // check if exists ?>
          <iframe src="<?= $page->eventGoogleMaps()->url() ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <?php endif ?>

        <?php if ($page->eventLink()->value()): // check if exists ?>
          <h3>Meer info</h3>
          <p><a href="<?= $page->eventLink()->url() ?>"><?= $page->eventLink()->url() ?></a></p>
        <?php endif ?>

        <?php if ($page->eventToggle()->toBool() === true && $page->eventPriceMember()->value()): // check if true ?>
          <h3>Inschrijven</h3>
          <table>
            <thead>
              <tr>
                <th>Type</th>
                <th>Prijs</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($page->eventPriceMember()->value()): // check if exists ?>
                <tr>
                  <td>Lid</td>
                  <td><?= $page->eventPriceMember()->html() ?> EUR</td>
                </tr>
              <?php endif ?>
              <?php if ($page->eventPriceStudent()->value()): // check if exists ?>
                  <tr>
                    <td>Student</td>
                    <td><?= $page->eventPriceStudent()->html() ?> EUR</td>
                  </tr>
                <?php endif ?>
              <?php if ($page->eventPrice()->value()): // check if exists ?>
                  <tr>
                    <td>Niet lid / niet student</td>
                    <td><?= $page->eventPrice()->html() ?> EUR</td>
                  </tr>
                <?php endif ?>
            </tbody>
          </table>
          <?php

          $priceM = (string)$page->eventPriceMember()->or('0');
          $priceM_int = intval($priceM);

          $priceS = (string)$page->eventPriceStudent()->or('0');
          $priceS_int = intval($priceS);

          $price = (string)$page->eventPrice()->or('0');
          $price_int = intval($price);

          $difS = $priceS - $priceM;
          $difNonLS = $price - $priceM;
          ?>
                              <button class="snipcart-add-item buy"
                      data-item-id="event-<?= $page->eventFrom()->toDate('Y/m/d') ?>"
                      data-item-name="Inschrijving: <?= $page->heroHeadline()->html()->or($page->title()->html()) ?>"
                      data-item-price="<?= $page->eventPriceMember()->html() ?>"
                      data-item-description="Datum: <?= $page->eventFrom()->toDate('d/m/Y') ?><?php if ($page->eventTo()->value()): // check if exists ?>- <?= $page->eventTo()->toDate('d/m/Y') ?><?php endif ?> | Locatie: <?= $page->eventLocation()->html() ?>"
                      data-item-image="<?= $site->url() ?>/content/logo-kleur.svg"
                      data-item-max-quantity="1"
                      data-item-custom1-name="Ik ben..."
                      data-item-custom1-options="Lid|Student (+<?= $difS ?> EUR)[+<?= $difS ?>.00]|Niet lid / niet student (+<?= $difNonLS ?> EUR)[+<?= $difNonLS ?>.00]"
                    >
                      Koop ticket
                    </button>
        <?php endif ?>
      </div>

    </article>
  </div>
</section>

<?php snippet('partners') ?>

<?php endif ?>

<?php snippet('footer') ?>