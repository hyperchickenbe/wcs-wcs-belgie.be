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
        <?php snippet('form-error') ?>
        <?php if ($page->text()->value()): // check if exists ?>
          <?= $page->text()->toBlocks() ?>
        <?php else: // fallback ?>
          <div class="box box-warning">Deze pagina heeft nog geen content.</div>
        <?php endif ?>

        <section class="contact-form">
          <header>
            <h2>Formulier</h2>
            <div class="box box-info"><?= $page->formRequired()->html() ?></div>
          </header>

          <form action="<?= $page->url() ?>" method="post">
            <div>
              <label for="name"><?= $page->labelName()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('name')): ?> class="error"<?php endif; ?> name="name" type="text" value="<?= $form->old('name') ?>">
              <?php snippet('form/error', ['field' => 'name']) ?>
            </div>
            <div>
              <label for="surname"><?= $page->labelSurName()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('surname')): ?> class="error"<?php endif; ?> name="surname" type="text" value="<?= $form->old('surname') ?>">
              <?php snippet('form/error', ['field' => 'surname']) ?>
            </div>
            <div class="honeypot">
              <label><?= $page->formHoneypot()->html() ?></label> <span>*</span>
              <?php echo honeypot_field('website', 'field'); ?>
            </div>
            <div>
              <label for="email"><?= $page->labelEmail()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('email')): ?> class="error"<?php endif; ?> name="email" type="email" class="field" value="<?= $form->old('email') ?>">
              <?php snippet('form/error', ['field' => 'email']) ?>
            </div>
            <div>
              <label for="message"><?= $page->labelMessage()->html() ?></label> <span>*</span>
              <textarea<?php if ($form->error('message')): ?> class="error"<?php endif; ?> name="message" rows="7" cols="50"><?= $form->old('message') ?></textarea>
              <?php snippet('form/error', ['field' => 'message']) ?>
            </div>
            <div>
              <label>Rekensom (anti-spam) *<br> <?php echo uniform_captcha() ?></label>
              <?php echo captcha_field('captcha', 'field'); ?>
            </div>
            <div>
              <?= $page->notice()->html() ?>
            </div>
            <div>
              <?php echo csrf_field() ?>
              <input type="submit" value="<?= $page->nextButton()->html() ?>" class="btn">
              <?php snippet('form/error', ['field' => \Uniform\Actions\EmailAction::class]) ?>
            </div>
          </form>
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