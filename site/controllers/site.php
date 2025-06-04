<?php

return function ($site) {

  $query   = get('q');
  $results = $site->search($query, 'title|text');
  $count   = count($results);
  $results = $results->paginate(20);

  return [
    'query'      => $query,
    'results'    => $results,
    'count'      => $count,
    'pagination' => $results->pagination()
  ];

};