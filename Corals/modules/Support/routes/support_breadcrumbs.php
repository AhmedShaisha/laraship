<?php

//CustomerSupport
Breadcrumbs::register('support_customerSupports', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('Support::module.customerSupport.title'), url(config('support.models.customerSupport.resource_url')));
});

Breadcrumbs::register('support_customerSupport_create_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('support_customerSupports');
    $breadcrumbs->push(view()->shared('title_singular'));
});

Breadcrumbs::register('support_customerSupport_show', function ($breadcrumbs) {
    $breadcrumbs->parent('support_customerSupports');
    $breadcrumbs->push(view()->shared('title_singular'));
});

//response
