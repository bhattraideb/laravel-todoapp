@extends('layouts.master')
@section('pageTitle', 'To Do List')
@section('styles')
    {!! Html::style('assets/dataTables/datatables.min.css') !!}
@endsection

@section('content')
    <div class="jumbotron">
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Todo List</h3>
                        <div class="float-right">
                            <a class="float-right btn btn btn-info btn-md" href="{{ route('todo.create')  }}">Add New</a>
                        </div>
                    </div>
                    @include('partials._flash_message')
                    <div class="row" style="margin: 0 50px 0 120px;">
                        <div class="card-body col-sm-10">
                            <table id="todo-list" class="table table-bordered table-responsive table-striped" cellspacing="0"  width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Added Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($todos))
                                    @foreach($todos as $todo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $todo->title }}</td>
                                            <td>{{ $todo->description }}</td>
                                            <td>{{ $todo->created_at }}</td>
                                            <td>
                                                <a href="{{ route('todo.edit', $todo->id ) }}" data-app-id="app-{{ $todo->id }}" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" title="Delete" class="todo-delete" data-id="{{ $todo->id }}" id="todo-delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('assets/dataTables/datatables.min.js') !!}
    <script>
        $(function () {
            $('#todo-list').dataTable( {
                "searching": false,
                "bInfo" : false,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
            });
            $('.todo-delete').click(function(e){
                e.preventDefault();
                if (confirm('Are you sure you want to delete this record?')) {
                    $recordId = $(this).data('id');
                    $.ajax({
                        url: '{{ url('todos/delete') }}/' + $recordId,
                        type: 'GET',
                        dataType: 'text',
                        success: function (response) { console.log(response);
                            if (response === 'success') {
                                alert('Record deleted successfully');
                            } else {
                                alert('Record can not be deleted now. Try again later.');
                            }
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection