@extends('layouts.admin.app')

@section('title') {{$Module}} @endsection

@push('css_or_js')

@endpush

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@section('content')

<div class="content container-fluid">
          
            <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col-sm mb-2 mb-sm-0">
                                <h1 class="page-header-title"><i class="tio-contacts"></i> {{$Module}} <span class="badge badge-soft-dark ml-2" id="itemCount">{{$Records->count()}}</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Header -->
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    

                    <div class="card-body">
                        @include('admin-views.messages') 
                       <!--  <div class="row">
                            <div class="col-sm-12">
                            <a class="btn btn-lg btn-primary" href="{{ route($RoutePrefixName.'.create') }}">{{ $RecordAddModule }}</a>
                            </div>
                        </div> -->              
                    <br> 
                    <div style="overflow-x: auto;">                  
                      <table class="table table-responsive-sm table-striped" id="tableID">
                        <thead>
                          <tr>
                            <th>Sr.No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>E-mail</th>
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>  
                                        @php $i =1; @endphp
                                        @if(!empty($Records) && $Records->count())
                                        @foreach($Records as $Record)
                                            <tr>
                                                <td> {{ $i }} </td>
                                                <td> {{ $Record->name }} </td>
                                                <td> {{ $Record->phone }} </td>
                                                <td> {{ $Record->email }} </td>
                                                <td>
                                                    <div class="action-box">
                                                        <div class="edit-button">
                                                            <a href="{{ route($RoutePrefixName.'.edit',$Record->id) }}" class="btn btn-sm btn-white" title="Edit Pass"><i class="tio-edit"></i></a>
                                                        </div>

                                                      <div class="delete-button"> 
                                                        <form action="{{ route($RoutePrefixName.'.destroy',$Record->id) }}" method="POST"  onsubmit="return confirm('Do you really want to delete?');">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button  class="btn btn-sm btn-danger"><i class="tio-delete-outlined"></i></button>
                                                        </form>
                                                        
                                                        </div>
                                                    </div> 
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                    @else
                                        <tr class="odd">
                                            <td valign="top" colspan="7" class="text-center">No Record Found
                                            </td>
                                        </tr>
                                    @endif
                                                 
                                    </tbody>
                      </table>
                    </div>
                    </div>
                </div>
              </div>
            </div>
          
</div>



<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 <!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>

<script>

 $(document).ready(function() {

  $('#tableID').DataTable();

  });

</script>

<style type="text/css">

table.dataTable thead th, table.dataTable thead td 
{
        white-space: nowrap;
}
    .delete-btn
{
    border:none;
    background: none;
}

.action-box
{
display: flex;
align-items: center;
}
.edit-button
{
margin-right: 10px;
}
  
.delete-button form
{
   margin-bottom: 0;
}
.action-box .edit-button a 
{
   display: inline-block;
}
</style>


@endsection