 <tr @if($loop->odd) class='table-primary' @endif </tr>
    {{-- {{ $loop->iteration }} --}}
    <th scope="row">{{ $contacts->firstItem() + $index }}</th>
    <td>{{ $contact->first_name }} </td>
    <td>{{ $contact->last_name }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->company->name }}</td>
    <td width="150">
        <a href="{{ route('contact.show', ['id'=>$contact->id]) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
        <a href="{{route('contact.edit',$contact->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
        <form action="{{route('contact.destroy',$contact->id)}}" method="POST" onsubmit="askForTrash(event)" style="display: inline">
            @csrf
            @method('DELETE')

            <button class="btn btn-sm btn-circle btn-outline-danger" title="Delete" ><i class="fa fa-trash"></i></button>
        </form>

    </td>
</tr>
