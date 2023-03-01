@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
    <div class="user_name mb-1">
        <p class="area_title"><span>{{ $user->over_name }}</span><span class="mr-2">{{ $user->under_name }}</span><span>さんのプロフィール</span></p>
    </div>
  <div class="top_area w-75 m-auto pt-3">
    <div class="user_status p-3">
      <p><span class="profile_header badge bg-primary">名前</span><br> <span class="ml-4">{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p><span class="profile_header badge bg-primary">カナ</span><br> <span class="ml-4">{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p><span class="profile_header badge bg-primary">性別</span><br> @if($user->sex == 1)<span class="ml-4">男</span>@else<span class="ml-4">女</span>@endif</p>
      <p><span class="profile_header badge bg-primary">生年月日</span><br> <span class="ml-4">{{ $user->birth_day }}</span></p>
      @if($user->role === 4)
      <div class="user_subject"><span class="profile_header badge bg-primary">選択科目</span><br>
        <table Class="user_subject_table ml-4" border="1">
            <tr>
                <th>国語</th>
                <th>数学</th>
                <th>英語</th>
            </tr>
            <tr>
                @if ( $user->subjects->pluck('subject')->contains('国語'))
                    <td>〇</td>
                @else
                    <td>✕</td>
                @endif
                @if ( $user->subjects->pluck('subject')->contains('数学'))
                    <td>〇</td>
                @else
                    <td>✕</td>
                @endif
                @if ( $user->subjects->pluck('subject')->contains('英語'))
                    <td>〇</td>
                @else
                    <td>✕</td>
                @endif
            </tr>
        </table>
        @elseif($user->role == 1)
            <span>教師(国語)</span>
        @elseif($user->role == 2)
            <span>教師(数学)</span>
        @else
            <span>講師(英語)</span>
        @endif
        {{-- @foreach($user->subjects as $subject)
        <span class="user_subject_select">{{ $subject->subject }}</span>
        @endforeach --}}
      </div>
      <div class="">
        @can('admin')
        @if($user->role === 4)
        <div class="subject_edit_btn_div mt-1">
            <p><span class="subject_edit_btn">選択科目の編集をする<span class="subject_edit_accordion is_current"></span></span></p>
        </div>
        <div class="subject_inner">
          <form action="{{ route('user.edit') }}" method="post">
            @foreach($subject_lists as $subject_list)
            <div>
              <label for="{{ $subject_list->id }}">{{ $subject_list->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}" id="{{ $subject_list->id }}">
            </div>
            @endforeach
            <input type="submit" value="編集" class="btn btn-primary">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            {{ csrf_field() }}
          </form>
        </div>
        @endif
        @endcan
      </div>
    </div>
  </div>
</div>
@endsection
