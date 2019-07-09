<?php

Route::group(['namespace' => 'Modularization\Controllers',
    'middleware' => config('modularization.middleware', 'web')
],
    function () {
//    Route::post('api-ctrl', 'APICtrlController@store')->name('api-ctrl.produce');
//    Route::get('ctrl/{table?}', 'CtrlController@produce')->name('ctrl.produce');
//
//    Route::get('/dbmagic/{table?}', 'MagicController@produce')->name('dbmagic.produce');
    Route::get('module/create', 'MagicController@create')->name('module.create');
//    Route::post('module-curl', 'MagicController@store')->name('dbmagic.store');
//    Route::get('form/{table?}', 'FormController@produce')->name('form.produce');
//    Route::get('mutator/{table?}', 'MutatorController@produce')->name('mutator.produce');
//    Route::get('accessor/{table?}', 'AccessorController@produce')->name('accessor.produce');
//    Route::get('model/{table?}', 'ModelController@produce')->name('model.produce');
//    Route::get('ng-form/{table?}', 'FormBuilderController@produce')->name('ng-form.produce');
//    Route::get('constant/{database?}', 'ConstantController@produce')->name('database.produce');
//    Route::get('observer/{table?}', 'ObserverController@produce')->name('observer.produce');
//
//    Route::get('repository/{table?}', 'RepositoryController@produce')->name('repository.produce');
//    Route::get('policy/{table?}', 'PolicyController@produce')->name('policy.produce');
//    Route::get('request/{table?}', 'RequestController@produce')->name('request.produce');

    Route::namespace('Group')
        ->group(function () {
            Route::post('admin-render', 'AdminController@store')->name('admin.render');
            Route::post('api-render', 'APIController@store')->name('api.render');
            Route::post('all-render', 'AllController@store')->name('all.render');
            Route::post('frontend-render', 'FrontendController@store')->name('frontend.render');
        });
});


//Route::get('seed/{tables}', function ($tables) {
//    app(\Modularization\Facades\DBFun::class)->seedTables($tables);
//});
//Route::get('seedAll', function () {
//    app(\Modularization\Facades\DBFun::class)->seed();
//});