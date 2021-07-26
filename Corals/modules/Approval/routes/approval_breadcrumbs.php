<?php

//ApproveRequest
Breadcrumbs::register('approval_approveRequests', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('Approval::module.approveRequest.title'), url(config('approval.models.approveRequest.resource_url')));
});

Breadcrumbs::register('approval_approveRequest_create_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('approval_approveRequests');
    $breadcrumbs->push(view()->shared('title_singular'));
});

Breadcrumbs::register('approval_approveRequest_show', function ($breadcrumbs) {
    $breadcrumbs->parent('approval_approveRequests');
    $breadcrumbs->push(view()->shared('title_singular'));
});