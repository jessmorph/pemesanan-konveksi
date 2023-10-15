<?php

namespace Database\Seeders;

use App\Models\Baju;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BajuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listBaju = [
            (object) [
                "bahan" => "Toyobo Fodu Premium Quality",
                "warna" => "Merah Maroon",
                "model" => "Scrub",
                "name" => "Zoella",
                "gambar" => "gambar template",
                "keterangan" => "keterangan template",
                'xxs' => 0,
                'xs' => 0,
                's' => 10,
                'm' => 10,
                'l' => 10,
                'xl' => 0,
                'xxl' => 0,
                'xxxl' => 0,
                'xxxxl' => 0,
                'totalQty' => 30,
                'hargaSatuan' => 1500,
                'transaction_id' => 1
            ],
            (object)[
                "bahan" => "Cotton Madinah",
                "warna" => "Biru Muda",
                "model" => "Scrub",
                "name" => "Zoella",
                "gambar" => "gambar template",
                "keterangan" => "keterangan template",
                'xxs' => 0,
                'xs' => 5,
                's' => 5,
                'm' => 5,
                'l' => 5,
                'xl' => 5,
                'xxl' => 0,
                'xxxl' => 0,
                'xxxxl' => 0,
                'totalQty' => 25,
                'hargaSatuan' => 1500,
                'transaction_id' => 1
            ],
            (object)[
                "bahan" => "Cotton Combed 24s",
                "warna" => "Hitam",
                "model" => "Kaos Krag Lengan Panjang",
                "name" => "MediBlack",
                "gambar" => "gambar template",
                "keterangan" => "keterangan template",
                'xxs' => 0,
                'xs' => 5,
                's' => 5,
                'm' => 5,
                'l' => 10,
                'xl' => 0,
                'xxl' => 0,
                'xxxl' => 0,
                'xxxxl' => 0,
                'totalQty' => 20,
                'hargaSatuan' => 1500,
                'transaction_id' => 2
            ],
        ];
        foreach ($listBaju as $baju) {
            Baju::create([
                'bahan' => $baju->bahan,
                'warna' => $baju->warna,
                'model' => $baju->model,
                'name' => $baju->name,
                'xxs' => $baju->xxs,
                'xs' => $baju->xs,
                's' => $baju->s,
                'm' => $baju->m,
                'l' => $baju->l,
                'xl' => $baju->xl,
                'xxl' => $baju->xxl,
                'xxxl' => $baju->xxxl,
                'xxxxl' => $baju->xxxxl,
                'totalBaju' => $baju->totalQty,
                'hargaSatuan' => $baju->hargaSatuan,
                'keterangan' => $baju->keterangan,
                'gambar' => $baju->gambar,
                'transaction_id' => $baju->transaction_id
            ]);
        }
    }
}
