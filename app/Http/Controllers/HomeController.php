<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $disk = Storage::disk('gcs');
        $files = $disk->allFiles();
        return view('home',compact('files'));
    }

    public function saveFile(Request $request){
        $request->file('arquivo')->store('imagens','gcs');
        return redirect()->route('home');
    }

    public function deleteFile(Request $request)
    {
        $file = $request->input('file');
        Storage::disk('gcs')->delete($file);
        return redirect()->route('home');
    }
}
