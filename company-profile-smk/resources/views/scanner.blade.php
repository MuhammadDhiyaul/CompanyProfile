<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layar Pemindai QR Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi radar pemindai yang keren */
        .radar {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #3b82f6; /* Warna biru Tailwind */
            overflow: hidden;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
        .radar::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 150px;
            height: 150px;
            background: conic-gradient(from 0deg, transparent 70%, rgba(59, 130, 246, 0.8) 100%);
            transform-origin: 0 0;
            animation: scan 2s linear infinite;
        }
        @keyframes scan {
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-900 h-screen flex flex-col items-center justify-center font-sans text-white overflow-hidden" onclick="keepFocus()">

    <div class="text-center mb-10 z-10">
        <h1 class="text-4xl font-extrabold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-teal-300">
            Sistem Pemindai Kehadiran
        </h1>
        <p class="text-gray-400 text-lg">Silakan arahkan alat scanner ke QR Code ID Card Anda.</p>
    </div>

    <div class="radar mb-12 z-10"></div>

    <input type="text" id="scanInput" class="opacity-0 absolute top-0 left-0 cursor-default" autofocus autocomplete="off">

    <script>
        const scanInput = document.getElementById('scanInput');

        // Fungsi agar kursor selalu berada di dalam input, 
        // bahkan jika user tidak sengaja mengklik area sembarang di layar
        function keepFocus() {
            scanInput.focus();
        }

        // Memastikan input selalu fokus setiap saat
        setInterval(keepFocus, 1000);

        // Logika menangkap tembakan scanner
        scanInput.addEventListener('keypress', function(e) {
            // Alat scanner selalu diakhiri dengan tombol 'Enter' (kode 13)
            if (e.key === 'Enter') {
                e.preventDefault(); // Mencegah reload bawaan browser
                let nip = scanInput.value.trim(); // Mengambil hasil angka NIP yang ditembak scanner
                
                if (nip !== '') {
                    // Kosongkan kembali input untuk scan berikutnya
                    scanInput.value = ''; 
                    
                    // Arahkan / Buka URL profil ID Card secara otomatis!
                    window.location.href = '/id-card/' + nip; 
                }
            }
        });
    </script>

    <div class="fixed bottom-4 text-gray-500 text-sm font-semibold tracking-wide">
        Otomatis kembali ke pemindai dalam <span id="countdown" class="text-blue-600 font-bold text-base">3</span> detik...
    </div>

    <script>
        let timeLeft = 3;
        let countdownElement = document.getElementById('countdown');
        
        // Fungsi ini akan berjalan setiap 1 detik (1000 milidetik)
        let timer = setInterval(function() {
            timeLeft--;
            countdownElement.innerText = timeLeft;
            
            // Jika waktu habis, kembali ke layar scanner
            if(timeLeft <= 0) {
                clearInterval(timer);
                window.location.href = '/scanner';
            }
        }, 1000);
    </script>

</body>
</html>