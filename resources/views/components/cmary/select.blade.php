@props([
    'label' => null,
    'name' => null,
    'id' => $name ?? uniqid('select_'),
    'icon' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => __('Select an option'),
])

<div>
    <fieldset class="fieldset py-0">

        {{-- LABEL --}}
        @if ($label)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($attributes->get('required'))
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        {{-- SELECT --}}
        <div class="relative">

            {{-- Icon --}}
            @if ($icon)
                <span class="absolute inset-y-0 left-0 z-1 flex items-center pl-3 text-gray-400">
                    <i class="{{ $icon }}"></i>
                </span>
            @endif

            {{-- Select --}}
            <select id="{{ $id }}" name="{{ $name }}"
                class="select select-bordered w-full pl-10
                @error($name) select-error @enderror">
                <option disabled {{ $selected ? '' : 'selected' }}>{{ $placeholder }}</option>

                @foreach ($options as $option)
                    <option value="{{ $option['id'] }}" {{ $selected == $option['id'] ? 'selected' : '' }}>
                        {{ $option['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- ERROR --}}
        @error($name)
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </fieldset>
</div>
