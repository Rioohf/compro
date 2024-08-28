<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h2{
            font-size: 20px;
            color: rgb(0, 183, 255);
        }
        a{
            background-color: rgb(22, 149, 172);
            color: white;
            padding: 5px 20px;
            text-decoration: none;
            border-radius: 5px;

        }
    </style>
</head>
<body>
    <h1>Perkalian</h1>
<form action="{{route('store_perkalian')}}" method="post">
    @csrf
    <label for="">Angka 1:</label>
    <input type="number" name="angka1" placeholder="masukan angka 1"><br><br>
    <h2>X</h2>
    <label for="">Angka 2:</label>
    <input type="number" name="angka2" placeholder="masukan angka 2"><br><br>
    <button type="submit">Hitung</button>
</form>
<h4>Total: {{$jumlah}}</h4>
<a href="{{url('latihan')}}">Back</a>
</body>
</html>
