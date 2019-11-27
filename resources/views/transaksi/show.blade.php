@extends('layouts.app')

@section('content')

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b>{{$data->kode_transaksi}}</b></h4>
                    <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->film->cover) src="{{ asset('images/film/'.$data->film->cover) }}" @endif />
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                            <label for="kode_transaksi" class="col-md-4 control-label">Transaction Code</label>
                            <div class="col-md-6">
                                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="{{$data->kode_transaksi}}" required readonly="">
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                            <label for="tgl_pinjam" class="col-md-4 control-label">Take out Movie</label>
                            <div class="col-md-3">
                                <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime($data->tgl_pinjam)) }}" readonly="">
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                            <label for="tgl_kembali" class="col-md-4 control-label">Take in Movie</label>
                            <div class="col-md-3">
                                <input id="tgl_kembali" type="date"  class="form-control" name="tgl_kembali" value="{{ date('Y-m-d', strtotime($data->tgl_kembali)) }}" readonly="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="anggota_id" class="col-md-4 control-label">Movie</label>
                            <div class="col-md-6">
                                <input id="film" type="text" class="form-control" readonly="" value="{{$data->film->judul}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="anggota_id" class="col-md-4 control-label">Member</label>
                            <div class="col-md-6">
                                <input id="anggota_nama" type="text" class="form-control" readonly="" value="{{$data->anggota->nama}}">

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                @if($data->status == 'pinjam')
                                  <label class="badge badge-warning">Take out Movie</label>
                                @else
                                  <label class="badge badge-success">Take in Movie</label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Information</label>
                            <div class="col-md-6">
                                <input id="ket" type="text" class="form-control" name="ket" value="{{ $data->ket }}" readonly="">
                            </div>
                        </div>

                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>


@endsection