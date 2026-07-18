<x-chat-layout :portal="$portal">
    <div class="grid grid-cols-[0.25fr_0.75fr] border-l-[3px] border-white h-screen">
        <div>
            <livewire:chat-sidebar :user="$user" wire:navigate :conversations="$conversations" :portal="$portal" />
        </div>
        <div>
            <livewire:chat-window wire:navigate />
        </div>
    </div>
</x-chat-layout>
