<?php

Route::group(['namespace' => 'Modularization\Controllers', 'middleware' => ['web', 'auth:admin']], function () {
    Route::post('api-ctrl', 'ApiCtrlController@store')->name('api-ctrl.produce');
    Route::get('ctrl/{table?}', 'CtrlController@produce')->name('ctrl.produce');

    Route::get('/dbmagic/{table?}', 'MagicController@produce')->name('dbmagic.produce');
    Route::get('module/create', 'MagicController@create')->name('dbmagic.create');
    Route::post('module-curl', 'MagicController@store')->name('dbmagic.store');
    Route::get('form/{table?}', 'FormController@produce')->name('form.produce');
    Route::get('mutator/{table?}', 'MutatorController@produce')->name('mutator.produce');
    Route::get('accessor/{table?}', 'AccessorController@produce')->name('accessor.produce');
    Route::get('model/{table?}', 'ModelController@produce')->name('model.produce');
    Route::get('ng-form/{table?}', 'FormBuilderController@produce')->name('ng-form.produce');
    Route::get('constant/{database?}', 'ConstantController@produce')->name('database.produce');
    Route::get('observer/{table?}', 'ObserverController@produce')->name('observer.produce');

    Route::get('repository/{table?}', 'RepositoryController@produce')->name('repository.produce');
    Route::get('policy/{table?}', 'PolicyController@produce')->name('policy.produce');
    Route::get('request/{table?}', 'RequestController@produce')->name('request.produce');
});


Route::get('seed/{tables}', function ($tables) {
    app(\Modularization\Facades\DBFun::class)->seedTables($tables);
});
Route::get('seedAll', function () {
    app(\Modularization\Facades\DBFun::class)->seed();
});