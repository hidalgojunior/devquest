<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class StudentImportController extends Controller
{
    public function show()
    {
        return view('students.import');
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,xls']);

        $path = $request->file('file')->store('imports');
        Excel::import(new StudentsImport, storage_path('app/'.$path));

        return back()->with('status', __('Alunos importados com sucesso!'));
    }
}
