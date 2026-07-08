<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Al Fithrah Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">

        <a href="/" class="flex items-center space-x-2">
            @if($profil && $profil->logo)
                <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah" class="h-12 w-12 object-contain">
            @endif
            
            <h1 class="text-2xl font-bold text-blue-700">
                {{ $profil->name }}
            </h1>
        </a>

        <ul class="flex space-x-6 font-semibold text-gray-600">
            <li><a href="#" class="hover:text-blue-600">Beranda</a></li>
            <li><a href="#" class="hover:text-blue-600">Profil</a></li>
            <li><a href="#" class="hover:text-blue-600">Berita</a></li>
            <li><a href="#" class="hover:text-blue-600">Galeri</a></li>
        </ul>
    </nav>

    @if($sliders->count() > 0)
        @php $mainSlider = $sliders->first(); @endphp
        <header class="relative w-full h-[70vh] bg-gray-900">
            <img src="{{ asset('storage/' . $mainSlider->image) }}" alt="Banner" class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4">
                <h2 class="text-5xl font-extrabold text-white mb-4 drop-shadow-lg">
                    {{ $mainSlider->title ?? 'Selamat Datang di SMK Al Fithrah' }}
                </h2>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl drop-shadow-md">
                    {{ $mainSlider->subtitle ?? 'Membangun Generasi Cerdas, Terampil, dan Berakhlak Mulia.' }}
                </p>
                @if($mainSlider->button_text)
                    <a href="{{ $mainSlider->button_link ?? '#' }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 shadow-lg">
                        {{ $mainSlider->button_text }}
                    </a>
                @endif
            </div>
        </header>
    @endif

    <main class="container mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-800">Berita & Informasi Terbaru</h3>
            <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($beritas as $berita)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 mb-2">{{ $berita->created_at->format('d M Y') }}</p>
                        <h4 class="text-xl font-bold text-gray-800 mb-3">{{ $berita->title }}</h4>
                        <a href="{{ url('/berita/' . $berita->id) }}" class="text-blue-600 font-semibold hover:underline">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-8">
                    Belum ada berita yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </main>

    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800">Prestasi Gemilang</h3>
                <div class="w-24 h-1 bg-yellow-500 mx-auto mt-4 rounded"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($prestasis as $prestasi)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col items-center text-center p-8 border-t-4 border-yellow-500 hover:-translate-y-2 transition duration-300">
                        @if($prestasi->image)
                            <img src="{{ asset('storage/' . $prestasi->image) }}" alt="Piala" class="w-32 h-32 object-cover rounded-full mb-6 shadow-inner ring-4 ring-yellow-100">
                        @else
                            <div class="w-32 h-32 bg-gray-200 rounded-full mb-6 flex items-center justify-center text-yellow-500 ring-4 ring-yellow-100">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                        @endif
                        <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $prestasi->title }}</h4>
                        <p class="text-blue-600 font-bold mb-3">{{ $prestasi->student_name }}</p>
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $prestasi->level }}</span>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-8">Belum ada data prestasi.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-800">Galeri Kegiatan</h3>
            <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($galeris as $galeri)
                <div class="relative group rounded-2xl overflow-hidden shadow-lg h-64 cursor-pointer">
                    @if($galeri->images && count($galeri->images) > 0)
                        <img src="{{ asset('storage/' . $galeri->images[0]) }}" alt="{{ $galeri->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent flex items-end opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="p-6 w-full transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                            <h4 class="text-white font-bold text-lg mb-1">{{ $galeri->title }}</h4>
                            <p class="text-blue-300 text-sm font-medium">{{ count($galeri->images ?? []) }} Foto</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500 py-8">Belum ada album galeri.</div>
            @endforelse
        </div>
    </section>

    <footer class="bg-gray-800 text-white text-center py-8">
        <p>&copy; {{ date('Y') }} SMK Al Fithrah. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>