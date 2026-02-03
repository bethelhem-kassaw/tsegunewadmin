<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>stripe</h1>
    <h2> price : $5</h2>
    <form action="{{ route('stripePayment') }}" method="post">

        @csrf
        <input type="hidden "   name= "price" value="5">
        <input type="hidden "   name= "product_name" value="laptop">
        <input type="hidden "   name= "quantity" value="1">
        <input type="submit" value="Pay Now with paypal">
    </form>
</body>
</html>
