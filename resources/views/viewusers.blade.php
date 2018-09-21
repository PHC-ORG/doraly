@extends('layouts.app')

@section('content')

      <div class="content-page">


        <div class="container-profil" value="{{ Auth::user()->grad }}" id="profil">

          <div class="container-profil-left">



              <table>

                <tr>
                  <td class="td-l">Name</td>
                  <td>{{ Auth::user()->name }}</td>
                </tr>

                <tr>
                  <td class="td-l">E-Mail</td>
                  <td>{{ Auth::user()->email }}</td>
                </tr>

                <tr>
                  <td class="td-l">Rights</td>
                  <td>{{ Auth::user()->grad }}</td>
                </tr>

                <tr>
                  <td class="td-l">Created at</td>
                  <td>{{ Auth::user()->created_at }}</td>
                </tr>

                <tr>
                  <td class="td-l">Last updated at</td>
                  <td>{{ Auth::user()->updated_at }}</td>
                </tr>

                <tr>
                  <td></td>
                  <td></td>
                </tr>

              </table>

              <br>
              <br>
              <?php if (Auth::user()->grad == "admin" || Auth::user()->grad == "administrator"): ?>

                  <a href="{{ route('register') }}" class="profil-button1">Add account</a>
                  <br><br>
                  <a href="{{ route('viewusers') }}" class="profil-button2">View users</a>

              <?php endif; ?>
          </div>

          <div class="container-profil-right">

              <?php
                if(Auth::user()->grad == "admin"){
                  $users_data = DB::select("SELECT * FROM users WHERE grad != 'administrator' ");
                }elseif (Auth::user()->grad == "administrator") {
                  $users_data = DB::table('users')->get();
                }

              ?>
              <table class="table table-striped table-bordered">
                <tr>
    <td class="td-tw-l">Name</td>
    <td class="td-tw-c">E-Mail</td>
    <td class="td-tw-c">Rights</td>
    <td class="td-tw-c">Created at</td>
    <td class="td-tw-r">Last updated at</td>
   </tr>
   @foreach($users_data as $user)
   <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->grad }}</td>
    <td>{{ $user->created_at }}</td>
    <td>{{ $user->updated_at }}</td>
    <td>Delete account</td>
   </tr>
   @endforeach
  </table>

</div>

</div>


</div>


@endsection
