<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$catalogue}} - CIPRES</title>
    
 
    <!-- Font Awesome -->
       

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.4/dist/tailwind.min.css" rel="stylesheet">



    


</head>

<body class="bg-cover bg-no-repeat bg-center bg-fixed " style="background-image: url({{ asset('img/bg.jpg') }})">
   
    @livewireScripts
        <script src="{{ mix('js/app.js') }}"></script>
   @livewire('catalogues-index', ['catalogue' => $catalogue, 'tipo' => $tipo])

</body>

   
</html>
