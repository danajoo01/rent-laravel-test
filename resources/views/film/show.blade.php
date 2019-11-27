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
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Details <b>{{$data->judul}}</b> </h4>
                      <form class="forms-sample">

                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->cover) src="{{ asset('images/film/'.$data->cover) }}" @endif />
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                            <label for="judul" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control" name="judul" value="{{ $data->judul }}" readonly="">
                                @if ($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('npm') ? ' has-error' : '' }}">
                            <label for="movie_id" class="col-md-4 control-label">ID Movie</label>
                            <div class="col-md-6">
                                <input id="movie_id" type="text" class="form-control" name="movie_id" value="{{ $data->movie_id }}" readonly>
                                @if ($errors->has('movie_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('movie_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('filmby') ? ' has-error' : '' }}">
                            <label for="filmby" class="col-md-4 control-label">Film by</label>
                            <div class="col-md-6">
                                <input id="filmby" type="text" class="form-control" name="filmby" value="{{ $data->filmby }}" readonly>
                                @if ($errors->has('filmby'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('filmby') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('studio') ? ' has-error' : '' }}">
                            <label for="studio" class="col-md-4 control-label">studio</label>
                            <div class="col-md-6">
                                <input id="studio" type="text" class="form-control" name="studio" value="{{ $data->studio }}" readonly>
                                @if ($errors->has('studio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('studio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                            <label for="tahun" class="col-md-4 control-label">Date realase</label>
                            <div class="col-md-6">
                                <input id="tahun" type="number" maxlength="4" class="form-control" name="tahun" value="{{ $data->tahun }}" readonly>
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
                                <input id="stok" type="number" maxlength="4" class="form-control" name="stok" value="{{ $data->stok }}" readonly>
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
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{ old('deskripsi') }}" readonly="">
                                @if ($errors->has('deskripsi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                            <label for="lokasi" class="col-md-4 control-label">Lokasi</label>
                            <div class="col-md-6">
                            <select class="form-control" name="lokasi" disabled="">
                                <option value="rak1" {{$data->lokasi === "rak1" ? "selected" : ""}}>Stack of 1</option>
                                <option value="rak2" {{$data->lokasi === "rak2" ? "selected" : ""}}>Stack of 2</option>
                                <option value="rak3" {{$data->lokasi === "rak3" ? "selected" : ""}}>Stack of 3</option>
                            </select>
                            </div>
                        </div>


                        <a href="{{route('film.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
@endsection