<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'attachment' => 'required'
        ]);

        return response()->json([
            'name'      => $request->attachment->getClientOriginalName(),
            'mime_type' => $request->attachment->getClientMimeType(),
            'path'      => $request->attachment->store('attachments', 'public')
        ]);
    }

    public function destroy($path)
    {
        $deleted = Storage::delete('public/attachments/' . $path);

        return response()->json(['deleted' => $deleted]);
    }
}
