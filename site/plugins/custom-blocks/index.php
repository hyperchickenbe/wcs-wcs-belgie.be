<?php
Kirby::plugin('yvw/custom-blocks', [
  'blueprints' => [
    'blocks/box'         => __DIR__ . '/blueprints/blocks/box.yml',
  ],
  'snippets' => [
    'blocks/box'         => __DIR__ . '/snippets/blocks/box.php',
  ],
  'translations' => [
    'en' => [
      'field.blocks.box.name'         => 'Box',
    ]
  ],
]);