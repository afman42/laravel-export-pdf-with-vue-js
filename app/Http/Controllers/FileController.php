<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\File;

class FileController extends Controller
{
  public function index(){
    return view('export-pdf');
  }

  public function export(Request $request){
    $filename = 'hello-world.pdf';
    $html = $request->html;
    $file_path = public_path().'/'.$filename;
    $file_update = File::find(1);
    if ($file_update) {
      $file_update->filename = $filename;
      $file_update->html = $html;
      $file_update->file_path = $file_path;
      $update = $file_update->save();
      if (!$update) {
        return response()->json([
          'status' => 'Something Went Wrong'
        ]);
      }
    }else{
      $save = File::create([
        'filename' => $filename,
        'html' => $html,
        'file_path' => $filename
      ]);
      if (!$save) {
        return response()->json([
          'status' => 'Something Went Wrong'
        ]);
      }
    }
    Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save($file_path);
    return response()->json([
      'status' => 'success'
    ]);
  }
}
