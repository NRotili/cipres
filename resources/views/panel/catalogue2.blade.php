<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $catalogue }} - CIPRES</title>


    <!-- Font Awesome -->


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.4/dist/tailwind.min.css" rel="stylesheet">



    <style>
        .table tbody tr td {
            vertical-align: middle;
            padding: 0px;
        }

        .text-center {
            text-align: center;
        }

        .name-column {
            word-break: break-word;
            /* Break long words */
            text-align: left;
            max-width: 150px;
            /* Adjust this value as needed */
            font-size: 0.65rem;
        }

        .name-column span {
            display: block;
            line-height: 1;
        }

        .btn-xs {
            padding: 0.25rem 0.5rem;
            /* Smaller padding */
            font-size: 0.75rem;
            /* Smaller font size */
            line-height: 1;
            /* Adjust line height */
            border-radius: 0.2rem;
            /* Adjust border radius */
            color: rgb(255, 255, 255);
            /* background-color: rgb(178, 60, 253); */
            background-color: rgb(227, 0, 123);
        }

        .footer-space {
            margin-bottom: 100px;
        }
    </style>


</head>

<body class="bg-cover bg-no-repeat bg-center bg-fixed " style="background-image: url({{ asset('img/bg.jpg') }})">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('show-modal', function() {
                const modalElement = document.getElementById('photoModal');
                const modal = new mdb.Modal(modalElement);
                modal.show();
            });
        });
    </script>

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
    @livewire('catalogues-index', ['catalogue' => $catalogue, 'tipo' => $tipo])

</body>


</html>
