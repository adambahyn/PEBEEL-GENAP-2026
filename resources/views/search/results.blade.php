<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5f7fb;
        }

        .result-image {
            width: 96px;
            height: 72px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>
@include('layouts.navbar')
<div class="container mt-5 pt-4">
    <h3 class="mb-4">Hasil Pencarian untuk: <strong>"{{ $keyword }}"</strong></h3>

    <div class="row">
        <div class="col-md-12 mb-4">
            <h5>Mobil Terkait</h5>
            @if($products->count() > 0)
                <div class="list-group">
                    @foreach($products as $product)
                        @php
                            $productImage = collect($product->images ?? [])->filter()->first() ?? $product->image;
                        @endphp
                        <a href="{{ route('product.show', $product->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <img
                                    src="{{ $productImage ? asset('storage/' . $productImage) : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=400' }}"
                                    class="result-image"
                                    alt="{{ $product->name }}"
                                >
                                <div>
                                    <h6 class="mb-1 fw-bold">
                                        {{ $product->name }}
                                        <span class="badge bg-secondary ms-2">SKU: {{ $product->sku }}</span>
                                    </h6>

                                    <small class="text-muted">
                                        {{ $product->brand }} {{ $product->model }} | {{ $product->transmission }} | {{ $product->capacity }} Penumpang | {{ $product->fuel_type }}
                                    </small><br>

                                    <small class="text-muted">{{ Str::limit($product->description, 100) }}</small><br>

                                    <span class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }} / hari</span>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">Lihat Detail</span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="alert alert-light border text-muted">Tidak ada mobil yang cocok dengan pencarianmu.</div>
            @endif
        </div>

        @if(count($helpTopics) > 0)
            <div class="col-md-12 mb-4">
                <h5>Bantuan / Info Halaman</h5>
                <div class="alert alert-info">
                    <ul class="mb-0">
                        @foreach($helpTopics as $help)
                            <li>{{ $help }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($products->isEmpty() && empty($helpTopics))
            <div class="col-md-12 text-center mt-5 mb-5">
                <h4 class="text-muted mt-3">Yah, pencarianmu tidak membuahkan hasil.</h4>
                <p>Coba gunakan kata kunci lain seperti nama brand, tipe bensin, transmisi, atau lokasi.</p>
            </div>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
