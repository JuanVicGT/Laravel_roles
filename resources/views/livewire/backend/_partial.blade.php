// contacts/_partial.blade.php

@if ($contacts->isNotEmpty())
    <x-base-datatable :headings="['#', 'First name', 'Last name', 'Email', 'Phone', 'Zip', 'Created at']" :values="[
        [
            'key' => 'id',
            'type' => 'data',
        ],
        [
            'key' => 'first_name',
            'type' => 'data',
        ],
        [
            'key' => 'last_name',
            'type' => 'data',
        ],
        [
            'key' => 'type',
            'type' => 'data',
            'theme' => [
                'type' => 'badge',
                'colors' => [
                    'client' => 'bg-green-200 text-green-700',
                    'broker' => 'bg-orange-200 text-orange-700',
                    'partner' => 'bg-blue-200 text-blue-700',
                    'agent' => 'bg-indigo-200 texindigoge-700',
                ],
            ],
        ],
        [
            'key' => 'email',
            'type' => 'data',
        ],
        [
            'key' => 'phone',
            'type' => 'data',
        ],
        [
            'key' => 'zip',
            'type' => 'data',
        ],
        [
            'key' => 'created_at',
            'type' => 'date',
        ],
    ]" :data="$contacts" model="contacts" table-striped>
    </x-base-datatable>
@else
    No contacts found.
@endif
