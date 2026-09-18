<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\ResidentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $r, Resident $resident)
    {
        $data = $r->validate(['name' => 'required|string|max:150', 'type' => 'required|in:id_proof,passport,college_id,company_id,address_proof,agreement,other', 'expires_at' => 'nullable|date', 'document' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:10240']);
        $file = $r->file('document');
        $resident->documents()->create(['name' => $data['name'], 'type' => $data['type'], 'expires_at' => $data['expires_at'] ?? null, 'path' => $file->store('resident-documents', 'local'), 'mime' => $file->getMimeType()]);

        return back()->with('success', 'Document securely uploaded.');
    }

    public function show(Request $r, ResidentDocument $document)
    {
        abort_unless(Storage::disk('local')->exists($document->path), 404);
        $name = 'document-'.$document->id.'.'.pathinfo($document->path, PATHINFO_EXTENSION);
        $headers = ['Content-Type' => $document->mime, 'X-Content-Type-Options' => 'nosniff', 'Cache-Control' => 'private, no-store', 'Content-Security-Policy' => "default-src 'none'; sandbox"];

        return $r->boolean('download') ? Storage::disk('local')->download($document->path, $name, $headers) : Storage::disk('local')->response($document->path, $name, $headers);
    }

    public function destroy(ResidentDocument $document)
    {
        Storage::disk('local')->delete($document->path);
        $document->delete();

        return back()->with('success', 'Document deleted.');
    }
}
