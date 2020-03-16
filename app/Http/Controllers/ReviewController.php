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
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $data = [
                'user_id'   => Auth::id(),
                'title'     => $inputs['title'],
                'body'      => $inputs['body'],
                'image'     => $request->file('image')->hashName()
            ];
        } else {
            $data = [
                'user_id'   => Auth::id(),
                'title'     => $inputs['title'],
                'body'      => $inputs['body'],
            ];
        }
        Review::create($data);
        return redirect()->route('index')->with('flash_message', '投稿が完了しました');
    }
}
