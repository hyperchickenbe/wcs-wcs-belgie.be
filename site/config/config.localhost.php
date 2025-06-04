<?php
return [
  'debug' => true,
  'routes' => [
    [
      'pattern' => 'sitemap.xml',
      'action'  => function() {
          $pages = site()->pages()->index();

          // fetch the pages to ignore from the config settings,
          // if nothing is set, we ignore the error page
          $ignore = kirby()->option('sitemap.ignore', ['error']);

          $content = snippet('sitemap', compact('pages', 'ignore'), true);

          // return response with correct header type
          return new Kirby\Cms\Response($content, 'application/xml');
      }
    ],
    [
      'pattern' => 'sitemap',
      'action'  => function() {
        return go('sitemap.xml', 301);
      }
    ],
    [
      'pattern' => '(:any)',
      'action'  => function($uid) {

        $page = page($uid);

          if(!$page) $page = page('contact/' . $uid);
          if(!$page) $page = page('jobs/' . $uid);
          if(!$page) $page = page('nieuwsbrief/' . $uid);
          if(!$page) $page = page('wondzorgtijdschrift/' . $uid);
          if(!$page) $page = site()->errorPage();

            return $page;

        }
    ],
    [
      'pattern' => 'contact/(:any)',
      'action'  => function($uid) {
        go($uid);
      }
    ],
    [
      'pattern' => 'jobs/(:any)',
      'action'  => function($uid) {
        go($uid);
      }
    ],
    [
      'pattern' => 'nieuwsbrief/(:any)',
      'action'  => function($uid) {
        go($uid);
      }
    ],
    [
      'pattern' => 'wondzorgtijdschrift/(:any)',
      'action'  => function($uid) {
        go($uid);
      }
    ]
  ]
];