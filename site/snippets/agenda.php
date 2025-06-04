<div class="agenda aside">
  <header>
    <h3><?= page('agenda')->title() ?></h3>
  </header>

  <?php if (page('agenda')->hasChildren()): // check if page has children ?>
    <ul>
      <?php foreach (page('agenda')->children()->listed()->sortBy('eventFrom', 'asc') as $event): ?>
        <?php
          $currentDate = date('Y-m-d');
          $eventStartDate = $event->eventFrom()->toDate('Y-m-d');
          $eventEndDate = $event->eventTo()->toDate('Y-m-d');
          if ($eventStartDate >= $currentDate || $eventEndDate >= $currentDate): ?>
          <li><?= $event->title()->link() ?> <span class="date"><?= $event->eventFrom()->toDate('d/m/Y') ?><?= $event->eventTo()->isNotEmpty() ? ' - '.$event->eventTo()->toDate('d/m/Y') : '' ?> - <?= $event->eventLocation()->html() ?></span></li>
        <?php endif ?>
      <?php endforeach ?>
    </ul>
    <footer>
      <a href="<?= page('agenda')->url() ?>">Alle evenementen</a>
    </footer>

    <?php else: // fallback ?>
      <?= page('agenda')->otherFallback()->html() ?>
  <?php endif ?>
</div>