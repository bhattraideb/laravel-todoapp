@extends('layouts.master')
@section('pageTitle', 'To Do List')

@section('content')
    <div class="jumbotron">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    @include('partials._flash_message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Add Todo</h3>
                            <div class="float-right">
                                <a class="float-right btn btn btn-info btn-md" href="{{ route('todo.list')  }}">
                                    Todo List</a>
                            </div>
                        </div>
                        <div class="card-body">
{{--                            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>#</th>--}}
{{--                                    <th>Title</th>--}}
{{--                                    <th>Description</th>--}}
{{--                                    <th>Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @if(!empty($todos))--}}
{{--                                    @foreach($todos as $todo)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $loop->iteration }}</td>--}}
{{--                                            <td>{{ $todo->title }}</td>--}}
{{--                                            <td>{{ $todo->description }}</td>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ route('todo.edit', $todo->id ) }}" data-app-id="app-{{ $todo->id }}" title="Edit">--}}
{{--                                                    <i class="fa fa-edit"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href="#" title="Delete" class="company-delete" data-id="{{ $todo->id }}" id="company-delete">--}}
{{--                                                    <i class="fa fa-trash"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @else--}}
{{--                                    <tr>--}}
{{--                                        <td>No Todos found.</td>--}}
{{--                                    </tr>--}}
{{--                                @endif--}}
{{--                                </tbody>--}}
{{--                            </table>--}}


                            <div class="col-md-12">
                                {{ Form::open(['url' => route('todo.store'),
                                    'enctype' => 'multipart/form-data',
                                    'method' => 'POST',
                                    'name' => 'frm_add',])
                                }}
                                <div class="form-group col-md-12 ">
                                    <label for="title">Title:</label><br>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" class="form-control">

                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Description:</label><br>
                                    <textarea  name="description" id="description" cols="10" rows="5" class="form-control">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group" class="form-control">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-plus"></i> Save
                                        </button>
                                    </div>
                                </div>

                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection