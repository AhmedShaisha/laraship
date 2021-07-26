<?php

//QualityTest
Breadcrumbs::register('quality_qualityTests', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('Quality::module.qualityTest.title'), url(config('quality.models.qualityTest.resource_url')));
});

Breadcrumbs::register('quality_qualityTest_create_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('quality_qualityTests');
    $breadcrumbs->push(view()->shared('title_singular'));
});

Breadcrumbs::register('quality_qualityTest_show', function ($breadcrumbs) {
    $breadcrumbs->parent('quality_qualityTests');
    $breadcrumbs->push(view()->shared('title_singular'));
});

Breadcrumbs::register('qualityTests_settings', function ($breadcrumbs) {
    $breadcrumbs->parent('quality_qualityTests');
    $breadcrumbs->push(trans('Quality::module.quality.title'), url('qualityTests/settings'));
});