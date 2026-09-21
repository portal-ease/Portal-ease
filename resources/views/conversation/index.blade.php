<x-chat-layout :portal="currentPortal()">
    <div class="grid h-screen grid-cols-[0.25fr_0.75fr] border-l-[3px] border-white">
        <div>
            <livewire:chat-sidebar
                :user="$user"
                wire:navigate
                :conversations="$conversations"
                :portal="currentPortal()"
            />
        </div>
        <div>
            <livewire:chat-window wire:navigate />
        </div>
    </div>
</x-chat-layout>
