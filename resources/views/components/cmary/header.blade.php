@props(['id', 'title', 'link' => null, 'create_title' => null])

<div id="{{ $id }}" class="mb-5" x-data="{}">
    <div class="flex flex-wrap gap-5 justify-between items-center">
        <div class="flex flex-wrap gap-5">
            <div class="text-4xl font-extrabold">
                {{ $title }}
            </div>

            {{ $slot }}
        </div>

        @if ($link)
            <x-mary-button icon="o-plus" label="{{ $create_title ?? __('Create') }}" class="btn-success"
                link="{{ $link }}" no-wire-navigate />
        @endif

    </div>
</div>
