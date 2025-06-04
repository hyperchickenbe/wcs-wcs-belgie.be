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

     <section class="newsletter-form">
        <header>
          <h2>Formulier</h2>
          <div class="box box-info"><?= $page->formRequired()->html() ?></div>
        </header>

        <form action="<?= $page->url() ?>" method="post">
          <div class="flex">
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
          </div>
          <div class="honeypot">
            <label><?= $page->formHoneypot()->html() ?></label> <span>*</span>
                <?php echo honeypot_field('website', 'field'); ?>
          </div>
          <div class="flex">
            <div>
              <label for="street"><?= $page->labelStreet()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('street')): ?> class="error"<?php endif; ?> name="street" type="text" value="<?= $form->old('street') ?>">
              <?php snippet('form/error', ['field' => 'street']) ?>
            </div>
            <div>
              <label for="number"><?= $page->labelNumber()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('number')): ?> class="error"<?php endif; ?> name="number" type="text" value="<?= $form->old('number') ?>">
              <?php snippet('form/error', ['field' => 'number']) ?>
            </div>
          </div>
          <div class="flex">
            <div>
              <label for="postalcode"><?= $page->labelPostalcode()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('postalcode')): ?> class="error"<?php endif; ?> name="postalcode" type="text" value="<?= $form->old('postalcode') ?>">
              <?php snippet('form/error', ['field' => 'postalcode']) ?>
            </div>
            <div>
              <label for="city"><?= $page->labelCity()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('city')): ?> class="error"<?php endif; ?> name="city" type="text" value="<?= $form->old('city') ?>">
              <?php snippet('form/error', ['field' => 'city']) ?>
            </div>
          </div>
          <div class="flex">
            <div>
              <label for="phone"><?= $page->labelPhone()->html() ?></label>
              <input<?php if ($form->error('phone')): ?> class="error"<?php endif; ?> name="phone" type="tel" value="<?= $form->old('phone') ?>">
              <?php snippet('form/error', ['field' => 'phone']) ?>
            </div>
            <div>
              <label for="email"><?= $page->labelEmail()->html() ?></label> <span>*</span>
              <input<?php if ($form->error('email')): ?> class="error"<?php endif; ?> name="email" type="email" class="field" value="<?= $form->old('email') ?>">
                  <?php snippet('form/error', ['field' => 'email']) ?>
            </div>
          </div>
          <div>
            <label for="workplace"><?= $page->labelWorkplace()->html() ?></label> <span>*</span>
            <input<?php if ($form->error('workplace')): ?> class="error"<?php endif; ?> name="workplace" type="text" value="<?= $form->old('workplace') ?>">
            <?php snippet('form/error', ['field' => 'workplace']) ?>
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