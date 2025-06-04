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
        'street' => [
            'rules' => ['required'],
            'message' => 'Vul een straat in',
        ],
        'number' => [
            'rules' => ['required'],
            'message' => 'Vul een huisnummer in',
        ],
        'postalcode' => [
            'rules' => ['required'],
            'message' => 'Vul een postcode in',
        ],
        'city' => [
            'rules' => ['required'],
            'message' => 'Vul een plaats in',
        ],
        'phone' => [],
        'email' => [
            'rules' => ['required', 'email'],
            'message' => 'Vul een e-mail adres in',
        ],
        'workplace' => [
            'rules' => ['required'],
            'message' => 'Vul een werkplek in',
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
                'subject' => '[Wondzorgtijdschrift] {{name}} heeft zich ingeschreven',
                'template' => 'magazine-success-receiver',
            ])
            ->logAction([
                'file' => $kirby->roots()->site().'/magazine-form.log',
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
                'template' => 'magazine-success-sender',
            ]);

        try {
            $id = Db::insert('magazine', [
                'voornaam' => $form->data('name'),
                'achternaam' => $form->data('surname'),
                'straat' => $form->data('street'),
                'huisnummer' => $form->data('number'),
                'postcode' => $form->data('postalcode'),
                'plaats' => $form->data('city'),
                'telefoon' => $form->data('phone'),
                'email'=> $form->data('email'),
                'werkplek'=> $form->data('workplace'),
            ]);
            dump($bool);
            go('/');
        } catch (Exception $e) {
            $error = true;
        }

        if ($form->success()) {
            go(page('wondzorgtijdschrift/wondzorgtijdschrift-bedankt')->url());
        }
    }

    return compact('form', 'query', 'results', 'count');
};