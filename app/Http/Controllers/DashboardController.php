<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Surat;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /* ----------------------------- CUSTOM FUNCTION ---------------------------- */
    private function subtractYears(Carbon $year): array
    {
        $year->addYear();
        for ($i = 0; $i < 5; $i++) {
            $retVal[] = $year->subYear()->format('Y');
        }
        return $retVal;
    }
    /* ---------------------------------- VIEWS --------------------------------- */
    // ! NEED REFACTOR. app still do unneccessary queries upon different role
    public function index()
    {
        $years = Carbon::now();
        $years_diagram = $this->subtractYears($years);

        foreach ($years_diagram as $year) {
            $all_counts[] = Surat::query()->where(DB::raw('YEAR(tanggal_surat)'), $year)->get()->count();
        }
        $surat_diagram = User::with('surat')
            ->has('surat')
            ->withCount('surat')->orderByDesc('surat_count')
            ->take(10)->get(['username']);
        $jenis_diagram = JenisSurat::has('surat')->withCount('surat')->orderByDesc('surat_count')->take(5)->get(['jenis_surat']);
        $surat = Surat::query()->orderByDesc(DB::raw('YEAR(tanggal_surat)'))->take(5)->get(['ringkasan', 'file', 'tanggal_surat']);
        $data = [
            'surat_terbaru'      => $surat,
            'surat_diagram_data' => $all_counts,
            'tahun_diagram'      => $years_diagram,
            'user_diagram'       => $surat_diagram->pluck('username'),
            'user_diagram_data'  => $surat_diagram->pluck("surat_count"),
            'jenis_diagram'      => $jenis_diagram->pluck('jenis_surat'),
            'jenis_diagram_data' => $jenis_diagram->pluck('surat_count'),
        ];
        return view('dashboard.index', $data);
    }
}