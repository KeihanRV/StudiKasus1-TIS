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

            foreach ($matkul as $item) {
                if ($item['id'] == $id) {
                    return response()->json($item);
                }
            }

            return response()->json(['error' => 'Matkul opo toh iku rek'], 404);
    }

    public function store(Request $request){
        try{
            $validate = $request->validate([
                'id' => 'required|integer',
                'nama' => 'required|string',
                'kode' => 'required|regex:/^[A-Z]{3}[0-9]{3}$/',
                'sks' => 'required|numeric|min:1|max:6'
            ]);
            $newMatkul = [
                'id' => $validate['id'],
                'nama' => $validate['nama'],
                'kode' => $validate['kode'],
                'sks' => $validate['sks']
            ];
            $path = resource_path('json/matkul.json');
            if (!file_exists($path)) {
                    return response()->json(['error' => 'File missing'], 404);
                }
            $data = file_get_contents($path);
            $matkul = json_decode($data, true);
            $matkul[] = $newMatkul;
            file_put_contents($path, json_encode($matkul, JSON_PRETTY_PRINT));
            return response()->json(['message' => 'Data berhasil ditambahkan'], 201);
        }catch(\Exception $e){
            return response()->json(['error' => 'Gagal nambah data'], 500);
        }
    }

    public function update(Request $request, $id){
        try{
             $validate = $request->validate([
                'nama' => 'string',
                'kode' => 'regex:/^[A-Z]{3}[0-9]{3}$/',
                'sks' => 'numeric|min:1|max:6'
            ]);
        } catch(\Illuminate\Validation\ValidationException $th){
            return response()->json(['error' => 'Validasi gagal', 'details' => $th->errors()], 422);
        }

        $path = resource_path('json/matkul.json');
            if (!file_exists($path)) {
                    return response()->json(['error' => 'File missing'], 404);
                }
            $data = file_get_contents($path);
            $matkul = json_decode($data, true);
            foreach ($matkul as &$item) {
                if ($item['id'] == $id) {
                    if(isset($validate['nama'])) $item['nama'] = $validate['nama'];
                    if(isset($validate['kode'])) $item['kode'] = $validate['kode'];
                    if(isset($validate['sks']))  $item['sks'] = $validate['sks'];
                    file_put_contents($path, json_encode($matkul, JSON_PRETTY_PRINT));
                    return response()->json([
                        'message' => 'Data berhasil diupdate']);
                }
            }
            return response()->json(['error' => 'Matkul opo toh iku rek'], 404);
    }

    public function destroy($id){
        $path = resource_path('json/matkul.json');
            if (!file_exists($path)) {
                    return response()->json(['error' => 'File missing'], 404);
            }
        $data = file_get_contents($path);
        $matkul = json_decode($data, true);
        foreach ($matkul as $index => $item) {
            if ($item['id'] == $id) {
                array_splice($matkul, $index, 1);
                file_put_contents($path, json_encode($matkul, JSON_PRETTY_PRINT));
                return response()->json(['message' => 'Data berhasil dihapus']);
            }
        }
        return response()->json(['error' => 'Matkul opo toh iku rek'], 404);
    }
   
}


