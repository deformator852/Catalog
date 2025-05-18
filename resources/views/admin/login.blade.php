@extends('layouts.app')

@section('title',$title)
@section('content')
    <div class="login">
        <form class="login__form" action="" method="POST">
            <div class="errors">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif

            </div>
            @csrf
            <div>
                <input class="input"
                       type="text" name="name" id="name" placeholder="username" required>
            </div>
            <div>
                <input class="input"
                       type="password" name="password" id="password" placeholder="**************" required>
            </div>
            <div>
                <button class="login__submit submit" type="submit">login</button>
            </div>
        </form>
    </div>
@endsection
