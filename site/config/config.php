<?php
return [
  'debug' => false,
  'updates' => [
    'kirby' => 'security'
  ],
  'db' => [
    'host'     => 'xxx',
    'database' => 'xxx',
    'user'     => 'xxx',
    'password' => 'xxx',
  ],
  'sylvainjule.matomo.url'            => 'https://analytics.wcs-belgie.be/',
  'sylvainjule.matomo.id'             => '1',
  'sylvainjule.matomo.token'          => '41f8c9c53ffee595830f34a36f917dd2',
  'sylvainjule.matomo.active'         => true,
  'sylvainjule.matomo.debug'          => false,
  'sylvainjule.matomo.trackUsers'     => false,
  'sylvainjule.matomo.disableCookies' => false,
  'sylvainjule.matomo.blacklist'      => ['127.0.0.1', '::1'],
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
          if(!$page) $page = page('mailinglijst/' . $uid);
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
      'pattern' => 'mailinglijst/(:any)',
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