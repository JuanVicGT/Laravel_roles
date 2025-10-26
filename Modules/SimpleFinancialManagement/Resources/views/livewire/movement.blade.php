<?php

use function Livewire\Volt\{state, computed};

state(['count' => 0]);

$increment = fn() => $count++;

?>

<div>
    <h1 class="text-xl font-bold">Dashboard Financiero</h1>
    <button wire:click="increment">Incrementar: {{ $count }}</button>
</div>
