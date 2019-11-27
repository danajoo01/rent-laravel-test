@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
              //console.log("lerrrr");
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('film.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Add New Movie List</h4>
                      
                        <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                            <label for="judul" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
                                @if ($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('movie_id') ? ' has-error' : '' }}">
                            <label for="movie_id" class="col-md-4 control-label">ID Movie</label>
                            <div class="col-md-6">
                                <input id="movie_id" type="text" class="form-control" name="movie_id" value="{{ old('movie_id') }}" required>
                                @if ($errors->has('movie_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('movie_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('filmby') ? ' has-error' : '' }}">
                            <label for="filmby" class="col-md-4 control-label">Film By</label>
                            <div class="col-md-6">
                                <input id="filmby" type="text" class="form-control" name="filmby" value="{{ old('filmby') }}" required>
                                @if ($errors->has('filmby'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('filmby') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('studio') ? ' has-error' : '' }}">
                            <label for="studio" class="col-md-4 control-label">Studio Film</label>
                            <div class="col-md-6">
                                <input id="studio" type="text" class="form-control" name="studio" value="{{ old('studio') }}" required>
                                @if ($errors->has('studio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('studio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                            <label for="tahun" class="col-md-4 control-label">Date Release</label>
                            <div class="col-md-6">
                                <input id="tahun" type="date" maxlength="4" class="form-control" name="tahun" value="{{ old('tahun') }}" required>
                                @if ($errors->has('tahun'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tahun') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('stok') ? ' has-error' : '' }}">
                            <label for="stok" class="col-md-4 control-label">Stock</label>
                            <div class="col-md-6">
                                <input id="stok" type="number" maxlength="4" class="form-control" name="stok" value="{{ old('stok') }}" required>
                                @if ($errors->has('stok'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stok') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                            <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
                            <div class="col-md-12">
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{ old('deskripsi') }}" >
                                @if ($errors->has('deskripsi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                            <label for="lokasi" class="col-md-4 control-label">Stack</label>
                            <div class="col-md-6">
                            <select class="form-control" name="lokasi" required="">
                                <option value=""></option>
                                <option value="rak1">Stack of 1</option>
                                <option value="rak2">Stack of 2</option>
                                <option value="rak3">Stack of 3</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Cover</label>
                            <div class="col-md-6">
                                <img width="200" height="200" />
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="{{route('film.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection