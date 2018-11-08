@extends('layout.default')
@section('contents')
    <form action="{{ route('role.update',[$role]) }}" method="post" enctype="multipart/form-data">
       <div class="form-group">
           <label for="">角色名称</label>
           <input type="text" name="name" class="form-control" value="{{ $role->name }}">
       </div>
        <div class="checkbox">
            @foreach($permissions as $permission)
                <label for="">
                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}" @if($roles->contains($permission)) checked @endif> {{ $permission->name }}
                </label>
            @endforeach
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button class="btn btn-info">提交修改</button>
    </form>
@endsection


