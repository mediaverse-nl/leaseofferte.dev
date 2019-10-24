<?php

$edit_name = 'Edit';
$create_name = 'Create';
$show_name = 'Show';

// admin dashboard
Breadcrumbs::for('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('site.home'));
});

// admin text index
Breadcrumbs::for('admin.editor.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Text', route('admin.editor.index'));
});
// admin text edit
Breadcrumbs::for('admin.editor.edit', function ($breadcrumbs, $model) use ($edit_name) {
    $breadcrumbs->parent('admin.editor.index');
    $breadcrumbs->push($edit_name, route('admin.editor.edit', $model->id));
});

// dashboard > faq
Breadcrumbs::for('admin.faq.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('FAQ', route('admin.faq.index'));
});
// dashboard > faq > edit
Breadcrumbs::for('admin.faq.edit', function($breadcrumbs, $model) use ($edit_name) {
    $breadcrumbs->parent('admin.faq.index');
    $breadcrumbs->push($edit_name, route('admin.faq.edit', $model->id));
});
// dashboard > faq > create
Breadcrumbs::for('admin.faq.create', function($breadcrumbs) use ($create_name) {
    $breadcrumbs->parent('admin.faq.index');
    $breadcrumbs->push($create_name, route('admin.faq.create'));
});

// dashboard > solution
Breadcrumbs::for('admin.solution.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Objects', route('admin.solution.index'));
});
// dashboard > solution > edit
Breadcrumbs::for('admin.solution.edit', function($breadcrumbs, $model) use ($edit_name) {
    $breadcrumbs->parent('admin.solution.index');
    $breadcrumbs->push($edit_name, route('admin.solution.edit', $model->id));
});
// dashboard > solution > create
Breadcrumbs::for('admin.solution.create', function($breadcrumbs) use ($create_name) {
    $breadcrumbs->parent('admin.solution.index');
    $breadcrumbs->push($create_name, route('admin.solution.create'));
});

// dashboard > event
Breadcrumbs::for('admin.seo-manager.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('SEO manager', route('admin.seo-manager.index'));
});
// dashboard > event > edit
Breadcrumbs::for('admin.seo-manager.edit', function($breadcrumbs, $model) use ($edit_name) {
    $breadcrumbs->parent('admin.seo-manager.index');
    $breadcrumbs->push($edit_name, route('admin.seo-manager.edit', $model->id));
});

// dashboard > page
Breadcrumbs::for('admin.pages.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Pages', route('admin.pages.index'));
});
// dashboard > page > edit
Breadcrumbs::for('admin.pages.edit', function($breadcrumbs, $model) use ($edit_name) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push($edit_name, route('admin.pages.edit', $model->id));
});
// dashboard > page > create
Breadcrumbs::for('admin.pages.create', function($breadcrumbs) use ($create_name) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push($create_name, route('admin.pages.create'));
});

// dashboard > category
Breadcrumbs::for('admin.category.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Category', route('admin.category.index'));
});
// dashboard > category > edit
Breadcrumbs::for('admin.category.edit', function($breadcrumbs, $model) use ($edit_name) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push($edit_name, route('admin.category.edit', $model->id));
});
// dashboard > category > create
Breadcrumbs::for('admin.category.create', function($breadcrumbs) use ($create_name) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push($create_name, route('admin.category.create'));
});

// dashboard > images
Breadcrumbs::for('admin.image.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Images Library', route('admin.file-manager.index'));
});

// dashboard > notification
Breadcrumbs::for('admin.notification.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Notification', route('admin.notification.index'));
});
// dashboard > notification > show
Breadcrumbs::for('admin.notification.show', function($breadcrumbs, $model) use ($show_name) {
    $breadcrumbs->parent('admin.notification.index');
    $breadcrumbs->push($show_name, route('admin.notification.show', $model->id));
});

//site breadcrumbs
Breadcrumbs::for('home', function ($breadcrumbs) {
    $breadcrumbs->push("home", route('home'));
});

//site about
Breadcrumbs::for('site.about', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push("Over ons", route('site.about'));
});
//site contact
Breadcrumbs::for('site.contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push("Contact", route('site.contact.index'));
});
//site faq
Breadcrumbs::for('site.faq', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push("F.A.Q.", route('site.faq'));
});

// site category index
Breadcrumbs::for('site.category.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Categorieën', route('site.category.index'));
});
// site category show
Breadcrumbs::for('site.category.show', function ($breadcrumbs, $model) use ($edit_name) {
    $breadcrumbs->parent('site.category.index');
    $breadcrumbs->push($model->value, route('site.category.show', $model->id));
});