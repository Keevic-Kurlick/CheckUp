@php
    /**
     * @var \App\Models\User $users
     */
@endphp
<div class="users_table">
    <table class="table mt-3 table">
        <thead>
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Email</th>
            <th scope="col">Дата последнего изменения</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr class="users-block">
                <td>
                    <a href="{{ route('admin.users.documents.check.edit', $user->id) }}">
                        {{ $user->name }}
                    </a>
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->updated_at }}
                </td>
            </tr>
        @empty
            <tr class="empty-table-data">
                <td colspan="2">Нет данных</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</div>
