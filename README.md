# Laravel Settings
<a href="https://github.com/CWSPS154/laravel-settings/issues"><img alt="GitHub issues" src="https://img.shields.io/github/issues/CWSPS154/laravel-settings"></a>
<a href="https://github.com/CWSPS154/laravel-settings/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/CWSPS154/laravel-settings"></a>
<a href="https://github.com/CWSPS154/laravel-settings"><img alt="GitHub license" src="https://img.shields.io/github/license/CWSPS154/laravel-settings"></a>

Help to build ui elements with bootstrap using laravel components
# Installation
Using Composer
```bash
composer require cwsps154/laravel-settings
```
### To publishing the package files
```bash
php artisan vendor:publish
```
You can use tag also
```bash
 php artisan vendor:publish --tag=config --tag=components --tag=views --tag=migrations
```
# Usage
Use this model `CWSPS154\Settings\Models\Setting` in the `AppServiceProvider` class and add below code in the boot method on you project.
```bash
    public function boot()
    {
        if (!app()->runningInConsole()) {
            $settings = cache()->remember(
                'settings',
                3600,
                fn() => Setting::all()->keyBy('key')
            );
            View::share('settings', $settings);
        }
    }
```
Then you can use the settings with this code in anywhere in the blade pages
```bash
$settings['your-key-name']->value ?? $settings['your-key-name']->default
```
