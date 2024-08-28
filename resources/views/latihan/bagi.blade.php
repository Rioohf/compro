<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Pembagian</h1>
<form action="{{route('store_pembagian')}}" method="post">
    @csrf
    <label for="">Angka 1</label>
    <input type="number" name="angka1" placeholder="masukan angka 1"><br><br>
    <h2>/</h2>
    <label for="">Angka 2</label>
    <input type="number" name="angka2" placeholder="masukan angka 2"><br><br>
    <button type="submit">Hitung</button>
</form>
<h4>Total: {{$jumlah}}</h4>
<a href="{{url('latihan')}}">Back</a>
</body>
</html>
