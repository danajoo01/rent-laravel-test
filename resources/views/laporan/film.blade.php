@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Movie Data Report</h4>

  <div class="col-md-2 pull-left">
    <a href="{{ url('laporan/film/pdf') }}" class="btn btn-primary btn-rounded btn-fw"><b><i class="fa fa-download"></i> Export PDF</a></b>
  </div>
  <div class="col-md-2 pull-left">
     <a href="{{ url('laporan/film/excel') }}" class="btn btn-success btn-rounded btn-fw">
     <b><i class="fa fa-download"></i> Export EXCEL</a></b>
  </div>
                </div>
              </div>
            </div>
          </div>
@endsection