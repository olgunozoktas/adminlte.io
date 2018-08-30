@extends('layouts.master')

@section('content')
    <h3>All Categories</h3>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Modify</th>
            </tr>
        </thead>

        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                <td>
                <button class="btn btn-info" data-toggle="modal" data-title="{{$category->title}}" data-description="{{$category->description}}" data-target="#edit" data-category_id="{{$category->id}}">Edit</button> / 
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete" data-category_id="{{$category->id}}">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>

        <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Add Category
    </button>

     <!-- Add New Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">New Category</h4>
        </div>
        <form action="{{route('category.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" cols="20" rows="5" id="description"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>

     <!-- Edit Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
        </div>
        <form action="{{route('category.update', 'test')}}" method="POST">
            {{method_field("PATCH")}} <!-- REQUIRED TO UPDATE AND DATE -->
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="category_id" id="category_id">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" cols="20" rows="5" id="description"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    
    <!-- Edit Modal -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">Delete Category</h4>
        </div>
        <form action="{{route('category.destroy', 'test')}}" method="POST">
            {{method_field("DELETE")}} <!-- REQUIRED TO UPDATE AND DATE -->
            {{ csrf_field() }}
            <div class="modal-body">
                <p class="text-center">
                    Are you sure you want to delete this?
                </p>
                <input type="hidden" name="category_id" id="category_id">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                <button type="submit" class="btn btn-warning">Yes Delete</button>
            </div>
        </form>
        </div>
    </div>
    </div>
@endsection
