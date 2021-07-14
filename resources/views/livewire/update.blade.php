
<div>
    <form enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <h4>Update</h4>
        </div>
        <input type="hidden" class="form-control" wire:model="employee_id">
        <div class="col-md-12">
            <label for="">Name</label>
            <input type="text" class="form-control" wire:model="name">
            @error('name')
            <label for="" class="text-danger">{{$message}}</label>
            @enderror
        </div>
        <div class="col-md-12">
            <label for="">Age</label>
            <input type="text" class="form-control" wire:model="age">
            @error('age')
            <label for="" class="text-danger">{{$message}}</label>
            @enderror
        </div>
        <div class="col-md-12">
            <label for="">Designation</label>
            <input type="text" class="form-control" wire:model="designation">
            @error('designation')
            <label for="" class="text-danger">{{$message}}</label>
            @enderror
        </div>
        <div class="col-md-12">
            <button wire:click.prevent="update()" class="btn btn-primary btn-sm" style="margin: 10px 0px;">Save</button>
            <button wire:click.prevent="cancel()" class="btn btn-secondary btn-sm" style="margin: 10px 0px;">Cancel</button>
        </div>
    </form>
    <div wire:loading wire:target="update, cancel">
        Processing...
    </div>
</div>

