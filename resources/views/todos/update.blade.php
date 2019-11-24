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
                            <h3 class="float-left">Update Todo</h3>
                            <div class="float-right">
                                <a class="float-right btn btn btn-info btn-md" href="{{ route('todo.list')  }}">
                                    Todo List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                {{ Form::open(['url' => route('todo.update'),
                                    'enctype' => 'multipart/form-data',
                                    'method' => 'POST',
                                    'name' => 'frm_add',])
                                }}
                                <div class="form-group col-md-12 ">
                                    <label for="title">Title:</label><br>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $todo->title }}" class="form-control">
                                    <input type="hidden" name="todo_id" id="todo_id" class="form-control" value="{{ $todo->id }}" class="form-control">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Description:</label><br>
                                    <textarea  name="description" id="description" cols="10" rows="5" class="form-control">{{ $todo->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group" class="form-control">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-plus"></i> Update
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