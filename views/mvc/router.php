<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 7/23/18
 * Time: 10:23 AM
 */
Route::group(['namespace' => '_namespace_\Http\Controllers', 'middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {

});