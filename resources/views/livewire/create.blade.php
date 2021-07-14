
<div>
    <form enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <h4>Create</h4>
        </div>
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
            <button wire:click.prevent="store()" class="btn btn-primary btn-sm" style="margin: 10px 0px;">Save</button>
        </div>
    </form>
    <div wire:loading wire:target="store">
        Processing...
    </div>
</div>

