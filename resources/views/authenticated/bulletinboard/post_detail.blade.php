@extends('layouts.sidebar')
@section('content')
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
      <div class="p-3">
        <div class="detail_inner_head">
          <div>
          </div>
        </div>

        <div class="d-flex ">
            <div>
                @foreach($post->subCategories as $sub_category)
                    <span class="category_name">{{ $sub_category->sub_category}}</span>
                @endforeach
            </div>
            <div class="ml-2 error-box">
            @foreach ( $errors->all() as $error )
                <span class="error_message">※{{ $error }}</span><br>
            @endforeach
            </div>
            @if(Auth::id() === $post->user_id)
            <div class="detail_edit_btn">
              <span class="edit-modal-open" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
              <a href="{{ route('post.delete', ['id' => $post->id]) }}" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">削除</a>
            </div>
            @endif
        </div>
        <div class="contributor d-flex mt-2">
            <p><span>{{ $post->user->over_name }}</span><span>{{ $post->user->under_name }}</span>さん</p>
            <span class="ml-5">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
      </div>
      <div class="p-3">
        <div class="comment_container">
          <span class="">コメント</span>
          @foreach($post->postComments as $comment)
          <div class="comment_area border-top">
            <p class="mb-1 comment_user_name">
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
            </p>
            <div class="d-flex">
                <i class="fa-solid fa-reply mr-2 reply_icon"></i>
                <p class="mb-1 ml-2 comment-content">{{ $comment->comment }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- コメント投稿 -->
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
        <p class="m-0">コメントする</p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}"><!-- post_idをhiddenで送る -->
        <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
        @foreach ( $errors->get('comment') as $error )
            <p class="error_message">※{{ $error }}</p>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <p class="mb-0">タイトル</p>
          <input type="text" name="post_title" placeholder="タイトル" class="w-100 modal_title">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
            <p class="mb-0">投稿内容</p>
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
