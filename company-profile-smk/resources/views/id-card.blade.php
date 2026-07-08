<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card - {{ $teacher->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Memastikan warna background QR code menyatu */
        .qr-container svg {
            margin: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white w-80 rounded-2xl shadow-2xl overflow-hidden border border-gray-300 relative">
        
        <div class="bg-blue-700 text-white text-center py-4 px-4">
            <h2 class="text-lg font-bold uppercase tracking-wide">SMK Al Fithrah Malang</h2>
            <p class="text-xs text-blue-200">Kartu Identitas Pendidik</p>
        </div>

        <div class="flex justify-center mt-6">
            @if($teacher->foto)
                <img src="{{ asset('storage/' . $teacher->foto) }}" alt="Foto {{ $teacher->nama }}" class="w-32 h-32 object-cover rounded-full border-4 border-blue-100 shadow-md">
            @else
                <div class="w-32 h-32 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 border-4 border-blue-100 shadow-md">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
            @endif
        </div>

        <div class="text-center px-6 mt-4">
            <h3 class="text-xl font-extrabold text-gray-800">{{ $teacher->nama }}</h3>
            <p class="text-sm font-semibold text-blue-600 mt-1">{{ $teacher->jabatan ?? 'Guru Mata Pelajaran' }}</p>
            <p class="text-xs text-gray-500 mt-1 font-mono">NIP: {{ $teacher->nip }}</p>
        </div>

        <div class="mt-6 mb-8 flex justify-center qr-container p-3 bg-gray-50 mx-10 rounded-xl border border-gray-200 shadow-inner">
            {!! $qrCode !!}
        </div>

        <div class="h-2 bg-blue-700 w-full absolute bottom-0"></div>
    </div>

</body>
</html>