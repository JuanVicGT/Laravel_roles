<x-app-layout :tab_title="__('Settings')">
    {{-- Form --}}
    <x-mary-card shadow>
        <x-mary-form method="POST" action="{{ route('setting.store') }}" x-data="{ submitButtonDisabled: false }"
            x-on:submit="submitButtonDisabled = true">
            @csrf

            {{-- Hidden Inputs --}}
            <input type="hidden" name="action" value="save">

            <div x-data="{ selectedTab: '{{ $modules_tabs[0] }}' }">

                <!-- Tabs Header -->
                <div x-on:keydown.right.prevent="$focus.wrap().next()"
                    x-on:keydown.left.prevent="$focus.wrap().previous()"
                    class="flex flex-wrap gap-2 overflow-x-auto border-b border-outline dark:border-outline-dark"
                    role="tablist" aria-label="tab options">
                    @foreach ($modules_tabs as $tab)
                        <button x-on:click="selectedTab = '{{ $tab }}'"
                            x-bind:aria-selected="selectedTab === '{{ $tab }}'"
                            x-bind:tabindex="selectedTab === '{{ $tab }}' ? '0' : '-1'"
                            x-bind:class="selectedTab === '{{ $tab }}' ?
                                'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                                'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                            class="h-min px-4 py-2 text-sm" type="button" role="tab"
                            aria-controls="tabpanel{{ $tab }}" aria-selected="false">
                            {{ $tab }}
                        </button>
                    @endforeach
                </div>

                <!-- Tabs Content -->
                <div class="px-2 py-4 text-on-surface dark:text-on-surface-dark">
                    {{-- Form Content --}}
                    @foreach ($modules_settings as $module => $settings_per_type)
                        <!-- Tab Content -->
                        <div x-cloak x-show="selectedTab === '{{ $module }}'" id="tabpanel{{ $module }}"
                            role="tabpanel" aria-label="{{ $module }}" class="space-y-4">

                            {{-- First Input Setting Type --}}
                            <div class="grid sm:grid-cols-2 gap-4">
                                @foreach ($settings_per_type['input'] ?? [] as $type => $settings)
                                    <x-mary-input label="{{ __($settings['label']) }}" name="{{ $settings['field'] }}"
                                        type="{{ $settings['type'] }}" value="{{ $settings['value'] }}"
                                        placeholder="{{ $settings['placeholder'] ?? '' }}"
                                        hint="{{ __($settings['description'] ?? '') }}" />
                                @endforeach
                            </div> {{-- End First Input Setting Type --}}

                            {{-- Third Select Setting Type --}}
                            <div class="grid sm:grid-cols-2 gap-4 mt-2">
                                @foreach ($settings_per_type['select'] ?? [] as $type => $settings)
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">{{ __($settings['label']) }}</legend>
                                        <select class="select" name="{{ $settings['field'] }}">
                                            <option>{{ __('Select an option') }}</option>
                                            @foreach ($settings['options'] as $option)
                                                <option value="{{ $option['value'] }}" @selected($option['value'] == $settings['value'])>
                                                    {{ $option['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="label">{{ __($settings['description'] ?? '') }}</span>
                                    </fieldset>
                                @endforeach
                            </div> {{-- End Third Select Setting Type --}}

                            {{-- Second Checkbox Setting Type --}}
                            <div class="grid sm:grid-cols-4 gap-4">
                                @foreach ($settings_per_type['checkbox'] ?? [] as $type => $settings)
                                    <x-mary-checkbox name="{{ $settings['field'] }}"
                                        label="{{ __($settings['label']) }}"
                                        hint="{{ __($settings['description'] ?? '') }}" :checked="$settings['value']" />
                                @endforeach
                            </div> {{-- End Second Checkbox Setting Type --}}

                            {{-- Fourth Textarea Setting Type --}}
                            <div class="grid sm:grid-cols-2 gap-4">
                                @foreach ($settings_per_type['textarea'] ?? [] as $type => $settings)
                                    <x-mary-textarea label="{{ __($settings['label']) }}"
                                        name="{{ $settings['field'] }}"
                                        placeholder="{{ $settings['placeholder'] ?? '' }}"
                                        hint="{{ __($settings['description'] ?? '') }}">
                                        {{ $settings['value'] }}
                                    </x-mary-textarea>
                                @endforeach
                            </div> {{-- End Fourth Textarea Setting Type --}}

                        </div> <!-- End Tab Content -->
                    @endforeach
                </div> <!-- End Tabs Content -->
            </div> <!-- End Tabs -->

            <!-- Submit Button -->
            <div class="w-full mt-4 flex justify-end">
                <x-mary-button type="submit" class="btn-success" x-bind:disabled="submitButtonDisabled">
                    <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                    <div x-show="!submitButtonDisabled">
                        <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M48 96V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V170.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H309.5c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8V184c0 13.3-10.7 24-24 24H104c-13.3 0-24-10.7-24-24V80H64c-8.8 0-16 7.2-16 16zm80-16v80H272V80H128zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z" />
                        </svg> {{ __('Save') }}
                    </div>
                </x-mary-button>
            </div>

        </x-mary-form>
    </x-mary-card>

</x-app-layout>
