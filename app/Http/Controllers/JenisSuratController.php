<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisSurat\JenisSuratRequest;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /* ---------------------------------- VIEWS --------------------------------- */
    public function indexAdd()
    {
        return view('manage.add.jenis_surat');
    }
    public function indexEdit(Request $request)
    {
        $data = ['js' => JenisSurat::query()->find($request['id'])];
        return view('manage.edit.jenis_surat', $data);
    }
    public function index()
    {
        $data = ['all_js' => JenisSurat::all()];
        return view('manage.jenis_surat', $data);
    }
    /* ---------------------------------- ACTION --------------------------------- */
    public function add(JenisSuratRequest $request)
    {
        return JenisSurat::query()->create($request->validated())
            ? redirect()->to('/surat/jenis')->with('success', 'Jenis surat created')
            : redirect()->back()->with('err', 'Jenis surat failed to creat');
    }
    public function update(JenisSuratRequest $request)
    {
        return JenisSurat::query()->find($request['id'])->fill($request->validated())->save()
            ? redirect()->to('/surat/jenis')->with('success', 'Jenis surat updated')
            : redirect()->to('/surat/jenis')->with('err', 'Jenis surat failed to update');
    }
    public function destroy(Request $request)
    {
        return JenisSurat::query()->find($request['id'])->delete()
            ? $request->session()->flash('success', 'Jenis surat deleted')
            : $request->session()->flash('err', 'Jenis surat failed to delete');
    }
}