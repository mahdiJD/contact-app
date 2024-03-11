 <tr @if($loop->odd) class='table-primary' @endif </tr>
    {{-- {{ $loop->iteration }} --}}
    <th scope="row">{{ $contacts->firstItem() + $index }}</th>
    <td>{{ $contact->first_name }} </td>
    <td>{{ $contact->last_name }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->company->name }}</td>
    <td width="150">

        @if($showTrashButton)
            <form action="{{route('contacts.restore',$contact->id)}}"
                  method="POST" onsubmit="askForTrash(event ,'Your contact will be restored!')" style="display: inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-circle btn-outline-info"
                        title="Restore" ><i class="fa fa-undo"></i></button>
            </form>
            <form action="{{route('contacts.force-delete',$contact->id)}}"
                  method="POST" onsubmit="askForTrash(event,'Your contact will be Deleted permanantly!')" style="display: inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-circle btn-outline-danger"
                        title="Delete Permenantly" ><i class="fa fa-undo"></i></button>
            </form>
        @else
        <a href="{{ route('contacts.show', ['contact'=>$contact->id]) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
        <a href="{{route('contacts.edit',$contact->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
        <form action="{{route('contacts.destroy',$contact->id)}}"
              method="POST" onsubmit="askForTrash(event , 'Your contact will be move to trash!')" style="display: inline">
            @csrf
            @method('DELETE')

            <button class="btn btn-sm btn-circle btn-outline-danger" title="Delete" ><i class="fa fa-trash"></i></button>
        </form>
        @endif

    </td>
</tr>
