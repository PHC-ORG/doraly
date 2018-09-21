@extends('layouts.app')

@section('content')
<div class="content-page">

        <div class="container-profil">

                    <!-- <form class="form-reg" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <br>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <br>

                        <div>
                          <label>Grad Account</label>
                          <br>
                          <select name="grad" id="grad">
                            <option value="user" selected="selected">user</option>
                            <option value="admin">admin</option>
                            <option id="regadm" value="administrator">administrator</option>
                          </select>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form> -->

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

                    <form class="form-reg" method="POST" action="{{ route('register') }}" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <br>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <br>

                        <div>
                          <label>Grad Account</label>
                          <br>
                          <select name="grad" id="grad">
                            <option value="user" selected="selected">user</option>
                            <option value="admin">admin</option>
                            <?php if (Auth::user()->grad == "administrator"): ?>
                            <option id="regadm" value="administrator">administrator</option>
                            <?php endif; ?>

                          </select>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>

        </div>

</div>

@endsection
