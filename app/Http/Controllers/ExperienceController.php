<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Profile::where('status', 1)->first();
        $experience = Experience::where('profile_id', $profile->id)->get();
        $hitung = Experience::onlyTrashed()->get()->count();
        return view('admin.experience.index', compact('experience', 'hitung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profiles = Profile::get();
        // @dd($profiles);
        return view('admin.experience.create', compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'profile_id' => 'required|exists:profiles,id',
        ]);

        // $profile = Profile::where('status', 1)->first();
        $profile_id = $request->input('profile_id');

        Experience::create([
            'title' => $request->title,
            'position' => $request->position,
            'description' => $request->description,
            'profile_id' => $profile_id, // Add this line
        ]);

        return redirect()->route('experience.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        return view('admin.experience.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);
        $experience->update($data);
        return redirect()->route('experience.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $experience)
    {
        $experience = Experience::withTrashed()->findOrFail($experience);
        $experience->forceDelete();
        return redirect()->route('experience.index')->with('success', 'Delete Profile Berhasil');
    }

    public function softdelete(string $experience)
    {
        $experience = Experience::withTrashed()->findOrFail($experience);
        $experience->delete();

        return redirect()->route('experience.index')->with('success', 'Data Berhasil Dihapus sementara');
    }

    public function recycle()
    {
        $experience = Experience::onlyTrashed()->paginate(15);
        return view('admin.experience.recycle', compact('experience'));
    }

    public function restore($experience)
    {
        $experience = Experience::withTrashed()->findOrFail($experience);
        $experience->restore();
        return redirect()->route('experience.index')->with('success', 'Data Berhasil Direstore');
    }
}
