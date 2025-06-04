<?php

use Uniform\Form;

return function ($site, $kirby)
{

    $query   = get('q');
    $results = $site->search($query, 'title|text');
    $count   = count($results);
    $results = $results->paginate(20);

    $form = new Form([
        'name' => [
            'rules' => ['required'],
            'message' => 'Vul een voornaam in',
        ],
        'surname' => [
            'rules' => ['required'],
            'message' => 'Vul een achternaam in',
        ],
        'email' => [
            'rules' => ['required', 'email'],
            'message' => 'Vul een e-mail adres in',
        ]
    ]);

    if ($kirby->request()->is('POST')) {
        $form
            ->honeypotGuard(['field' => 'website'])
            ->emailAction([
                'to' => 'michiel.claes@noorderhart.be',
                'from' => 'noreply@wcs-belgie.be',
                'fromName' => 'WCS België',
                // Dynamically generate the subject with a template.
                'subject' => '[Mailinglijst] {{name}} heeft zich ingeschreven',
                'template' => 'newsletter-success-receiver',
            ])
            ->logAction([
                'file' => $kirby->roots()->site().'/newsletter-form.log',
            ])
            ->emailAction([
                // Send the success email to the email address of the submitter.
                'to' => $form->data('email'),
                'from' => 'noreply@wcs-belgie.be',
                'fromName' => 'WCS België',
                // Set replyTo manually, else it would be set to the value of 'email'.
                'replyTo' => 'noreply@wcs-belgie.be',
                'subject' => 'Bedankt voor uw interesse!',
                // Use a template for the email body (see below).
                'template' => 'newsletter-success-sender',
            ]);

        try {
            $id = Db::insert('newsletter', [
                'voornaam' => $form->data('name'),
                'achternaam' => $form->data('surname'),
                'email'=> $form->data('email'),
            ]);
            dump($bool);
            go('/');
        } catch (Exception $e) {
            $error = true;
        }

        if ($form->success()) {
            go(page('mailinglijst/mailinglijst-bedankt')->url());
        }
    }

    return compact('form', 'query', 'results', 'count');
};