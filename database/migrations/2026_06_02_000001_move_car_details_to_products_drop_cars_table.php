<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'images')) {
                $table->json('images')->nullable()->after('image');
            }

            if (! Schema::hasColumn('products', 'tahun')) {
                $table->integer('tahun')->nullable()->after('images');
            }

            if (! Schema::hasColumn('products', 'warna')) {
                $table->string('warna')->nullable()->after('tahun');
            }

            if (! Schema::hasColumn('products', 'plat_nomor')) {
                $table->string('plat_nomor')->nullable()->after('warna');
            }

            if (! Schema::hasColumn('products', 'kapasitas_mesin')) {
                $table->integer('kapasitas_mesin')->nullable()->after('plat_nomor');
            }

            if (! Schema::hasColumn('products', 'fitur')) {
                $table->json('fitur')->nullable()->after('kapasitas_mesin');
            }

            if (! Schema::hasColumn('products', 'kondisi')) {
                $table->text('kondisi')->nullable()->after('fitur');
            }
        });

        if (Schema::hasTable('cars')) {
            DB::table('cars')
                ->chunkById(100, function ($cars) {
                    foreach ($cars as $car) {
                        $product = DB::table('products')->where('id', $car->product_id)->first();

                        if (! $product) {
                            continue;
                        }

                        DB::table('products')
                            ->where('id', $car->product_id)
                            ->update([
                                'images' => $product->images ?? $car->images,
                                'tahun' => $product->tahun ?? $car->tahun,
                                'warna' => $product->warna ?? $car->warna,
                                'plat_nomor' => $product->plat_nomor ?? $car->plat_nomor,
                                'kapasitas_mesin' => $product->kapasitas_mesin ?? $car->kapasitas_mesin,
                                'fitur' => $product->fitur ?? $car->fitur,
                                'kondisi' => $product->kondisi ?? $car->kondisi,
                            ]);
                    }
                });
        }

        Schema::dropIfExists('cars');
    }

    public function down(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('tahun')->nullable();
            $table->string('warna')->nullable();
            $table->string('plat_nomor')->nullable();
            $table->string('transmisi')->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->integer('kapasitas_mesin')->nullable();
            $table->integer('kapasitas_penumpang')->nullable();
            $table->json('fitur')->nullable();
            $table->text('kondisi')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }
};
