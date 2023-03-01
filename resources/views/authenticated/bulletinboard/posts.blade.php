@extends('layouts.sidebar')

@section('content')
<div>
    <p class="area_title">投稿一覧</p>
</div>
<div class="board_area w-100 m-auto d-flex">
  <div class="post_view w-75 mt-3">
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p>{{ $post->updated_at }}</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="d-flex subcategory_count_box">
        @foreach($post->subCategories as $subCategory)
        <span class="category_name">{{ $subCategory->sub_category}}</span>
        @endforeach
        <div class="post_bottom_area">
            <div class="d-flex post_status">
            <div class="mr-5">
                <i class="fa fa-comment"></i><span class="ml-2">{{ $post->postComments->count('id')}}</span><!-- コメント数を書く -->
            </div>
            <div>
                @if(Auth::user()->is_Like($post->id))
                <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }} ml-2">{{ $post->likesCounts($post->id) }}</span></p>
                @else
                <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }} ml-2">{{ $post->likesCounts($post->id) }}</span></p>
                @endif
            </div>
            </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area mr-2 w-25">
    <div class="m-4 search_box">
      <div class="post_create_btn">
        <a href="{{ route('post.input') }}">投稿</a>
      </div>
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest" class="p-1 mb-1">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <ul class="category_search">
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}"><span >{{ $category->main_category }}<span></li>
         @foreach($category->subCategories as $subCategory)
          <li><button type="submit" value="{{ $subCategory->id }}" class="category_btn category" name="category_word" form="postSearchRequest">{{ $subCategory->sub_category }}</button></li>
         @endforeach
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
