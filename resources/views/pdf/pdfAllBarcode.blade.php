<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .w-200px{
            width: 190px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            @foreach ($items as $item)
            <td style="width: 220px">
                <center style="padding-bottom: 5px">{!! $d->getBarcodeHTML(strval($item->barcode), 'EAN13') !!} {{ $item->barcode }}</center>
                Nama : {{ $item->name }}; harga : {{ $item->price }}
            </td>
            @endforeach
        </tr>
    </table>
</body>
</html>