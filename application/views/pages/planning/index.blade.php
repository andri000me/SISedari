@extends('layouts.panel')

@section('hstyles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Planning</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ site_url('') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Planning</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Planning</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
								<div class="col-sm-6">
									<div class="row">
										<a href="{{ site_url('planning/create') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> New Planning</a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row float-right">
										<label for="filter">
											<select id="table-data-filter-column" class="form-control form-control-sm">
												<option>Judul</option>
												<option>Tanggal Promo Mulai</option>
												<option>NIP</option>
												<option>Status</option>
											</select>
										</label>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table id="table-data" class="table table-bordered table-striped text-center table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Tanggal Promo Mulai</th>
                                    <th>NIP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
									<td>1</td>
                                    <td>Promo Buy One Get One</td>
                                    <td>14 July 2019</td>
									<td>10036432</td>
									<td>
										<a class="btn btn-info" href="{{ site_url('planning/show/1') }}"><i class="fa fa-eye"></i> Show</a>
										<a class="btn btn-warning" href="{{ site_url('planning/edit/1') }}"><i class="fa fa-edit"></i> Edit</a>
										<a class="btn btn-danger" href="{{ site_url('planning/destroy/1') }}"><i class="fa fa-trash"></i> Delete</a>
									</td>
								</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('fscripts')
<!-- DataTables -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Page Script -->
<script>
$(document).ready(function() {
    var groupColumn = 1;
    var table = $('#table-data').DataTable({
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7"><b>'+group+'</b></td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );

    $('.dataTables_filter input').unbind().bind('keyup', function() {
        var colIndex = document.querySelector('#table-data-filter-column').selectedIndex;
        table.column( colIndex).search( this.value ).draw();
    });

    // Order by the grouping
    $('#table-data tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    } );
} );
</script>
@endsection
