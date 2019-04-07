<?php

namespace App\Http\Controllers;

use App\Repositories\ClaimRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClaimController extends Controller
{

    private $claimRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        // parent::__construct();
        $this->claimRepository = app(ClaimRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //
        $paginator = $this->claimRepository->getAllWithPaginate(10);
//        if ($request->ajax()) {
//            return view('manager.includes.presult', compact('paginator'));
//        }
        return view('messenger.manager.claims.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        $item = $this->claimRepository->getShow($id);

        if ($request->ajax()) {
            return view('messenger.manager.claims.show', compact('item'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
