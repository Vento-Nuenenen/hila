<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use DB;
use Illuminate\Http\Request;
use PDF;

class GratulationPrintController extends Controller
{
    public function index()
    {
        $text = file_get_contents(storage_path('app/template/gratulation.txt'));
        $title_m = file_get_contents(storage_path('app/template/title_m.txt'));
        $title_f = file_get_contents(storage_path('app/template/title_f.txt'));
        $title_o = file_get_contents(storage_path('app/template/title_o.txt'));

        return view('gratulation.gratulation', ['text' => $text, 'title_m' => $title_m, 'title_f' => $title_f, 'title_o' => $title_o]);
    }

    public function export(Request $request)
    {
        if ($request->action == 'save') {
            file_put_contents(storage_path('app/template/gratulation.txt'), $request->certificate_text);
            file_put_contents(storage_path('app/template/title_m.txt'), $request->title_m);
            file_put_contents(storage_path('app/template/title_f.txt'), $request->title_f);
            file_put_contents(storage_path('app/template/title_o.txt'), $request->title_o);

            return redirect()->back()->with('message', 'Neuer Text wurde gespeichert!');
        } elseif ($request->input('action') == 'print') {
            $persons = DB::table('participations')->where('course_passed', '=', true)->get();

            foreach ($persons as $person) {
                $text = $request->certificate_text;
                $title = '';

                if (substr($person->gender, 0, 1) == 'M') {
                    $title = file_get_contents(storage_path('app/template/title_m.txt'));
                } elseif (substr($person->gender, 0, 1) == 'W') {
                    $title = file_get_contents(storage_path('app/template/title_f.txt'));
                } elseif (substr($person->gender, 0, 1) == 'A') {
                    $title = file_get_contents(storage_path('app/template/title_o.txt'));
                }

                if (isset($person->scout_name)) {
                    $text = str_replace('@name', $person->scout_name, $text);
                } else {
                    $text = str_replace('@name', $person->first_name, $text);
                }

                $text = str_replace('@title', $title, $text);

                PDF::SetTitle(config('app.name'));
                PDF::SetFont('helvetica', 'B', 18);
                PDF::SetCreator(config('app.name'));
                PDF::SetAuthor(config('app.name'));
                PDF::SetTopMargin(50);

                PDF::AddPage();
                PDF::MultiCell(0, 10, $text, 0, 'C');
            }

            return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
        }
    }
}
