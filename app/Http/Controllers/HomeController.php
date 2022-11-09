<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    public function create() { 
        return view('mobil.add'); 
        } 
        public function store(Request $request) { 
        $request->validate(['id_mobil' => 'required', 
        'tipe' => 'required', 
        'harga' => 'required', 
        'warna' => 'required', 
        'tahun_keluaran' => 'required', 
        'status' => 'required', 
        'id_pembeli' => 'required' 
        ]); 
        // Menggunakan Query Builder Laravel dan Named  Bindings untuk valuesnya 
        DB::insert('INSERT INTO mobil(id_mobil,  tipe, harga, warna, tahun_keluaran, status, id_pembeli) VALUES  
       (:id_mobil, :tipe, :harga, :warna, :tahun_keluaran, :status, :id_pembeli )', 
        [ 
        'id_mobil' => $request->id_mobil, 
        'tipe' => $request->tipe,  
        'harga' => $request->harga, 
        'warna' => $request->warna, 
        'tahun_keluaran' => $request->tahun_keluaran, 
        'status' => $request->status, 
        'id_pembeli' => $request->id_pembeli, 
        
        ] 
        ); 
        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil disimpan');  }
       
    public function view() { 
        $datas = DB::select('select * from mobil'); 
        return view('mobil.index')->with('datas', $datas); 
        }
    
    public function edit($id) { 
        $data = DB::table('mobil')->where('id_mobil',  $id)->first(); 
        return view('mobil.edit')->with('data', $data);  } 
    public function update($id, Request $request) {  $request->validate([ 
        'id_mobil' => 'required', 
        'tipe' => 'required', 
        'harga' => 'required', 
        'warna' => 'required', 
        'tahun_keluaran' => 'required', 
        'status' => 'required', 
        'id_pembeli' => 'required' 
    ]); 
    // Menggunakan Query Builder Laravel dan Named  Bindings untuk valuesnya 
    DB::update('UPDATE mobil SET id_mobil =  :id_mobil, tipe = :tipe, harga = :harga,  warna = :warna, tahun_keluaran = :tahun_keluaran,  status = :status, id_pembeli = :id_pembeli WHERE  id_mobil = :id', 
    [ 
        'id' => $id, 
        'id_mobil' => $request->id_mobil, 
        'tipe' => $request->tipe,  
        'harga' => $request->harga, 
        'warna' => $request->warna, 
        'tahun_keluaran' => $request->tahun_keluaran, 
        'status' => $request->status, 
        'id_pembeli' => $request->id_pembeli,
    ] 
    ); 
    return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diubah'); 
    }

    public function delete($id) { 
        // Menggunakan Query Builder Laravel dan Named  Bindings untuk valuesnya 
        DB::delete('DELETE FROM mobil WHERE id_mobil =  :id_mobil', ['id_mobil' => $id]); 
        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil dihapus');  }
       
        
}
