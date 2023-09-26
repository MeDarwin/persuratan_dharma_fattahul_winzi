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
    public function index()
    {
        $years = Carbon::now();
        $years_diagram = $this->subtractYears($years);

        foreach ($years_diagram as $year) {
            $all_counts[] = Surat::query()->where(DB::raw('YEAR(tanggal_surat)'), $year)->get()->count();
        }

        // ! NEED REFACTOR. app still do unneccessary queries upon different role
        $data = [
            'surat_terbaru'      => Surat::query()->take(5)->get(['ringkasan', 'file', 'tanggal_surat']),
            'surat_data_diagram' => $all_counts,
            'tahun_diagram'      => $years_diagram,
            'user_diagram'       => User::query()->take(10)->has('surat', '>=', 5)->get('username')->pluck('username'),
            'user_data_diagram'  => User::query()->take(10)->has('surat', '>=', 5)->get('id')->map(function (User $user) {
                return Surat::with('user')->where('id_user', $user->id)->get()->count();
            }),
        ];
        return JenisSurat::with('surat')->get(); //!todo count on most popular
        return view('dashboard.index', $data);
    }
}