<?php

/**
 * PHP Version 8.*
 * Laravel Framework 9.* - 10.*
 *
 * @category Controller
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

namespace CWSPS154\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use CWSPS154\Settings\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings::settings.settings',compact('settings'));
    }

    /**
     * Validator for validate data in the request.
     *
     * @param array $data id of the updating request
     * @param null $id The identifier for update validation
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    protected function validator(array $data, $id = null): \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'key.*' => ['nullable', 'lowercase', 'string', 'max:255'],
            'default.*' => ['nullable', 'string', 'max:255'],
            'value.*' => ['nullable', 'string', 'max:255'],
        ], [
            'key.*.lowercase' => 'Key value(s) must be in lowercase',
            'key.*.string' => 'Key value(s) must be in string',
            'key.*.max' => 'Key value(s) must not be greater than 255 characters.',
            'default.*.string' => 'Default value(s) must be in string',
            'default.*.max' => 'Default value(s) must not be greater than 255 characters.',
            'value.*.string' => 'Value(s) must be in string',
            'value.*.max' => 'Value(s) must not be greater than 255 characters.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        DB::beginTransaction();
        try {
            $keys = $request->key;
            $default = $request->default;
            $values = $request->value;
            $this->checkInputArrays($keys, $default, $values);
            $flag = false;
            foreach ($keys as $index => $key) {
                if ($key !== null) {
                    $settings = Setting::find($request->settings_id[$index]);
                    if ($settings) {
                        if ($settings->status) {
                            $settings->update([
                                'value' => $values[$index],
                            ]);
                        } else {
                            $settings->update([
                                'key' => Str::snake($key),
                                'default' => $default[$index],
                                'value' => $values[$index],
                            ]);
                        }
                        if ($settings->wasChanged()) {
                            $flag = true;
                        }
                    } else {
                        Setting::create([
                            'key' => Str::snake($key),
                            'default' => $default[$index],
                            'value' => $values[$index],
                        ]);
                        $flag = true;
                    }
                }
            }
            if ($request->deleted_id) {
                $settings_ids = explode(',', $request->deleted_id);
                foreach ($settings_ids as $settings_id) {
                    $settings = Setting::find($settings_id);
                    $settings->delete();
                    $flag = true;
                }
            }
            DB::commit();
            if ($flag) {
                return redirect()->route('settings.index')
                    ->with('success', __('Settings created successfully, Please clear cache for reflect the changes'));
            }
            return back()->with('info', __('No changes have made.'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    protected function checkInputArrays(array $key, array $default, array $value)
    {
        if (empty(array_filter($key)) && empty(array_filter($default)) && empty(array_filter($value))) {
            return back()->with('error', 'Please fill the inputs');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $setting
     * @return RedirectResponse
     */
    public function show($setting): RedirectResponse
    {
        if ($setting == 'clear-cache') {
            Artisan::call('cache:clear');
            return redirect()->route('settings.index')->with('success', __('Cache cleared successfully'));
        }
        abort('404');
    }
}
