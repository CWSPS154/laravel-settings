<?php
/**
 * PHP Version 8.*
 * Laravel Framework 9.* - 10.*
 *
 * @category Route
 *
 * @package Laravel
 *
 * @author CWSPS154 <codewithsps154@gmail.com>
 *
 * @license MIT License https://opensource.org/licenses/MIT
 *
 * @link https://github.com/CWSPS154
 *
 * Date 15/04/23
 * */

use CWSPS154\Settings\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::group(config('settings.route'), function () {
    Route::resource('settings',SettingsController::class)->only(['index','store','show']);
});
