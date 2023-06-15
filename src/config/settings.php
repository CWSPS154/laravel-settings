<?php
/**
 * PHP Version 8.*
 * Laravel Framework 9.* - 10.*
 *
 * @category Config
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

return [
    'layout' => 'layouts.app',
    'section' => 'contents',
    'route' => [
        'prefix' => 'backend',
        'middleware' => ['web'],
    ],
    'show-error' => true,
    'show-success' => true
];
