<?php

namespace App\Http\Controllers\Messenger\Client;

use App\Http\Controllers\Controller;
use App\Mail\ClaimNotification;
use App\Models\Claim;
use App\Models\Upload;
use App\Models\User;
use App\Repositories\ClaimRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClaimController extends Controller
{

    /**
     *  Private var for use ClaimRepository
     *
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $claimRepository;


    /**
     * Client\ClaimController constructor.
     */
    public function __construct()
    {

        //For using claims user should be authorized and has role Client
        $this->middleware('auth');
        $this->middleware('client');

        //Database link init
        $this->claimRepository = app(ClaimRepository::class);
    }


    /**
     * Display a listing of the user's claims.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $paginator = $this->claimRepository->getAllByUserWithPaginate(Auth::user()->id, 6);

        $item = New Claim();

        //Loading the first element to bypass ajax
        if ($paginator->count() > 0)
            $item = $paginator->first();

        return view('messenger.client.claims.index', compact('paginator', 'item'));
    }

    /**
     * Show the form for creating a new claim.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messenger.client.claims.create');
    }

    /**
     *
     * Show the form for saving claim in database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    //TODO: Custom Request
    public function store(Request $request)
    {
        //Get validated data from ClaimCreateRequest

        $data = $request->input();

        $user = Auth::user();
        $user_id = $user->id;
        $data['user_id'] = $user_id;

        $new_claim = new Claim($data);

        //TODO: Database error catch, Not best practice
        //insert claim -> update user -> insert update -> mail

        $user_update_result = false;
        $upload_insert_result = false;
        $claim_insert_result = $new_claim->save();

        //--------Success------------

        if ($claim_insert_result) {
            $data = ['last_claim_created_at' => $new_claim->created_at];
            $user_update_result = $user
                ->update($data);
        }


        if ($user_update_result) {
            if (isset($request->upload)) {
                //TODO: Make multiple file input
                $upload_name = $request->upload->getClientOriginalName();
                $new_path = $request->upload->storeAs('messenger/claims/' . $new_claim->id, $upload_name);

                $upload = new Upload();
                $upload->file = storage_path() . '/app/messenger/claims/' . $new_claim->id . '/' . $upload_name;
                $upload->claim_id = $new_claim->id;
                $upload_insert_result = $upload->save();
            }
            else{
                // If we havent attachment we dont need this flag
                $upload_insert_result = true;

            }
        }

        if ($upload_insert_result) {
            //TODO: find all moderators and notify them all
            $moderator = User::find(1);
            Mail::to($moderator)->send(new ClaimNotification($new_claim));
        }

        //--------Error------------

        if (!$claim_insert_result) {
            return back()
                ->withErrors(['msg' => "Claim creation error"])
                ->withInput();
        }

        if (!$user_update_result) {
            $claim_delete_result = $new_claim
                ->delete();

            if ($claim_delete_result) {
                return back()
                    ->withErrors(['msg' => "Claim creation error"])
                    ->withInput();
            } else {
                return back()
                    ->withErrors(['msg' => "New claim created, user not found"])
                    ->withInput();
            }
        }

        if (!$upload_insert_result) {
            return back()
                ->withErrors(['msg' => "New claim created, attach files error"])
                ->withInput();
        }
        return redirect()
            ->route('client.claims.index')
            ->with(['success' => 'New claim successfully created']);


    }


    /**
     * Display the specified claim.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show(Request $request, $id)
    {
        $item = $this->claimRepository->getShow($id);

        //should be in middleware
        //TODO: check how it can be realized

        if ($item->user_id == Auth::user()->id) {

            if ($request->ajax()) {
                return view('messenger.client.claims.includes.item_show_ajax', compact('item'));
                //   }
            }
        }
    }


    /**
     * Remove the specified claim from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //TODO:SoftDelete

        $item = Claim::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Claim id=[{$id}] not found"])
                ->withInput();
        }

        $claim_remove_result = $item
            ->delete();


        foreach ($item->uploads as $upload) {
            $upload
                ->delete();
        }

        if ($claim_remove_result) {
            return redirect()
                ->route('client.claims.index', $item->id)
                ->with(['success' => 'Successfully deleted']);
        } else {
            return back()
                ->withErrors(['msg' => "Deletion error"])
                ->withInput();
        }
    }
}
