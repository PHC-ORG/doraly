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
                  <td class="td-l">Grad</td>
                  <td>{{ Auth::user()->grad }}</td>
                </tr>

                <tr>
                  <td class="td-l">Data created account</td>
                  <td>{{ Auth::user()->created_at }}</td>
                </tr>

                <tr>
                  <td class="td-l">Data last update</td>
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


        </div>

      </div>




@endsection
