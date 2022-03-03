<h1>編集</h1>

<form method="POST" action="{{ route('member.update',['id'=>$member->id]) }}">
    @csrf

    <div>
        名前
        <input type="text" name="name" value="{{$member->name}}">
        @error('')
            {{$message}}
        @enderror
    </div>

    <div>
        電話番号
        <input type="text" name="telephone" value="{{$member->telephone}}">
        @error('')
            {{$message}}
        @enderror
    </div>

    <div>
        メールアドレス
        <input type="text" name="email" value="{{$member->email}}">
        @error('')
            {{$message}}
        @enderror

    </div>

    <input type="submit" value="更新する">
    <a href="{{ route('member.show',['id'=>$member->id]) }}">{{ __('詳細に戻る') }}</a>
</form>