<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->title }} - {{ $profil->nama_sekolah ?? 'SMK Al Fithrah' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
        <a href="/" class="flex items-center space-x-2"> 
            @if($profil && $profil->logo)
                <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah" class="h-12 w-12 object-contain">
            @endif
            <h1 class="text-2xl font-bold text-blue-700">
                {{ $profil->nama_sekolah ?? 'SMK Al Fithrah' }}
            </h1>
        </a>
        <ul class="flex space-x-6 font-semibold text-gray-600">
            <li><a href="/" class="hover:text-blue-600 transition">Beranda</a></li>
        </ul>
    </nav>

    <main class="container mx-auto px-6 py-12 flex flex-col lg:flex-row gap-10">
        
        <article class="w-full lg:w-2/3 bg-white p-8 rounded-2xl shadow-md">
            <a href="/" class="inline-block text-blue-600 font-semibold mb-6 hover:underline">&larr; Kembali ke Beranda</a>
            
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $berita->title }}</h1>
            <p class="text-gray-500 mb-6 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>Dipublikasikan pada {{ $berita->created_at->format('d F Y') }}</span>
            </p>

            @if($berita->image)
                <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-full h-auto max-h-[500px] object-cover rounded-xl mb-8">
            @endif

            <div class="prose max-w-none text-gray-700 leading-relaxed text-lg text-justify">
                {!! $berita->content !!}
            </div>
        </article>

        <aside class="w-full lg:w-1/3">
            <div class="bg-white p-6 rounded-2xl shadow-md sticky top-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Berita Lainnya</h3>
                
                <div class="flex flex-col space-y-4">
                    @forelse($beritaLain as $item)
                        <a href="{{ url('/berita/' . $item->id) }}" class="group flex items-center space-x-4">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-20 h-20 object-cover rounded-lg group-hover:opacity-80 transition">
                            @endif
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-blue-600 transition">{{ $item->title }}</h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d M Y') }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada berita lain.</p>
                    @endforelse
                </div>
            </div>
        </aside>

    </main>

</body>
</html>