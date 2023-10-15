<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            (object) [
                "pemesan" => "Peter Drury",
                "noTelp" => "0819293232",
                "approver" => 1,
                "deadline" => "+3 months",
                "provinsi" => "Jawa Barat",
                "kota" => "Kota Bandung",
                "alamat" => "Jl. Sederhana no 23",
                "sk" => "DP 30%",
                "ket_tambahan" => "",
                "persenDP" => 30,
                "totalDP" => 24750,
                "totalQty" => 55,
                "totalTransaksi" => 82500
            ],
            (object)[
                "pemesan" => "Ben Taison",
                "noTelp" => "088192920121",
                "approver" => 1,
                "deadline" => "+2 months",
                "provinsi" => "Jawa Barat",
                "kota" => "Kota Bandung",
                "alamat" => "Jl. Sukamaju no 77",
                "sk" => "DP 5%",
                "ket_tambahan" => "",
                "persenDP" => 5,
                "totalDP" => 1500,
                "totalQty" => 20,
                "totalTransaksi" => 30000
            ],
        ];
        $startDate = time();
        foreach ($transactions as $index => $transaction) {
            Transaction::create([
                'pemesan' => $transaction->pemesan,
                'noTelp' => $transaction->noTelp,
                'approved_by' => $transaction->approver,
                'status' => $transaction->approver ? 1 : 0,
                'deadline' => date('Y-m-d H:i:s', strtotime($transaction->deadline, $startDate)),
                'provinsi' => $transaction->provinsi,
                'kota' => $transaction->kota,
                'alamat' => $transaction->alamat,
                'sk' => $transaction->sk,
                'ket_tambahan' => $transaction->ket_tambahan,
                'persen_DP' => $transaction->persenDP,
                'total_DP' => $transaction->totalDP,
                'total_qty' => $transaction->totalQty,
                'total_transaksi' => $transaction->totalTransaksi,
            ]);
        }
    }
}
