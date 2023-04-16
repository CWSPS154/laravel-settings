# Laravel Settings

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
