<?php

namespace App\Http\Controllers\Messenger\Client;

use App\Models\Upload;
use App\Repositories\ClaimRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * UploadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('client');
    }

    /**
     * Return the specified link to attachment file.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($id)
    {
        //TODO: Too many database requests
        $item = Upload::find($id);
        $pathToFile = $item->file;
        return response()->download($pathToFile);
    }


}
