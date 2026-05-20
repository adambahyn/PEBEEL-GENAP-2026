<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: #f5f7fb;
        }

        /* Layout agar background hero memenuhi layar (fullscreen) */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 60px; /* Menghindari tertutup navbar */
        }

        /* Kotak Pencarian Utama */
        .search-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 24px;
            max-width: 450px;
            width: 100%;
            backdrop-filter: blur(10px);
        }

        /* Menyesuaikan desain kalender Flatpickr agar menyatu */
        .flatpickr-calendar.inline {
            margin: 0 auto;
            border: none;
            box-shadow: none;
            background: transparent;
            width: 100%;
        }
    </style>
</head>
<body>
    {{-- Include Navbar --}}
    @include('layouts.navbar')

    {{-- ===== HERO & KALENDER ===== --}}
    <div class="hero-section text-center position-relative">
        <div class="container position-relative z-1">
            
            <h1 class="display-4 fw-bold mb-2 text-white">Adam Rental</h1>
            <p class="mb-4 text-white-50 fs-5">Kapan Anda ingin memulai perjalanan?</p>
            
            <form id="searchForm" action="{{ url('/product') }}" method="GET" class="search-box mx-auto shadow-lg text-center">
                
                <h6 class="fw-bold text-secondary mb-3 text-uppercase" style="letter-spacing: 1px;">Pilih Tanggal Sewa</h6>
                
                <div class="d-flex justify-content-center mb-4">
                    <div id="inline-calendar"></div>
                </div>
                
                <input type="hidden" name="start_date" id="start_date" required>
                <input type="hidden" name="end_date" id="end_date" required>
                
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold fs-6 shadow-sm">
                    <i class="bi bi-search me-2"></i> Tampilkan Mobil Tersedia
                </button>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        // Inisialisasi Kalender Interaktif
        flatpickr("#inline-calendar", {
            inline: true,        
            mode: "range",       
            dateFormat: "Y-m-d",
            minDate: "today",    
            showMonths: 1,       // Menampilkan 1 bulan agar rapi di mobile
            onChange: function(selectedDates, dateStr, instance) {
                // Isi input tersembunyi hanya jika user sudah memilih TANGGAL MULAI dan TANGGAL SELESAI
                if (selectedDates.length === 2) {
                    document.getElementById('start_date').value = instance.formatDate(selectedDates[0], "Y-m-d");
                    document.getElementById('end_date').value = instance.formatDate(selectedDates[1], "Y-m-d");
                } else {
                    document.getElementById('start_date').value = "";
                    document.getElementById('end_date').value = "";
                }
            }
        });

        // Validasi: Cegah user menekan tombol cari jika belum memilih 2 tanggal
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            const start = document.getElementById('start_date').value;
            const end = document.getElementById('end_date').value;
            
            if (!start || !end) {
                e.preventDefault(); // Batalkan pengiriman form
                alert('Silakan pilih rentang tanggal (mulai dan selesai) pada kalender terlebih dahulu.');
            }
        });
    </script>
</body>
</html>