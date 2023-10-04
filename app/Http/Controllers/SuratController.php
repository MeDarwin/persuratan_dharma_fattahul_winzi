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
    public function indexEdit(Request $request)
    {
        $data = [
            'surat'  => Surat::with(['jenis', 'user'])->find($request->id),
            'all_js' => JenisSurat::all()
        ];
        return view('manage.edit.surat', $data);
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
    public function updateFile(Request $request)
    {
        // DELETE OLD FILE
        $request->validate(['file' => 'required|mimes:pdf']);
        $curr_surat = Surat::find($request->id);
        $old_path = $curr_surat->file;
        if (!empty($old_path) && Storage::disk("public")->exists($old_path)) {
            Storage::disk("public")->delete($old_path);
        }
        if ($path = $request->file('file')) {
            $path = $path->storePublicly('', 'public');
        }
        return $curr_surat->fill(['file' => $path])->save()
            ? redirect()->to('/surat')->with('success', 'Surat file has changed')
            : redirect()->back()->with('err', 'Surat failed to change');
    }
    public function deleteFile(Request $request)
    {
        $curr_surat = Surat::find($request->id);
        $path = $curr_surat->file;
        $curr_surat->file = null;
        $delete_path = $curr_surat->save();
        if (empty($path) || !Storage::disk("public")->exists($path)) {
            $msg = $delete_path ? "but path IS deleted" : "and path is NOT deleted";
            $request->session()->flash('warn', "File $path may not exists $msg");
        }
        Storage::disk("public")->delete($path);
        return $delete_path
            ? $request->session()->flash('success', "File $curr_surat->file deleted")
            : $request->session()->flash('err', "File $curr_surat->file may not exists");
    }
    public function update(SuratRequest $surat)
    {
        return Surat::query()->find($surat->id)->fill($surat->validated())->save()
            ? redirect()->to('/surat')->with('success', 'Surat updated')
            : redirect()->to('/surat')->with('err', 'Surat failed to update');
    }
}