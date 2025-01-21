@props(['type' => 'info', 'title' => '', 'message'])

@php
    $alertClass = match ($type) {
        'info' => 'border-sky-600',
        'success' => 'border-green-600',
        'warning' => 'border-amber-500',
        'danger' => 'border-red-600',
        default => 'border-sky-600', // Info
    };

    $alertBodyClass = match ($type) {
        'info' => 'bg-sky-600/10',
        'success' => 'bg-green-600/10',
        'warning' => 'bg-amber-500/10',
        'danger' => 'bg-red-600/10',
        default => 'bg-sky-600/10', // Info
    };

    $alertIconClass = match ($type) {
        'info' => 'bg-sky-600/15 text-sky-600',
        'success' => 'bg-green-600/15 text-green-600',
        'warning' => 'bg-amber-500/15 text-amber-500',
        'danger' => 'bg-red-600/15 text-red-600',
        default => 'bg-sky-600/15 text-sky-600', // Info
    };

    $alertTitleClass = match ($type) {
        'info' => 'text-sky-600',
        'success' => 'text-green-600',
        'warning' => 'text-amber-500',
        'danger' => 'text-red-600',
        default => 'text-sky-600', // Info
    };
@endphp

<!-- Custom Alert -->
<div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
    class="relative w-full overflow-hidden rounded-xl border bg-white text-slate-700 dark:bg-slate-900 dark:text-slate-300 {{ $alertClass }}"
    role="alert" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90">

    <!-- Alert Body -->
    <div class="flex w-full items-center gap-2 p-4 {{ $alertBodyClass }}">

        <!-- Icon -->
        <div class="rounded-full p-1 {{ $alertIconClass }}" aria-hidden="true">
            @if ($type === 'info')
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                        clip-rule="evenodd" />
                </svg>
            @endif


            @if ($type === 'success')
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                        clip-rule="evenodd" />
                </svg>
            @endif

            @if ($type === 'warning')
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                        clip-rule="evenodd" />
                </svg>
            @endif

            @if ($type === 'danger')
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                        clip-rule="evenodd" />
                </svg>
            @endif
        </div>

        <!-- Title & Message -->
        <div class="ml-2">
            <!-- Title -->
            <h3 class="text-sm font-semibold {{ $alertTitleClass }}">
                {{ $title }}
            </h3>

            <!-- Message -->
            <p class="text-xs font-medium sm:text-sm">
                {{ $message }}
            </p>
        </div>
        <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
