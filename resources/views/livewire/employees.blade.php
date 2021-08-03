<div class="col-md-12">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <div wire:offline>
        You are now offline.
    </div>

{{--    <div wire:poll>--}}
{{--        Current time: {{ now() }}--}}
{{--    </div>--}}

    @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif
    <div class="responsive-table">
        <div wire:loading wire:target="edit, delete">
            Processing...
        </div>
        <table class="table table-bordered mt-5">
            <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Age</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($employees))
                @foreach($employees as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->age }}</td>
                        <td>{{ $value->designation }}</td>
                        <td>
                            <button wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Edit</button>
                            <button wire:click="delete({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No data</td>
                </tr>
            @endif
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
</div>
@section('scripts')
    <script type="text/javascript">
        console.log ('EmployeeChannel-'+{{Auth::user()->id}}) ;

        Echo.channel('EmployeeChannel-'+{{Auth::user()->id}})
            .listen('EmployeeCreated', (e) => {
                console.log(e);
                //Livewire.emit('notifyNewOrder', e.order.name);
            })
    </script>
@endsection
