<x-filament-panels::page>
    {{-- Menggunakan tag HTML form standar yang lebih aman untuk semua versi --}}
    <form wire:submit="save" class="space-y-6">
        
        {{ $this->form }}

        <div class="mt-6 flex justify-start">
            <x-filament::button type="submit" size="lg">
                Simpan Perubahan
            </x-filament::button>
        </div>
        
    </form>
</x-filament-panels::page>