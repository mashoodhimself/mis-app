<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = Feed::with('user')->select('id', 'user_id', 'title', 'description')->get();
        return view('feed', ['feeds' => $feeds]);
    }

    public function create()
    {
        return view('addFeed');
    }

    public function store(Request $request)
    {
        Feed::create([
            'user_id' => auth()->user()->id,
            'title' => $request->feed_title,
            'description' => $request->feed_desc,
            'audiance' => 2
        ]);

    }

    public function edit(Feed $feed)
    {
        $data['feed'] = $feed;
        return view('editFeed', $data);
    }

    public function update(Request $request)
    {
        Feed::where('id', $request->feed_id)->update([
            'title' => $request->feed_title,
            'description' => $request->feed_desc,
        ]);

        return redirect('/feed');
    }

    public function destroy(Feed $feed)
    {
        $feed->delete();
        return redirect('/feed');
    }
}
