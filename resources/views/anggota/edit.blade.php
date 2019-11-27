@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('anggota.update', $data->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Member</h4>
                      
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('id_number') ? ' has-error' : '' }}">
                            <label for="id_number" class="col-md-4 control-label">ID Number</label>
                            <div class="col-md-6">
                                <input id="id_number" type="number" class="form-control" name="id_number" value="{{ $data->id_number }}" maxlength="8" required>
                                @if ($errors->has('id_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-4 control-label">Age</label>
                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control" name="age" value="{{ $data->age }}" required>
                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_created') ? ' has-error' : '' }}">
                            <label for="date_created" class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input id="date_created" type="date" class="form-control" name="date_created" value="{{ $data->date_created }}" required>
                                @if ($errors->has('date_created'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_created') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                            <label for="level" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                            <select class="form-control" name="jk" required="">
                                <option value=""></option>
                                <option value="L" {{$data->jk === "L" ? "selected" : ""}}>Male</option>
                                <option value="P" {{$data->jk === "P" ? "selected" : ""}}>Female</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Address</label>
                            <div class="col-md-6">
                            <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $data->alamat }}" required>
                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} " style="margin-bottom: 20px;">
                            <label for="user_id" class="col-md-4 control-label">User Login</label>
                            <div class="col-md-6">
                            <select class="form-control" name="user_id" required="">
                                <option value="">(User Active)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{$data->user_id === $user->id ? "selected" : ""}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">
                                    Change data
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="{{route('anggota.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection