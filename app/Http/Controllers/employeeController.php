<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employee as ModelsEmployee;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // menampilkan semua data
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)){
            $data = Employee::where('nama', 'like', "%$katakunci%")
                    ->orwhere('umur', 'like', "%$katakunci%")
                    ->orwhere('alamat', 'like', "%$katakunci%")
                    ->orwhere('mobile', 'like', "%$katakunci%")
                    ->paginate($jumlahbaris);
        }else{
            $data = Employee::orderBy('nama', 'asc')->paginate($jumlahbaris);
        }
        $data = Employee::orderBy('nama', 'asc')->paginate(5);
        return view('employee.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // memasukkan data baru
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // memasukkan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:5|max:20',
            'umur' => 'required|integer|min:21',
            'alamat' => 'required|min:10|max:40',
            'mobile' => 'required|regex:/^08[0-9]{9,12}$/',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'nama.min' => 'Nama minimal 5 karakter',
            'nama.max' => 'Nama maksimal 20 karakter',
            'umur.required' => 'Umur wajib diisi',
            'umur.integer' => 'Umur harus berupa angka',
            'umur.min' => 'Umur minimal 21 tahun',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'alamat.max' => 'Alamat maksimal 40 karakter',
            'mobile.required' => 'Nomor Telepon wajib diisi',
            'mobile.regex' => 'Nomor Telepon harus dimulai dari angka 08 & memiliki 9-12 angka',
        ]);

        Employee::create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'mobile' => $request->mobile,
        ]);

        return redirect()->route('employee.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // menampilkan detail data
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // menampilkan form utk proses edit
    public function edit($nama)
    {
        $data = employee::where('nama', $nama)->first();
        return view('employee.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // menyimpan data update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:5|max:20',
            'umur' => 'required|integer|min:21',
            'alamat' => 'required|min:10|max:40',
            'mobile' => 'required|regex:/^08[0-9]{9,12}$/',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'nama.min' => 'Nama minimal 5 karakter',
            'nama.max' => 'Nama maksimal 20 karakter',
            'umur.required' => 'Umur wajib diisi',
            'umur.integer' => 'Umur harus berupa angka',
            'umur.min' => 'Umur minimal 21 tahun',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'alamat.max' => 'Alamat maksimal 40 karakter',
            'mobile.required' => 'Nomor Telepon wajib diisi',
            'mobile.regex' => 'Nomor Telepon harus dimulai dari angka 08 & memiliki 9-12 angka',
        ]);

        Employee::where('nama', $id)->update([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'mobile' => $request->mobile,
        ]);

        return redirect()->route('employee.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // penghapusan data
    public function destroy($id)
    {
        Employee::where('nama', $id)->delete();
        return redirect()->to('employee')->with('success', 'Berhasil melakukan delete data');
    }
}
