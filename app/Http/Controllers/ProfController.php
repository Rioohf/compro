<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Select * from profiles;
        $profiles = Profile::all();
        $hitung = Profile::onlyTrashed()->get()->count();
        return view('admin.profile.index', compact('profiles', 'hitung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_lengkap' => 'required|string|max:55',
            'no_telpon' => 'required|string|max:15',
            'email' => 'required|string|email|max:55',
            'descriptions' => 'nullable|string',
            'facebook' => 'nullable|url',
            'x' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'alamat' => 'required|string|max:250'

        ]);

        //Menghanddle file upload-an:
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $path = $image->store('public/image');
            $name = basename($path); //menyimpan nama filenya saja

        }
        // Insert into profiles () values():
        Profile::create([
            'picture' => $name,
            'nama_lengkap' => $request->nama_lengkap,
            'no_telpon' => $request->no_telpon,
            'email' => $request->email,
            'descriptions' => $request->descriptions,
            'facebook' => $request->facebook,
            'x' => $request->x,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'alamat' => $request->alamat

        ]);
        return redirect()->route('profile.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Profile::findOrFail($id);
        $idprofile = $data->id;
        $experience = Experience::where('profile_id', $idprofile)->get();

        $pdf = Pdf::loadView('admin.generate-pdf.index', compact(['data', 'experience']));
        return $pdf->download('Portfolio.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Profile::findOrFail($id);
        return view('admin.profile.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::findOrFail($id);
        $request->validate([
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_lengkap' => 'required|string|max:55',
            'no_telpon' => 'required|string|max:15',
            'email' => 'required|string|email|max:55',
            'descriptions' => 'nullable|string',
            'facebook' => 'nullable|url',
            'x' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'alamat' => 'nullable|string|max:250'

        ]);
        // Simpan gambar jika ada di upload
        if ($request->hasFile('picture')) {
            // Hapus gambar lama jika ada:
            if ($profile->picture) {
                Storage::delete('public/image/' . $profile->picture);
            }
            $image = $request->file('picture');
            $path = $image->store('public/image');
            $name = basename($path);
            $profile->picture = $name;
        }
        $profile->nama_lengkap = $request->nama_lengkap;
        $profile->alamat = $request->alamat;
        $profile->no_telpon = $request->no_telpon;
        $profile->email = $request->email;
        $profile->facebook = $request->facebook;
        $profile->x = $request->x;
        $profile->linkedin = $request->linkedin;
        $profile->instagram = $request->instagram;
        $profile->descriptions = $request->descriptions;
        $profile->save();

        return redirect()->route('profile.index')->with('success', 'Update Profile Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = Profile::withTrashed()->findOrFail($id);
        if ($profile->picture) {
            Storage::delete('public/image/' . $profile->picture);
        }
        $profile->forceDelete();
        return redirect()->route('profile.index')->with('success', 'Delete Profile Berhasil');
    }
    public function softdelete(string $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profile.index')->with('success', 'Data Berhasil Dihapus sementara');
    }

    public function updateStatus($id): JsonResponse
    {
        //Select Profile, baru di update menjadi 0:
        Profile::where('id', '!=', $id)->update(['status' => 0]);
        //Select Profile berdasarkan id lalu di update menjadi 1
        $profile = Profile::findOrFail($id);
        $profile->status = 1;
        $profile->save();
        return response()->json(['success' => 'Status Berhasil Diubah']);
    }

    public function recycle()
    {
        $profiles = Profile::onlyTrashed()->paginate(15);
        return view('admin.profile.recycle', compact('profiles'));
    }
    public function restore($id)
    {
        $profile = Profile::withTrashed()->findOrFail($id);
        $profile->restore();
        return redirect()->route('profile.index')->with('success', 'Data Berhasil Direstore');
    }
}
