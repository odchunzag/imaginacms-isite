<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Str;

$locale = LaravelLocalization::setLocale() ?: App::getLocale();
//
//$router->get('/', [
//    'uses' => 'PublicController@homepage',
//    'as' => 'homepage',
//  'middleware' => ['universal',Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,\Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain::class]
//]);
//

(!empty(json_decode(setting("isite::rolesToTenant",null,"[]")))) ?
  $middlewares = [
    'universal',
    \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
    \Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain::class
  ] :
  $middlewares = [];


/** @var Router $router */
Route::group(['prefix' => LaravelLocalization::setLocale()], function (Router $router) use ($locale) {


    $router->get(trans('isite::routes.organizations.index.index'), [
        'as' => $locale . '.isite.organizations.index',
        'uses' => 'PublicController@index',
    ]);

    $router->get(trans('isite::routes.organizations.index.category'), [
      'as' => $locale . '.isite.organizations.index.category',
      'uses' => 'PublicController@index',
    ]);

});

/** @var Router $router */
Route::group(['prefix' => "blocks/preview"], function (Router $router) use ($locale) {
  $router->get("/", [
    'as' => 'isite.blocks.preview',
    'uses' => 'PublicController@blockPreview',
  ]);
});


/**
 *
 */
$router->any('{uri}', [
  'uses' => 'PublicController@uri',
  'as' => $locale.'.site',
  'middleware' => $middlewares
])->where('uri', '.*');
