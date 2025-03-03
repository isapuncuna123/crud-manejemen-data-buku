<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class bukuController extends Controller
{
    public function index()
    {
        $allBuku = Buku::all();

        return view ('buku.index',compact('allBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        return view('buku.create', compact('penerbit','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //buat validasi
       $validateData = $request->validate([
        'judul'=>'required|max:255',
        'pengarang'=>'required|max:100',
        'tahun_terbit'=>'required|integer:4',
        'kategori_id'=>'required',
        'penerbit_id'=>'required',
        
       ]); 
       //simpan data
       buku::create($validateData);
       //redirect index buku
       return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(buku $buku)
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku', 'penerbit','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, buku $buku)
    {
        //buat validasi
       $validateData=$request->validate([
        'judul'=>'required|max:255',
        'pengarang'=>'required|max:100',
        'tahun_terbit'=>'required|integer:4',
        'kategori_id'=>'required',
        'penerbit_id'=>'required',
        
       ]); 
       //update data
       $buku-> update($validateData);
       //redirect index buku
       return redirect()-> route('Buku.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(buku $buku)
    {
        //delete
        $buku->delete();
        return redirect()->route('Buku.index');
    }
}
