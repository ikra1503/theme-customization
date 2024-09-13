<?php

namespace XCurrency\WpMVC\Providers;

\defined('ABSPATH') || exit;
use XCurrency\WpMVC\Contracts\Provider;
use XCurrency\WpMVC\App;
use XCurrency\WpMVC\Routing\Providers\RouteServiceProvider as WpMVCRouteServiceProvider;
class RouteServiceProvider extends WpMVCRouteServiceProvider implements Provider
{
    public function boot()
    {
        parent::$container = App::$container;
        $config = App::$config->get('app');
        parent::$properties = ['rest' => $config['rest_api'], 'ajax' => $config['ajax_api'], 'middleware' => $config['middleware'], 'routes-dir' => App::get_dir("routes"), 'rest_response_action_hook' => $config['rest_response_action_hook'] ?? '', 'rest_response_filter_hook' => $config['rest_response_filter_hook'] ?? ''];
        parent::boot();
    }
}
