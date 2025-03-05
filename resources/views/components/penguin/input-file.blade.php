@props(['name', 'title', 'accept' => '', 'accept_titles' => '', 'maxSize' => null])

<div class="relative flex w-full flex-col gap-1 text-on-surface dark:text-on-surface-dark">
    <label for="{{ $name }}" class="w-fit pl-0.5 text-sm">{{ $title }}</label>
    <input name="{{ $name }}" type="file" accept="{{ $accept }}"
        class="w-full overflow-clip rounded-radius border border-outline bg-surface-alt/50 text-sm file:mr-4 file:border-none file:bg-surface-alt file:px-4 file:py-2 file:font-medium file:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:file:bg-surface-dark-alt dark:file:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark"
        {{ isset($maxSize) ? 'data-max-size="' . $maxSize . '"' : '' }} />
    <label for="fileInput" class="w-fit pl-0.5 text-sm">{{ __('Choose File') }}</label>
    <small class="pl-0.5">{{ $accept_titles }} - Max
        {{ $maxSize ?? '5MB' }}</small>
</div>
