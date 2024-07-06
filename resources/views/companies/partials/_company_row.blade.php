 <tr @if($loop->odd) class='table-primary' @endif </tr>
    {{-- {{ $loop->iteration }} --}}
    <th scope="row">{{ $companies->firstItem() + $index }}</th>
    <td>{{ $company->name }} </td>
    <td>{{ $company->address }}</td>
    <td>{{ $company->email }}</td>
    <td>{{ $company->website }}</td>
    <td width="150">

        @if($showTrashButton)
            <form action="{{route('companies.restore',$company->id)}}"
                  method="POST" onsubmit="askForTrash(event ,'Your company will be restored!')" style="display: inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-circle btn-outline-info"
                        title="Restore" ><i class="fa fa-undo"></i></button>
            </form>
            <form action="{{route('companies.force-delete',$company->id)}}"
                  method="POST" onsubmit="askForTrash(event,'Your company will be Deleted permanantly!')" style="display: inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-circle btn-outline-danger"
                        title="Delete Permenantly" ><i class="fa fa-undo"></i></button>
            </form>
        @else
        <a href="{{ route('companies.show', ['company'=>$company->id]) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
        <a href="{{route('companies.edit',$company->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
        <form action="{{route('companies.destroy',$company->id)}}"
              method="POST" onsubmit="askForTrash(event , 'Your company will be move to trash!')" style="display: inline">
            @csrf
            @method('DELETE')

            <button class="btn btn-sm btn-circle btn-outline-danger" title="Delete" ><i class="fa fa-trash"></i></button>
        </form>
        @endif

    </td>
</tr>
