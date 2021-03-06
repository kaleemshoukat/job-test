<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container">
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
        <form action="{{route('create-post')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                <label for="" class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="name">Description</label>
                <textarea type="text" class="form-control" name="description"></textarea>
                @error('description')
                <label for="" class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="">Post Type</label>
                <select name="type" class="form-control">
                    <option value="">Select Option</option>
                    @if(count($types))
                        @foreach($types as $key=>$type)
                            <option value="{{$key}}">{{$type}}</option>
                        @endforeach
                    @endif
                </select>
                @error('type')
                <label for="" class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-sm" style="margin: 10px 0px;">Save</button>
            </div>
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
