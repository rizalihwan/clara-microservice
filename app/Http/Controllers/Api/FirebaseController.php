<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FirebaseController extends Controller
{
    public function firebaseStorageUpload(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'image' => 'file|required'
        ], [
            'required' => 'Gambar kosong!'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 400);
        } else {
            $image = $request->file('image'); //image file from frontend
            $student   = app('firebase.firestore')->database()->collection('testdb')->document('YZ80C6DjxepQrJGUHAy6');
            $firebase_storage_path = 'imguploadmkp/';
            $name     = $student->id();
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file      = $name . '.' . $extension;
            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $name]);
                //will remove from local laravel folder
                unlink($localfolder . $file);
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }
}
