@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div class="container">
      <h1 class="pagetitle">レビュー詳細ページ</h1>
      <div class="card">
        <div class="card-body d-frex">
          <section class="review-main">
            <h2 class="h2">本のタイトル</h2>
            <p class="h2 mb20">{{ $review->title }}</p>
            <h2 class="h2">レビュー本文</h2>
            <p>{{ $review->body }}</p>
          </section>
          <aside class="review-image">
            @if (!empty($review->image))
                <img src="{{ asset('storage/images/'.$review->image) }}" class="book-image">
            @else
                <img src="{{ asset('images/dummy.png') }}" class="book-image">
            @endif
          </aside>
        </div>
          <div class="d-flex justify-content-around">
            <a href="{{ route('index') }}" class="btn btn-info btn-style mb20">一覧へ戻る</a>
            <a href="{{ route('edit', $review->id) }}" class="btn btn-success btn-style mb20">編集する</a>
            <form action="{{ route('destroy', ['id' => $review->id]) }}" method="POST">
              @method('DELETE') @csrf
              <input type="submit" class="btn btn-danger btn-style mb20" value="削除する">
            </form>
          </div>
      </div>
    </div>
@endsection
