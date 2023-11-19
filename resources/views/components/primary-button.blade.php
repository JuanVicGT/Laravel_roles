<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 text-white bg-blue-700 dark:bg-blue-700 hover:bg-blue-600 dark:hover:bg-blue-600 focus:bg-blue-600 dark:focus:bg-blue-600 active:bg-blue-600 dark:active:bg-blue-600 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
