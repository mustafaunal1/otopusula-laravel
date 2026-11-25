<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BakimController extends Controller
{
    public function index()
    {
        $bakimlar = DB::table('bakimlar')
            ->leftJoin('araclar', 'bakimlar.arac_id', '=', 'araclar.id')
            ->select('bakimlar.*', 'araclar.marka', 'araclar.model')
            ->orderBy('bakimlar.id', 'desc')
            ->get();

        $arabalar = DB::table('araclar')->get();

        return view('bakimlar', compact('bakimlar', 'arabalar'));
    }

    public function store(Request $request)
    {
        DB::table('bakimlar')->insert([
            'arac_id'    => $request->arac_id,
            'islem_turu' => $request->islem_turu,
            'tarih'      => $request->tarih,
            'kilometre'  => $request->kilometre,
            'tutar'      => $request->tutar,
            'aciklama'   => $request->aciklama,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/bakimlar')->with('basari', 'Bakım kaydı eklendi!');
    }

    public function update(Request $request, $id)
    {
        DB::table('bakimlar')->where('id', $id)->update([
            'arac_id'    => $request->arac_id,
            'islem_turu' => $request->islem_turu,
            'tarih'      => $request->tarih,
            'kilometre'  => $request->kilometre,
            'tutar'      => $request->tutar,
            'aciklama'   => $request->aciklama,
            'updated_at' => now(),
        ]);

        return redirect('/bakimlar')->with('basari', 'Bakım kaydı güncellendi!');
    }

    public function destroy($id)
    {
        DB::table('bakimlar')->where('id', $id)->delete();
        return redirect('/bakimlar')->with('basari', 'Bakım kaydı silindi!');
    }
}