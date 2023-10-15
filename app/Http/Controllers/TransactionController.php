<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
  public function index()
  {
    $listOnProgress = DB::table('transactions')
      ->join('users', 'users.id', '=', 'transactions.approved_by')
      ->select('transactions.id as id', 'pemesan', 'deadline', 'users.namaUser as namaUser')
      ->where('status', 1)
      ->get();
    foreach ($listOnProgress as $value) {
      $value->deadline = formatDate($value->deadline);
      $value->NoPO = formatNoPO($value->id);
    }
    return view('onprogress.progress', [
      'active' => 'onprogress',
      'data' => $listOnProgress
    ]);
  }

  public function viewPending()
  {
    $listPendForm = DB::table('transactions')
      ->join('users', 'users.id', '=', 'transactions.approved_by')
      ->select('transactions.id as id', 'transactions.created_at', 'noTelp', 'pemesan', 'users.namaUser as namaUser')
      ->where('status', 0)
      ->get();
    foreach ($listPendForm as $value) {
      $value->created_at = formatDate($value->created_at);
      $value->NoPO = formatNoPO($value->id);
    }
    return view('pendingform.pendform', [
      'active' => 'pending-form',
      'dataPend' => $listPendForm
    ]);
  }

  public function viewHistory(Request $request)
  {
    $q = $request->q;
    $startDate = "";
    $endDate = "";
    if (isset($request->startDate)) {
      $startDate = $request->startDate;
    }
    if (isset($request->endDate)) {
      $endDate = $request->endDate;
    }
    $queryHistory = DB::table('transactions')
      ->join('users', 'users.id', '=', 'transactions.approved_by')
      ->select('transactions.id as id', 'transactions.updated_at', 'pemesan', 'users.namaUser as namaUser')
      ->orderByDesc('transactions.updated_at')
      ->where('status', 2)
      ->where('transactions.pemesan', 'like', '%' . $q . '%');
    $queryOmset = DB::table('transactions')->where('status', 2)->where('transactions.pemesan', 'like', '%' . $q . '%');
    if ($startDate && $endDate) {
      $listHistory = $queryHistory->whereDate('transactions.updated_at', '>=', $startDate)->whereDate('transactions.updated_at', '<=', $endDate)->paginate(10);
      $totalOmset = $queryOmset->whereDate('transactions.updated_at', '>=', $startDate)->whereDate('transactions.updated_at', '<=', $endDate)->sum('total_transaksi');
    } else {
      $listHistory = $queryHistory->paginate(10);
      $totalOmset = $queryOmset->sum('total_transaksi');
    }
    foreach ($listHistory as $value) {
      $value->updated_at = formatDate($value->updated_at);
      $value->NoPO = formatNoPO($value->id);
    }
    return view('history.history', [
      'active' => 'history',
      'dataHistory' => $listHistory,
      'totalOmset' => $totalOmset
    ]);
  }

  public function createPO(Request $request)
  {
    $transactionId = DB::table('transactions')->insertGetId([
      'pemesan' => ucwords($request->pemesan),
      'noTelp' => $request->noTelp,
      'provinsi' =>ucwords($request->provinsi),
      'kota' => ucwords($request->kota),
      'alamat' => ucwords($request->alamat),
      'sk' => ucwords($request->sk),
      'ket_tambahan' => ucwords($request->keteranganTambahan),
      'persen_DP' => $request->persenDP,
      'total_DP' => $request->hargaPODP,
      'total_qty' => $request->totalPOQty,
      'total_transaksi' => $request->hargaPOTotal,
      'deadline' => $request->deadline,
      'status' => $request->type == 'Submit' ? 1 : 0,
      'approved_by' => Auth::id(),
      "created_at" =>  date('Y-m-d H:i:s'),
      "updated_at" => date('Y-m-d H:i:s'),
    ]);

    $listBaju = json_decode($request->listBaju);
    if ($listBaju && count($listBaju) > 0) {
      foreach ($listBaju as $baju) {
        $folderPath = "uploads/";
        $file = null;
        if (!isset($baju->isDeleted)) {
          if ($baju->gambar) {
            $base64Image = explode(";base64,", $baju->gambar);
            $explodeImage = explode("image/", $base64Image[0]);
            $imageType = $explodeImage[1];
            $image_base64 = base64_decode($base64Image[1]);
            $file = $folderPath . uniqid() . '.' . $imageType;
            file_put_contents($file, $image_base64);
          }
          DB::table('baju')->insert([
            'bahan' => $baju->bahan,
            'warna' => $baju->warna,
            'model' => $baju->model,
            'name' => $baju->nama,
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
            'gambar' => $file,
            'keterangan' => $baju->keterangan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'transaction_id' => $transactionId
          ]);
        }
      };
    }
    if ($request->type === 'Submit') {
      return redirect()->intended('/');
    }
    return redirect()->intended('/pending-form');
  }

  public function getTransaction(string $request)
  {
    $id = (int) $request;
    if ($id) {
      $dataTransaksi = DB::table('transactions')
        ->select('deadline', 'noTelp', 'pemesan', 'kota', 'provinsi', 'alamat', 'ket_tambahan', 'sk', 'persen_DP', 'total_DP', 'total_qty', 'total_transaksi')
        ->where('id', $id)
        ->first();
      $dataBaju = DB::table('baju')
        ->select('id', 'bahan', 'warna', 'model', 'name', 'xxs', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'totalBaju', 'hargaSatuan', 'gambar', 'keterangan')
        ->where('transaction_id', $id)
        ->get();
      if ($dataTransaksi) {
        // $dataTransaksi->created_at = formatDate($dataTransaksi->created_at);
        $dataTransaksi->deadline = explode(" ", $dataTransaksi->deadline)[0];
        $dataTransaksi->total_DP_currency = parseCurrency($dataTransaksi->total_DP);
        $dataTransaksi->total_transaksi_currency = parseCurrency($dataTransaksi->total_transaksi);

        foreach ($dataBaju as $baju) {
          $baju->totalHarga = $baju->hargaSatuan * $baju->totalBaju;
          $baju->totalHarga_currency = parseCurrency($baju->hargaSatuan * $baju->totalBaju);
          $baju->hargaSatuan_currency = parseCurrency($baju->hargaSatuan);
          if ($baju->gambar) {
            $baju->gambar = url($baju->gambar);
          }
          $baju->nama = $baju->name;
          $baju->totalQty = $baju->totalBaju;
        }
        return view('inputform.inform', [
          'active' => 'input-form',
          'dataTransaksi' => $dataTransaksi,
          'dataBaju' => json_encode($dataBaju),
        ]);
      }
    }
    abort(404);
  }

  public function updateTransaction(Request $request)
  {
    $transactionId = (int) $request->id;
    if ($transactionId) {
      $dataTransaksi = DB::table('transactions')->select('pemesan')->where('id', $transactionId);
      if ($dataTransaksi) {
        DB::table('transactions')
          ->where('id', $transactionId)
          ->update([
            'pemesan' => ucwords($request->pemesan),
            'noTelp' => $request->noTelp,
            'provinsi' => ucwords($request->provinsi),
            'kota' => ucwords($request->kota),
            'alamat' => ucwords($request->alamat),
            'sk' => ucwords($request->sk),
            'ket_tambahan' => ucwords($request->keteranganTambahan),
            'persen_DP' => $request->persenDP,
            'total_DP' => $request->hargaPODP,
            'total_qty' => $request->totalPOQty,
            'total_transaksi' => $request->hargaPOTotal,
            'deadline' => $request->deadline,
            'status' => $request->type == 'Submit' ? 1 : 0,
            'approved_by' => Auth::id(),
            "updated_at" => date('Y-m-d H:i:s'),
          ]);
        // delete semua baju
        DB::table('baju')->where('transaction_id', '=', $transactionId)->delete();
        $listBaju = json_decode($request->listBaju);
        foreach ($listBaju as $baju) {
          $folderPath = "uploads/";
          $file = null;
          // desain baju di delete
          if (isset($baju->isDeleted) && $baju->gambar != "" && str_contains($baju->gambar, $folderPath)) {
            $oldImage = explode($folderPath, $baju->gambar)[1];
            $oldImagePath = $folderPath . $oldImage;
            removeImage($oldImagePath);
          }
          // ada perubaan gambar -> hapus gambar lama
          if (isset($baju->gambarLama) && $baju->gambarLama != "") {
            if (strcmp($baju->gambarLama, $baju->gambar) != 0) {
              $oldImage = explode($folderPath, $baju->gambarLama)[1];
              $oldImagePath = $folderPath . $oldImage;
              removeImage($oldImagePath);
            }
          }
          // gambar tetap ada
          if ($baju->gambar) {
            // gambar tidak berubah -> input lg ke db
            if (str_contains($baju->gambar, $folderPath)) {
              $path = explode($folderPath, $baju->gambar);
              $file = $folderPath . $path[1];
            } else {
              // gambar berubah
              $base64Image = explode(";base64,", $baju->gambar);
              $explodeImage = explode("image/", $base64Image[0]);
              $imageType = $explodeImage[1];
              $image_base64 = base64_decode($base64Image[1]);
              $file = $folderPath . uniqid() . '.' . $imageType;
              file_put_contents($file, $image_base64);
            }
          }
          // insert semua baju
          if (!isset($baju->isDeleted)) {
            DB::table('baju')->insert([
              'bahan' => ucwords($baju->bahan),
              'warna' => ucwords($baju->warna),
              'model' => ucwords($baju->model),
              'name' => ucwords($baju->nama),
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
              'gambar' => $file,
              'keterangan' => ucwords($baju->keterangan),
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'transaction_id' => $transactionId
            ]);
          }
        };
        return back()->with('successUpdate', 'Success Update Form PO');
      }
    }
    abort(404);
  }

  public function generateFormPO(string $request)
  {
    $id = (int) $request;
    if ($id) {
      $dataTransaksi = DB::table('transactions')
        ->select('id', 'created_at', 'pemesan', 'noTelp', 'deadline', 'provinsi', 'kota', 'alamat', 'sk', 'ket_tambahan', 'persen_DP', 'total_DP', 'total_qty', 'total_transaksi')
        ->where('id', $id)
        ->first();
      $dataBaju = DB::table('baju')
        ->select('id', 'bahan', 'warna', 'model', 'name', 'xxs', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'totalBaju', 'hargaSatuan', 'gambar', 'keterangan')
        ->where('transaction_id', $id)
        ->get();
      if ($dataTransaksi) {
        $dataTransaksi->created_at = formatDate($dataTransaksi->created_at);
        $dataTransaksi->deadline = formatDate($dataTransaksi->deadline);
        $dataTransaksi->total_DP = parseCurrency($dataTransaksi->total_DP);
        $dataTransaksi->total_transaksi = parseCurrency($dataTransaksi->total_transaksi);

        foreach ($dataBaju as $baju) {
          $baju->totalHarga = parseCurrency($baju->hargaSatuan * $baju->totalBaju);
          $baju->hargaSatuan = parseCurrency($baju->hargaSatuan);
        }
        $data = [
          'dataTransaksi' => $dataTransaksi,
          'dataBaju' => $dataBaju
        ];

        $pdf = PDF::loadView('formpo.formpo', $data);
        $namaFile = 'formPO-' . formatNoPO($id) . '.pdf';
        return $pdf->download($namaFile);
        // return view('formpo.formpo', [
        //   'active' => 'formpo',
        //   'dataTransaksi' => $dataTransaksi,
        //   'dataBaju' => $dataBaju,
        // ]);
      }
    }
    abort(404);
  }

  public function generateFormWorksheet(string $request)
  {
    $id = (int) $request;
    if ($id) {
      $dataBaju = DB::table('baju')
        ->select('id', 'xxs', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'totalBaju', 'gambar', 'keterangan')
        ->where('transaction_id', $id)
        ->get();
      if ($dataBaju) {
        $data = [
          'data' => $dataBaju
        ];

        $pdf = PDF::loadView('formworksheet.worksheet', $data);
        $namaFile = 'worksheet-' . formatNoPO($id) . '.pdf';
        return $pdf->download($namaFile);
        // return view('formworksheet.worksheet', [
        //   'active' => 'formpo',
        //   'data' => $dataBaju,
        // ]);
      }
    }
    abort(404);
  }



  public function generateFormInvoice(string $request)
  {
    $id = (int) $request;
    if ($id) {
      $dataTransaksi = DB::table('transactions')
        ->select('id', 'created_at', 'pemesan', 'total_DP', 'total_transaksi')
        ->where('id', $id)
        ->first();
      $dataBaju = DB::table('baju')
        ->select('bahan', 'warna', 'model', 'name', 'totalBaju', 'hargaSatuan')
        ->where('transaction_id', $id)
        ->get();
      if ($dataTransaksi) {
        $dataTransaksi->NoPO = formatNoPO($dataTransaksi->id);
        $dataTransaksi->created_at = formatDate($dataTransaksi->created_at);
        $dataTransaksi->total_DP = parseCurrency($dataTransaksi->total_DP);
        $dataTransaksi->total_transaksi = parseCurrency($dataTransaksi->total_transaksi);

        foreach ($dataBaju as $baju) {
          $baju->totalHarga = parseCurrency($baju->hargaSatuan * $baju->totalBaju);
          $baju->hargaSatuan = parseCurrency($baju->hargaSatuan);
        }

        $data = [
          'dataTransaksi' => $dataTransaksi,
          'dataBaju' => $dataBaju
        ];

        $pdf = PDF::loadView('forminvoice.forminvoice', $data);
        $namaFile = 'invoice-' . formatNoPO($id) . '.pdf';
        return $pdf->download($namaFile);
        // return view('forminvoice.forminvoice', [
        //   'active' => 'forminvoice',
        //   'dataTransaksi' => $dataTransaksi,
        //   'dataBaju' => $dataBaju,
        // ]);
      }
    }
    abort(404);
  }
  public function selesaiPekerjaan(Request $request)
  {
    $id = (int) $request->idSelesai;
    if ($id) {
      DB::table('transactions')
        ->where('id', $id)
        ->update(['status' => 2, 'updated_at' => date('Y-m-d H:i:s')]);
      return redirect()->intended('/');
    }
    abort(404);
  }

  public function deletePekerjaan(Request $request)
  {
    $id = (int) $request->idDelete;
    if ($id) {
      $listBaju = DB::table('baju')->select('gambar')->where('transaction_id', '=', $id)->get();
      foreach ($listBaju as $baju) {
        removeImage($baju->gambar);
      };
      DB::table('baju')->where('transaction_id', $id)->delete();
      DB::table('transactions')
        ->where('id', $id)
        ->delete();
      return redirect()->intended('/');
    }
    abort(404);
  }
}
