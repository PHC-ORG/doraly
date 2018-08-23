@extends('layouts.app')

@section('content')
<div class="container-login">

      <div class="panel-top"><img src="../img/doraly.png" widht="375" height="150"></div>

          <div class="panel-bottom">

              <form method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}

                  <label for="email" class="labelin">E-Mail Address</label>

                  <input id="email" type="email" class="inputlb" name="email" value="{{ old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                      <span>
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif

                  <br><br>

                  <label for="password" class="labelin">Password</label>

                  <input id="password" type="password" class="inputlb" name="password" required>

                  @if ($errors->has('password'))
                      <span>
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif

                  <br>

                  <br>

                  <label class="labelin" style="width:200px;">
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                  </label>

                  <button type="submit" >Login</button>

              </form>

          </div>

</div>
@endsection
