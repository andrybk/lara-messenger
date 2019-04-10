<?php

namespace App\Http\Controllers\Messenger\Manager;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Repositories\ClaimRepository;
use Illuminate\Http\Request;

class ClaimController extends Controller
{

    private $claimRepository;

    /**
     * ClaimController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('manager');

        $this->claimRepository = app(ClaimRepository::class);
    }

    /**
     * Display a listing of the claims.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginator = $this->claimRepository->getAllWithPaginate(10);

        if ($paginator->count() > 0)
            $item = $paginator->first();

        //TODO:"item" used only in ajax window showing,
        // here it need only for fist page load
        return view('messenger.manager.claims.index', compact('paginator', 'item'));
    }

    /**
     * Display the specified claim.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $item = $this->claimRepository->getShow($id);

        //I use this method only with ajax
        //if ($request->ajax()) {
        return view('messenger.manager.claims.includes.item_show_ajax', compact('item'));
        //}
    }

    /**
     * Update answered filed in the specified claim in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Claim::find($id);
        //TODO: Database error catch, Not best practice
        $item_find_result = isset($item);
        $item_update_result = false;

        //--------Success------------

        if ($item_find_result) {
            $data = ['answered' => !$item->answered];
            $item_update_result = $item
                ->update($data);
        }
        if ($item_update_result) {
            return redirect()
                ->route('manager.claims.index')
                ->with(['success' => 'Successfully updated']);
        }

        //--------Error------------

        if (!$item_find_result) {
            return back()
                ->withErrors(['msg' => "Note id=[{$id}] not found"])
                ->withInput();
        }
        if (!$item_update_result) {
            return back()
                ->withErrors(['msg' => "Creation error"])
                ->withInput();
        }
    }

}
