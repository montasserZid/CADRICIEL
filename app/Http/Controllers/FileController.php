<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class FileController extends Controller
{
    public function index()
    {
        $files = File::paginate(3);
        $etudiant = auth()->user()->etudiant;
        return view('files.index', compact('files'))->with('etudiant', $etudiant);
    }

    

    public function create()
    {
        $etudiant = auth()->user()->etudiant;
        return view('files.create')->with('etudiant', $etudiant);
    }

    public function store(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:pdf,zip,doc|max:2048',
        'filename_fr' => 'required',
        'filename_en' => 'required',
    ]);

    $file = $request->file('file');
    $filename = $file->getClientOriginalName();
    $path = $file->store('assets/files');

    File::create([
        'filename_fr' => $request->input('filename_fr') . '.' . $file->getClientOriginalExtension(),
        'filename_en' => $request->input('filename_en') . '.' . $file->getClientOriginalExtension(),
        'path' => $path,
        'user_id' => auth()->user()->id,
    ]);

    return redirect('/files')->with('success', 'Fichier téléchargé avec succès.');
}

    
    



    public function destroy($id)
    {
        $file = File::findOrFail($id);

        if ($file->user_id !== auth()->user()->id) {
            return redirect()->route('files.index')->with('error', "Vous n'êtes pas autorisé à supprimer ce fichier.");
        }

        Storage::delete($file->path);
        $file->delete();

        return redirect()->route('files.index')->with('success', 'Fichier supprimé avec succès.');
    }
}
