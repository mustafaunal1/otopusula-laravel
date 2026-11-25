<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AracController extends Controller
{
    public function index()
    {
        $arabalar = DB::table('araclar')->orderBy('id', 'desc')->get();
        return view('araclar', ['arabalar' => $arabalar]);
    }

    public function store(Request $request)
    {
        DB::table('araclar')->insert([
            'marka'      => $request->marka,
            'model'      => $request->model,
            'yil'        => $request->yil,
            'yakit_turu' => $request->yakit_turu,
            'motor_gucu' => $request->motor_gucu,
        ]);

        return redirect('/araclar')->with('basari', 'Yeni araç başarıyla eklendi!');
    }

    public function update(Request $request, $id)
    {
        DB::table('araclar')->where('id', $id)->update([
            'marka'      => $request->marka,
            'model'      => $request->model,
            'yil'        => $request->yil,
            'yakit_turu' => $request->yakit_turu,
            'motor_gucu' => $request->motor_gucu,
        ]);

        return redirect('/araclar')->with('basari', 'Araç bilgileri güncellendi!');
    }

    public function destroy($id)
    {
        DB::table('araclar')->where('id', $id)->delete();
        return redirect('/araclar')->with('basari', 'Araç kaydı silindi!');
    }
}