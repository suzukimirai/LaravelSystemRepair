<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

@if(count($errors) > 0)
  @foreach( $errors->all() as $error)
  <p>{{$error}}</p>
  @endforeach
@endif  

<form action="{{ route('registerPost') }}" method="POST">
    <div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
      <div class="w-25 vh-75 border p-3">
        <div class="register_form">
          <div class="d-flex mt-3" style="justify-content:space-between">
            <div class="" style="width:140px">
              <label class="d-block m-0" style="font-size:13px">姓</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 over_name" name="over_name" value="{{ old('over_name') }}">
              </div>
            </div>
            <div class="" style="width:140px">
              <label class=" d-block m-0" style="font-size:13px">名</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 under_name" name="under_name" value="{{ old('under_name') }}">
              </div>
            </div>
          </div>
          <div class="d-flex mt-3" style="justify-content:space-between">
            <div class="" style="width:140px">
              <label class="d-block m-0" style="font-size:13px">セイ</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 over_name_kana" name="over_name_kana" value="{{ old('over_name_kana') }}">
              </div>
            </div>
            <div class="" style="width:140px">
              <label class="d-block m-0" style="font-size:13px">メイ</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 under_name_kana" name="under_name_kana" value="{{ old('under_name_kana') }}">
              </div>
            </div>
          </div>
          <div class="mt-3">
            <label class="m-0 d-block" style="font-size:13px">メールアドレス</label>
            <div class="border-bottom border-primary">
              <input type="mail" class="w-100 border-0 mail_address" name="mail_address" value="{{ old('mail_address') }}">
            </div>
          </div>
        </div>
        <div class="mt-3">
          <input type="radio" name="sex" id="sex-1" class="sex" value="1" {{ old('sex') === '1' ? 'checked' : '' }}>
          <label style="font-size:13px" for="sex-1">男性</label>
          <input type="radio" name="sex" id="sex-2" class="sex" value="2" {{ old('sex') === '2' ? 'checked' : '' }}>
          <label style="font-size:13px" for="sex-2">女性</label>
          <input type="radio" name="sex" id="sex-3" class="sex" value="3" {{ old('sex') === '3' ? 'checked' : '' }}>
          <label style="font-size:13px" for="sex-3">その他</label>
        </div>
        <div class="mt-3">
          <label class="d-block m-0 aa" style="font-size:13px">生年月日</label>
          <select class="old_year" name="old_year">
            <option value="none">-----</option>
            <option value="1985" @if( old('old_year') === '1985' ) selected @endif>1985</option>
            <option value="1986" @if( old('old_year') === '1986' ) selected @endif>1986</option>
            <option value="1987" @if( old('old_year') === '1987' ) selected @endif>1987</option>
            <option value="1988" @if( old('old_year') === '1988' ) selected @endif>1988</option>
            <option value="1989" @if( old('old_year') === '1989' ) selected @endif>1989</option>
            <option value="1990" @if( old('old_year') === '1990' ) selected @endif>1990</option>
            <option value="1991" @if( old('old_year') === '1991' ) selected @endif>1991</option>
            <option value="1992" @if( old('old_year') === '1992' ) selected @endif>1992</option>
            <option value="1993" @if( old('old_year') === '1993' ) selected @endif>1993</option>
            <option value="1994" @if( old('old_year') === '1994' ) selected @endif>1994</option>
            <option value="1995" @if( old('old_year') === '1995' ) selected @endif>1995</option>
            <option value="1996" @if( old('old_year') === '1996' ) selected @endif>1996</option>
            <option value="1997" @if( old('old_year') === '1997' ) selected @endif>1997</option>
            <option value="1998" @if( old('old_year') === '1998' ) selected @endif>1998</option>
            <option value="1999" @if( old('old_year') === '1999' ) selected @endif>1999</option>
            <option value="2000" @if( old('old_year') === '2000' ) selected @endif>2000</option>
            <option value="2001" @if( old('old_year') === '2001' ) selected @endif>2001</option>
            <option value="2002" @if( old('old_year') === '2002' ) selected @endif>2002</option>
            <option value="2003" @if( old('old_year') === '2003' ) selected @endif>2003</option>
            <option value="2004" @if( old('old_year') === '2004' ) selected @endif>2004</option>
            <option value="2005" @if( old('old_year') === '2005' ) selected @endif>2005</option>
            <option value="2006" @if( old('old_year') === '2006' ) selected @endif>2006</option>
            <option value="2007" @if( old('old_year') === '2007' ) selected @endif>2007</option>
            <option value="2008" @if( old('old_year') === '2008' ) selected @endif>2008</option>
            <option value="2009" @if( old('old_year') === '2009' ) selected @endif>2009</option>
            <option value="2010" @if( old('old_year') === '2010' ) selected @endif>2010</option>
          </select>
          <label style="font-size:13px">年</label>
          <select class="old_month" name="old_month">
            <option value="none">-----</option>
            <option value="01" @if( old('old_month') === '01' ) selected @endif>1</option>
            <option value="02" @if( old('old_month') === '02' ) selected @endif>2</option>
            <option value="03" @if( old('old_month') === '03' ) selected @endif>3</option>
            <option value="04" @if( old('old_month') === '04' ) selected @endif>4</option>
            <option value="05" @if( old('old_month') === '05' ) selected @endif>5</option>
            <option value="06" @if( old('old_month') === '06' ) selected @endif>6</option>
            <option value="07" @if( old('old_month') === '07' ) selected @endif>7</option>
            <option value="08" @if( old('old_month') === '08' ) selected @endif>8</option>
            <option value="09" @if( old('old_month') === '09' ) selected @endif>9</option>
            <option value="10" @if( old('old_month') === '10' ) selected @endif>10</option>
            <option value="11" @if( old('old_month') === '11' ) selected @endif>11</option>
            <option value="12" @if( old('old_month') === '12' ) selected @endif>12</option>
          </select>
          <label style="font-size:13px">月</label>
          <select class="old_day" name="old_day">
            <option value="none">-----</option>
            <option value="01" @if( old('old_day') === '01' ) selected @endif>1</option>
            <option value="02" @if( old('old_day') === '02' ) selected @endif>2</option>
            <option value="03" @if( old('old_day') === '03' ) selected @endif>3</option>
            <option value="04" @if( old('old_day') === '04' ) selected @endif>4</option>
            <option value="05" @if( old('old_day') === '05' ) selected @endif>5</option>
            <option value="06" @if( old('old_day') === '06' ) selected @endif>6</option>
            <option value="07" @if( old('old_day') === '07' ) selected @endif>7</option>
            <option value="08" @if( old('old_day') === '08' ) selected @endif>8</option>
            <option value="09" @if( old('old_day') === '09' ) selected @endif>9</option>
            <option value="10" @if( old('old_day') === '10' ) selected @endif>10</option>
            <option value="11" @if( old('old_day') === '11' ) selected @endif>11</option>
            <option value="12" @if( old('old_day') === '12' ) selected @endif>12</option>
            <option value="13" @if( old('old_day') === '13' ) selected @endif>13</option>
            <option value="14" @if( old('old_day') === '14' ) selected @endif>14</option>
            <option value="15" @if( old('old_day') === '15' ) selected @endif>15</option>
            <option value="16" @if( old('old_day') === '16' ) selected @endif>16</option>
            <option value="17" @if( old('old_day') === '17' ) selected @endif>17</option>
            <option value="18" @if( old('old_day') === '18' ) selected @endif>18</option>
            <option value="19" @if( old('old_day') === '19' ) selected @endif>19</option>
            <option value="20" @if( old('old_day') === '20' ) selected @endif>20</option>
            <option value="21" @if( old('old_day') === '21' ) selected @endif>21</option>
            <option value="22" @if( old('old_day') === '22' ) selected @endif>22</option>
            <option value="23" @if( old('old_day') === '23' ) selected @endif>23</option>
            <option value="24" @if( old('old_day') === '24' ) selected @endif>24</option>
            <option value="25" @if( old('old_day') === '25' ) selected @endif>25</option>
            <option value="26" @if( old('old_day') === '26' ) selected @endif>26</option>
            <option value="27" @if( old('old_day') === '27' ) selected @endif>27</option>
            <option value="28" @if( old('old_day') === '28' ) selected @endif>28</option>
            <option value="29" @if( old('old_day') === '29' ) selected @endif>29</option>
            <option value="30" @if( old('old_day') === '30' ) selected @endif>30</option>
            <option value="31" @if( old('old_day') === '31' ) selected @endif>31</option>
          </select>
          <label style="font-size:13px">月</label>
        </div>
        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px">役職</label>
          <input type="radio" name="role" id="role-1" class="admin_role role" value="1" {{ old('role') === '1' ? 'checked' : '' }}>
          <label style="font-size:13px" for="role-1">教師(国語)</label>
          <input type="radio" name="role" id="role-2" class="admin_role role" value="2" {{ old('role') === '2' ? 'checked' : '' }}>
          <label style="font-size:13px" for="role-2">教師(数学)</label>
          <input type="radio" name="role" id="role-3" class="admin_role role" value="3" {{ old('role') === '3' ? 'checked' : '' }}>
          <label style="font-size:13px" for="role-3">教師(英語)</label>
          <input type="radio" name="role" id="role-4" class="other_role role" value="4" {{ old('role') === '4' ? 'checked' : '' }}>
          <label style="font-size:13px" class="other_role" for="role-4">生徒</label>
        </div>
        <div class="select_teacher d-none">
          <label class="d-block m-0" style="font-size:13px">選択科目</label>
          @foreach($subjects as $subject)
          <div class="">
            <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
            <label for="">{{ $subject->subject }}</label>
          </div>
          @endforeach
        </div>
        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px" >パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password" name="password">
          </div>
        </div>
        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px">確認用パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password_confirmation" name="password_confirmation">
          </div>
        </div>
        <div class="mt-5 text-right">
          <input type="submit" class="btn btn-primary register_btn" disabled value="新規登録" onclick="return confirm('登録してよろしいですか？')">
        </div>
        <div class="text-center">
          <a href="{{ route('loginView') }}">ログイン</a>
        </div>
      </div>
      {{ csrf_field() }}
    </div>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</body>
</html>