<div class="admin-article-list">
    <h2>Edit Users</h2>
    <span class="divider"></span>
    <table class="admin-list-table">
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>E-mail verified</th>
            <th>Member since</th>
            <th>Role</th>
            <th></th> {{-- Promotion button --}}
            <th></th> {{-- Demotion button --}}
            <th></th> {{-- Delete button --}}
        </tr>
        <tbody>
        @foreach($allUsers as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->isEmailVerified() ? 'Yes' : 'No'}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->role}}</td>
                @if(Auth::user()->isAdmin())
                    @if(!$user->isAdmin())
                    <td>
                        <form action="/admin/users" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user-id-to-change" value="{{$user->id}}">
                            <button type="submit" class="button" name="action" value="promote"
                            >{{$user->isWriter() ? 'Promote to admin' : 'Promote to writer'}}</button>
                        </form>
                    </td>
                    @else
                        <td></td>
                    @endif
                    @if($user->isAdmin() && $numAdmins > 1 || $user->isWriter())
                    <td>
                        <form action="/admin/users" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user-id-to-change" value="{{$user->id}}">
                            <button type="submit" class="button" name="action" value="demote"
                            >{{$user->isAdmin() ? 'Change to writer' : 'change to user'}}</button>
                        </form>
                    </td>
                    @else
                    <td></td>
                    @endif
                    @if(!$user->isAdmin() || $numAdmins > 1)
                    <td>
                        <form action="/admin/users" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user-id-to-change" value="{{$user->id}}">
                            <button type="submit" class="button" name="action" value="delete"
                            >Delete</button>
                        </form>
                    </td>
                    @else
                        <td></td>
                    @endif
                @else
                <td></td>
                <td></td>
                <td></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
