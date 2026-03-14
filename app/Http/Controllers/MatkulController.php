<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MatkulController extends Controller
{
    public function index(){
        $path = resource_path('json/matkul.json');
            
            if (!file_exists($path)) {
                return response()->json(['error' => 'File missing'], 404);
            }

            $data = file_get_contents($path);
            $matkul = json_decode($data, true);

            return response()->json($matkul);
    }

    public function show($id){
        $path = resource_path('json/matkul.json');
            
            if (!file_exists($path)) {
                return response()->json(['error' => 'File missing'], 404);
            }

            $data = file_get_contents($path);
            $matkul = json_decode($data, true);

            foreach ($matkul['matkul'] as $item) {
                if ($item['id'] == $id) {
                    return response()->json($item);
                }
            }

            return response()->json(['error' => 'Matkul opo toh iku rek'], 404);
    }
   
}


