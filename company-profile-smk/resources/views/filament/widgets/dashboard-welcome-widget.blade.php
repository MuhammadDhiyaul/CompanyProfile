<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold tracking-tight">Selamat Datang di Dashboard SMK Al Fithrah! 👋</h2>
                <p class="text-gray-500 text-sm mt-1">Pantau statistik, kelola data master, dan perbarui konten website sekolah Anda dari sini.</p>
            </div>
            
            <div class="flex gap-3">
                <x-filament::button tag="a" href="/admin/teachers/create" color="success" icon="heroicon-m-user-plus">
                    Tambah Guru
                </x-filament::button>
                <x-filament::button tag="a" href="/admin/beritas/create" color="primary" icon="heroicon-m-pencil-square">
                    Tulis Berita
                </x-filament::button>
            </div>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
