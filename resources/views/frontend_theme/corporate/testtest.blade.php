<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form id="billing-form" name="billing-form" class="row mb-0" action="{{route('email.varified')}}" method="post">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
         @endif
        <div class="col-md-6 form-group">
            <label for="billing-form-name">Email Varification Code:</label>
            <input type="text" id="billing-form-name" name="code" value="" class="sm-form-control" />
        </div>

        <input type="hidden" value="{{$address->email_verified_code}}" name="email_verified_code">
        <input type="hidden" value="{{$id}}" name="price_id">
        <input type="hidden" value="{{$address->id}}" name="address_id">



        <button type="submit" class="button button-3d float-end">Place Order</button>
    </form>
</body>
</html>
