@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>レビュー編集ページ</h1>
@if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif
<div class="row justify-content-center container">
    <div class="col-md-10">
      <form method="POST" action="{{ route('update', ['id' => $review->id] ) }}" enctype="multipart/form-data">
        @method('PUT') @csrf
        <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>本のタイトル</label>
                <input type='text' class='form-control' name='title' value="{{ $review->title }}">
              </div>
              <div class="form-group">
              <label>レビュー本文</label>
                <textarea class='description form-control' name='body'>{{ $review->body }}</textarea>
              </div>
              <div class="form-group">
                <label for="file1">本のサムネイル</label>
                <input type="file" id="file1" name='image' class="form-control-file">
              </div>
              <input type='submit' class='btn btn-primary' value='レビューを更新'>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection