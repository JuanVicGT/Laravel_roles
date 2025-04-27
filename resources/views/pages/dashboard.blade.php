<x-app-layout path="layouts.app">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <div x-data="{ message: 'Hola, Alpine!' }">
                    <p x-text="message"></p>
                </div>

                <!-- Message Trigger  -->
                <button
                    x-on:click="$dispatch('notify', { variant: 'message', sender:{name:'Jack Ellis', avatar:'https://penguinui.s3.amazonaws.com/component-assets/avatar-2.webp'}, message: 'Hey, can you review the PR I just submitted? Let me know if you spot any issues!' })"
                    type="button"
                    class="cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:slate-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Message</button>
                <!-- Info Trigger  -->
                <button
                    x-on:click="$dispatch('notify', { variant: 'info', title: 'Update Available',  message: 'A new version of the app is ready for you. Update now to enjoy the latest features!' })"
                    type="button"
                    class="cursor-pointer whitespace-nowrap rounded-xl bg-sky-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:slate-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Info</button>
                <!-- Success Trigger  -->
                <button
                    x-on:click="$dispatch('notify', { variant: 'success', title: 'Success!',  message: 'Your changes have been saved. Keep up the great work!' })"
                    type="button"
                    class="cursor-pointer whitespace-nowrap rounded-xl bg-green-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:slate-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Success</button>
                <!-- Danger Trigger  -->
                <button
                    x-on:click="$dispatch('notify', { variant: 'danger', title: 'Oops!',  message: 'Something went wrong. Please try again. If the problem persists, we’re here to help!' })"
                    type="button"
                    class="cursor-pointer whitespace-nowrap rounded-xl bg-red-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:slate-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Danger</button>
                <!-- Warning Trigger  -->
                <button
                    x-on:click="$dispatch('notify', { variant: 'warning', title: 'Action Needed',  message: 'Your storage is getting low. Consider upgrading your plan.' })"
                    type="button"
                    class="cursor-pointer whitespace-nowrap rounded-xl bg-amber-500 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:slate-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Warning</button>

                <div class="flex w-full flex-col gap-1 text-slate-700 dark:text-slate-300">
                    <label for="currencyInput" class="w-fit pl-0.5 text-sm">Amount</label>
                    <input id="currencyInput" type="text"
                        class="w-full rounded-xl border border-slate-300 bg-slate-100 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600"
                        name="amount" placeholder="Enter amount" autocomplete="off" />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
