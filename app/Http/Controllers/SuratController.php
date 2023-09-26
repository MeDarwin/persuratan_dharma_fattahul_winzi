<?php

namespace App\Http\Controllers;

use App\Http\Requests\Surat\SuratRequest;
use App\Models\JenisSurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Storage;

class SuratController extends Controller
{
    /* ---------------------------------- VIEWS --------------------------------- */
    public function index()
    {
        $data = ['surats' => Surat::with(['jenis', 'user'])->get()];
        return view('manage.surat', $data);
    }
    public function indexAdd()
    {
        $data = ['all_js' => JenisSurat::all()];
        return view('manage.add.surat', $data);
    }


    /* --------------------------------- ACTION --------------------------------- */
    public function add(SuratRequest $request)
    {
        $data = $request->validated();
        if ($path = $request->file('file')) {
            $path = $path->storePublicly('', 'public');
            $data['file'] = $path;
        }
        return Surat::query()->create($data)
            ? redirect()->to('/surat')->with('success', 'Surat sent')
            : redirect()->back()->with('err', 'Surat failed to send');
    }
    public function download(Request $request)
    {
        return Storage::disk("public")->download("$request->path");
    }
    public function destroy(Request $request)
    {
        $file_deletion = '';
        if ($curr_surat = Surat::query()->find($request->id, 'file'))
            $path = $curr_surat->file;
        if (!empty($path) && Storage::disk("public")->exists($path))
            Storage::disk("public")->delete($path) ? $file_deletion = 'with file deleted' : $file_deletion = 'with file undeleted';
        return Surat::query()->find($request->id)->delete()
            ? $request->session()->flash('success', "Surat deleted $file_deletion")
            : $request->session()->flash('err', 'Surat failed to delete');
    }
}