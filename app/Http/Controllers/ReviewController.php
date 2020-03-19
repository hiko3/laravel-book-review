<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('status', 1)->orderBy('created_at', 'desc')->paginate(9);
        return view('index', compact('reviews'));
    }

    public function show($id)
    {
        $review = Review::where('status', 1)->find($id);
        return view('show', compact('review'));
    }

    public function create()
    {
        return view('review');
    }

    public function store(ReviewRequest $request)
    {
        $data = $request->reviewSaveData();
        Review::create($data);
        return redirect()->route('index')->with('flash_message', '投稿が完了しました');
    }

    public function myPage($id)
    {
        $reviews = Review::where('status', 1)->where('user_id', $id)->orderBy('created_at', 'desc')->paginate(9);
        return view('mypage',compact('reviews'));
    }

    public function edit($id)
    {
        $review = Review::where('status', 1)->find($id);
        return view('edit', compact('review'));
    }

    public function update(ReviewRequest $request, $id)
    {
        $data = $request->reviewSaveData();
        Review::find($id)->update($data);
        return redirect()->route('show', ['id' => $id])->with('flash_message', '投稿を更新しました');
    }

    public function destroy($id)
    {
        Review::find($id)->delete();
        return redirect()->route('mypage', ['id' => Auth::id()])->with('flash_message', '投稿を削除しました');
    }

    public function comment(Request $request)
    {
        $inputs = $request->all();
        $review = Review::find($inputs['review_id']);
        $review->comments()->create($inputs);
        return redirect()->route('show', ['id' => $inputs['review_id']]);
    }

    
}
