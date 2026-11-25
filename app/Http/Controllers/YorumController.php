<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YorumController extends Controller
{
    public function index()
    {
        $yorumlar = DB::table('yorumlar')
            ->leftJoin('araclar', 'yorumlar.arac_id', '=', 'araclar.id')
            ->select('yorumlar.*', 'araclar.marka', 'araclar.model')
            ->orderBy('yorumlar.id', 'desc')
            ->get();

        $arabalar = DB::table('araclar')->get();

        return view('yorumlar', compact('yorumlar', 'arabalar'));
    }

    public function store(Request $request)
    {
        DB::table('yorumlar')->insert([
            'arac_id'    => $request->arac_id,
            'yazan_ad'   => $request->yazan_ad,
            'puan'       => $request->puan,
            'yorum'      => $request->yorum,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/yorumlar')->with('basari', 'Yeni yorum eklendi!');
    }

    public function update(Request $request, $id)
    {
        DB::table('yorumlar')->where('id', $id)->update([
            'arac_id'    => $request->arac_id,
            'yazan_ad'   => $request->yazan_ad,
            'puan'       => $request->puan,
            'yorum'      => $request->yorum,
            'updated_at' => now(),
        ]);

        return redirect('/yorumlar')->with('basari', 'Yorum güncellendi!');
    }

    public function destroy($id)
    {
        DB::table('yorumlar')->where('id', $id)->delete();
        return redirect('/yorumlar')->with('basari', 'Yorum silindi!');
    }
}