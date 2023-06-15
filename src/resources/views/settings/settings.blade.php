@extends(config('settings.layout.name'),config('settings.layout.parameter'))
@section(config('settings.layout.section'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-2">
                    <div class="card-title">
                        {{ __('Settings') }}
                    </div>
                    <div>
                        <x-buicomponents::ui.button name="cache" type="button" class="btn btn-warning"
                                                    onclick="window.location='{{ route('settings.show','clear-cache') }}'">
                            {{__('Cache Clear')}}
                        </x-buicomponents::ui.button>
                    </div>
                </div>
                @if ($errors->any() && config('settings.show-error'))
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <x-buicomponents::ui.button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"/>
                        </div>
                    @endforeach
                @endif
                @if (session()->has('success') && config('settings.show-success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <x-buicomponents::ui.button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"/>
                    </div>
                @endif
                @if (session()->has('error') && config('settings.show-error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session()->get('error') }}
                        <x-buicomponents::ui.button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"/>
                    </div>
                @endif
                <x-buicomponents::ui.form method="POST" action="{{route('settings.store')}}">
                    <div class="col-lg-12 order-lg-6">
                        <div class="dynamic-row px-3">
                            <div class="row for-clone d-none">
                                <div class="col-lg-3 my-2">
                                    <x-buicomponents::ui.input type="text" name="key[]" id="key"
                                                               placeholder="Enter key" :error="false">
                                        {{__('Key')}}
                                    </x-buicomponents::ui.input>
                                </div>
                                <div class="col-lg-3 my-2">
                                    <x-buicomponents::ui.input type="text" id="default" name="default[]"
                                                               placeholder="Enter default value" :error="false">
                                        {{__('Default value')}}
                                    </x-buicomponents::ui.input>
                                </div>
                                <div class="col-lg-4 my-2">
                                    <x-buicomponents::ui.input type="text" id="value" name="value[]"
                                                               placeholder="Enter value" :error="false">
                                        {{__('Value')}}
                                    </x-buicomponents::ui.input>
                                </div>
                                <div class="col-lg-2 my-auto">
                                    <x-buicomponents::ui.input type="hidden" name="settings_id[]" id="settings_id"
                                                               :bt-form="false"
                                                               :label="false" :error="false"/>
                                    <x-buicomponents::ui.button name="delete" type="button"
                                                                class="btn btn-danger delete-row w-100 mt-4">
                                        {{__('Delete')}}
                                    </x-buicomponents::ui.button>
                                </div>
                            </div>
                            @forelse($settings as $setting)
                                <div class="row">
                                    <div class="col-lg-3 my-2">
                                        <x-buicomponents::ui.input type="text" name="key[]" id="key"
                                                                   placeholder="Enter key"
                                                                   :value="$setting->key" :error="false">
                                            {{__('Key')}}
                                        </x-buicomponents::ui.input>
                                    </div>
                                    <div class="col-lg-3 my-2">
                                        <x-buicomponents::ui.input type="text" id="default" name="default[]"
                                                                   placeholder="Enter default value"
                                                                   :value="$setting->default" :error="false">
                                            {{__('Default value')}}
                                        </x-buicomponents::ui.input>
                                    </div>
                                    <div class="col-lg-4 my-2">
                                        <x-buicomponents::ui.input type="text" id="value" name="value[]"
                                                                   placeholder="Enter value"
                                                                   :value="$setting->value" :error="false">
                                            {{__('Value')}}
                                        </x-buicomponents::ui.input>
                                    </div>
                                    <div class="col-lg-2 my-auto">
                                        <x-buicomponents::ui.input type="hidden" name="settings_id[]" id="settings_id"
                                                                   :bt-form="false" :label="false"
                                                                   :value="$setting->id" :error="false"/>
                                        <x-buicomponents::ui.button name="delete" type="button"
                                                                    class="btn btn-danger delete-row w-100 mt-4"
                                                                    data-id="{{ $setting->id }}"
                                                                    :disabled="$setting->status">
                                            {{__('Delete')}}
                                        </x-buicomponents::ui.button>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-lg-3 my-2">
                                        <x-buicomponents::ui.input type="text" name="key[]" id="key"
                                                                   placeholder="Enter key" :error="false">
                                            {{__('Key')}}
                                        </x-buicomponents::ui.input>
                                    </div>
                                    <div class="col-lg-3 my-2">
                                        <x-buicomponents::ui.input type="text" id="default" name="default[]"
                                                                   placeholder="Enter default value" :error="false">
                                            {{__('Default value')}}
                                        </x-buicomponents::ui.input>
                                    </div>
                                    <div class="col-lg-4 my-2">
                                        <x-buicomponents::ui.input type="text" id="value" name="value[]"
                                                                   placeholder="Enter value" :error="false">
                                            {{__('Value')}}
                                        </x-buicomponents::ui.input>
                                    </div>
                                    <div class="col-lg-2 my-auto">
                                        <x-buicomponents::ui.input type="hidden" name="settings_id[]" id="settings_id"
                                                                   :bt-form="false" :label="false" :error="false"/>
                                        <x-buicomponents::ui.button name="delete" type="button"
                                                                    class="btn btn-danger delete-row w-100 mt-4">
                                            {{__('Delete')}}
                                        </x-buicomponents::ui.button>
                                    </div>
                                </div>
                            @endforelse
                            <div class="d-flex dynamic-row-btn">
                                <x-buicomponents::ui.input type="hidden" name="deleted_id" id="deleted_id"
                                                           :bt-form="false" :label="false" :error="false"/>
                                <x-buicomponents::ui.button name="add" type="button"
                                                            class="btn btn-secondary add-row w-100">
                                    {{__('Add')}}
                                </x-buicomponents::ui.button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-buicomponents::ui.button name="save" type="submit"
                                                    class="btn btn-primary w-100">
                            {{__('Save')}}
                        </x-buicomponents::ui.button>
                    </div>
                </x-buicomponents::ui.form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('body').on('click', '.dynamic-row .dynamic-row-btn .add-row', function () {
            let row = $(this).parent('div').parent('div').find('.for-clone.d-none').clone();
            row.removeClass('d-none');
            row.insertBefore($(this).parent('div'));
        });

        $('body').on('click', '.dynamic-row .delete-row', function () {
            let settings_id = $(this).data('id');
            if (settings_id) {
                $("#deleted_id").val(function () {
                    if (this.value) {
                        return this.value + ',' + settings_id;
                    } else {
                        return settings_id;
                    }
                });
            }
            $(this).parent('div').parent('.row').remove();
        });
    </script>
@endpush
