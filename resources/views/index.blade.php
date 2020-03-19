@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
  <div class="row justify-content-center">
    @foreach ($reviews as $review)
      <div class="col-md-4">
        <div class="card mb50">
          <div class="card-header">
            <span class="mr-2">投稿日時：{{ $review->created_at }}</span>
            <div class="row">
              <span class="badge badge-primary">
                コメント {{ $review->comments->count() }} 件
              </span>
              @if (Auth::user()->id ?? '' != $review->user_id) 
                @if (optional(Auth::user())->is_like($review->id))
                  <form action="{{ route('unlike', ['id' => $review->id]) }}" method="post">
                    @method('DELETE') @csrf
                    <button type="submit" class="heart-btn">
                      <i class="fas fa-heart"></i>
                    </button>
                  </form>
                @else
                  <form action="{{ route('like', ['id' => $review->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="heart-btn">
                      <i class="far fa-heart"></i>
                    </button>
                  </form>
                @endif
                {{ $review->like_users()->count() }}
              @endif
            </div>
          </div>
          <div class="card-body">
            @if (!empty($review->image))
              <div class="image-wrapper">
                <img src="{{ asset('storage/images/'.$review->image) }}" class="book-image">
              </div>
            @else
              <div class="image-wrapper">
                <img src="{{ asset('images/dummy.png') }}" class="book-image">
              </div>
            @endif
            <h3 class="h3 book-title">{{ $review->title }}</h3>
            <p class="description">{{ $review->body }}</p>
          </a>
        </div>
        <div class="card-footer text-center">
          <a href="{{ $review->url }}">amazonのリンク</a>
          <a href="{{ route('show', ['id' => $review->id ]) }}" class="btn btn-secondary detail-btn">詳細を読む</a>
        </div>
      </div>
    @endforeach
  </div>
  {{ $reviews->links() }}
@endsection