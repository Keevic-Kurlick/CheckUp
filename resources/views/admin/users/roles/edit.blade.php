@extends('admin.baseAdminTemplate')

@php
/**
 * @var \App\Models\User[] $users
 * @var \App\Models\Role[] $roles
*/
@endphp

@section('title', __('admin.menu.assign_user_role'))

@section('content_header')
    <h1> {{ __('admin.menu.assign_user_role') }}</h1>
@endsection

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <form action="{{ route('admin.users.roles.edit') }}" method="post">
        @csrf
        <input type="submit" class="btn btn-success" value="Изменить">
        <table class="table mt-3 container">
            <thead>
                <tr>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Роль</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            <select name="users[{{ $user->id }}]"
                                    class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                    {{ ($user->role_id === $role->id) ? 'selected' : '' }}>
                                        {{ __("users.roles.$role->name") }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
@endsection