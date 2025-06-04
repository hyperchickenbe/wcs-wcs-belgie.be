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
        ],
        'message' => [
            'rules' => ['required'],
            'message' => 'Schrijf uw bericht',
        ],
        'captcha' => [
            'rules' => ['required', 'num'],
            'message' => 'Please fill in the captcha field',
        ],
    ]);

    if ($kirby->request()->is('POST')) {
        $form
            ->honeypotGuard(['field' => 'website'])
            ->calcGuard(['field' => 'captcha'])
            ->emailAction([
                'to' => 'michiel.claes@noorderhart.be',
                'from' => 'noreply@wcs-belgie.be',
                'fromName' => 'WCS België',
                // Dynamically generate the subject with a template.
                'subject' => '[Website] Bericht van {{name}} ',
                'template' => 'contact-success-receiver',
            ])
            ->emailAction([
                'to' => 'kris.bernaerts@uzleuven.be',
                'from' => 'noreply@wcs-belgie.be',
                'fromName' => 'WCS België',
                // Dynamically generate the subject with a template.
                'subject' => '[Website] Bericht van {{name}} ',
                'template' => 'contact-success-receiver',
            ])
            ->logAction([
                'file' => $kirby->roots()->site().'/contact-form.log',
            ])
            ->emailAction([
                // Send the success email to the email address of the submitter.
                'to' => $form->data('email'),
                'from' => 'noreply@wcs-belgie.be',
                'fromName' => 'WCS België',
                // Set replyTo manually, else it would be set to the value of 'email'.
                'replyTo' => 'noreply@wcs-belgie.be',
                'subject' => 'Bedankt voor uw bericht!',
                // Use a template for the email body (see below).
                'template' => 'contact-success-sender',
            ]);

        if ($form->success()) {
            go(page('contact/contact-bedankt')->url());
        }
    }

    return compact('form', 'query', 'results', 'count');
};