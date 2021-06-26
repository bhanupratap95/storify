<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\mail\NotifyAdmin;
use App\mail\NewStoryNotification;

class DashboardController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // DB::enableQueryLog();
        $query = Story::where('status', 1);
        // fetch type for filter
        $type = request()->input('type');

        if(in_array($type, ['short', 'long'])){
            $query->where('type', $type);
        }
        $stories = $query->with(['user', 'tags']) //use for removing n+1 Problem query not repeating
            ->orderBy('id', 'DESC')
            ->paginate(9);

    	return view('dashboard.index', [
            'stories'=> $stories
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $activeStory)
    {
        //
        return view('dashboard.show', [
            'story'=> $activeStory
        ]);
    }

    public function email()
    {
        // Mail::raw('This is the test mail.', function( $message ){
        //     $message->to('admin@localhost.com')
        //         ->subject('A New Story Was Edit.');
        // });
        // Mail::send( new NotifyAdmin('Title of the Story'));
        Mail::send(new NewStoryNotification( 'Title of the Story' ));
        dd('here');
    }
}
