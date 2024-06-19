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



    <style>
        .table tbody tr td {
            padding-top: 0px; /* Reduce the padding */
            padding-bottom: 0px; /* Reduce the padding */
            padding-right: 0px;
        }
        
        .name-column {
            white-space: nowrap; /* Prevent line breaks */
            overflow-x: auto; /* Enable horizontal scroll */
            max-width: 150px; /* Adjust this value as needed */
            font-size: 0.65rem;
        }

        .btn-xs {
            padding: 0.25rem 0.5rem; /* Smaller padding */
            font-size: 0.75rem; /* Smaller font size */
            line-height: 1; /* Adjust line height */
            border-radius: 0.2rem; /* Adjust border radius */
        }
    </style>


</head>

<body class="bg-cover bg-no-repeat bg-center bg-fixed " style="background-image: url({{ asset('img/bg.jpg') }})">
   
    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
   @livewire('catalogues-index', ['catalogue' => $catalogue, 'tipo' => $tipo])

</body>

   
</html>
