<?php

namespace App\Http\Controllers\Client;

use App\Models\Claim;
use App\Repositories\ClaimRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClaimController extends Controller
{

    private $claimRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('client');
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
        $paginator = $this->claimRepository->getAllByUserWithPaginate(Auth::user()->id, 6);
        $item = $paginator->first();

//        if ($request->ajax()) {
//            return view('manager.includes.presult', compact('paginator'));
//        }
        return view('messenger.client.claims.index', compact('paginator', 'item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('messenger.client.claims.create');

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
        $data = $request->input();
        // TODO: add slug validation for generated
        if (empty($data['theme'])) {
            $data['theme'] = Str::limit($data['message'], 97) . '...';
        }
        $data['user_id'] = Auth::user()->id;

        $item = new Claim($data);
        $item->save();
        if ($item) {
            return redirect()
                ->route('client.claims.index')
                ->with(['success' => 'Successfully created']);
        } else {
            return back()
                ->withErrors(['msg' => "Creation error"])
                ->withInput();
        }
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


        //should be in middleware

        if ($item->user_id == Auth::user()->id) {

            if ($request->ajax()) {
                return view('messenger.client.claims.includes.item_show_ajax', compact('item'));
            }
           // return view('messenger.client.claims.index', compact('item'));
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

        $item = Claim::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Note id=[{$id}] not found"])
                ->withInput();
        }
        $data = ['answered' => !$item->answered];
        $result = $item
            ->update($data);
        if ($result) {
            return redirect()
                ->route('manager.claims.index', $item->id)
                ->with(['success' => 'Successfully updated']);
        } else {
            return back()
                ->withErrors(['msg' => "Creation error"])
                ->withInput();
        }
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
        $item = Claim::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Note id=[{$id}] not found"])
                ->withInput();
        }

        $result = $item
            ->delete();
        if ($result) {
            return redirect()
                ->route('manager.claims.index', $item->id)
                ->with(['success' => 'Successfully deleted']);
        } else {
            return back()
                ->withErrors(['msg' => "Deletion error"])
                ->withInput();
        }
    }
}
