<div>

    <!--Main Navigation-->
    <header class="mb-5 fixed w-full">
        <!-- Jumbotron -->
        <div class="p-3 text-center text-white" style="background-color: #131921">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
                        <a href="#!" class="ms-md-2">
                            <img src="{{ asset('img/logo.png') }}" width="100" />
                        </a>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex input-group w-auto my-auto mb-3 mb-md-0">

                            <input wire:model="search" autocomplete="off" type="search" class="form-control rounded"
                                placeholder="Buscar producto..." />
                            <span class="input-group-text border-0 d-none d-lg-flex"><i
                                    class="fas fa-search text-white"></i></span>
                            </div>
                    </div>

                    <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
                        <div class="d-flex">
                            <!-- Cart -->
                            <a class="text-reset me-3" href="https://www.instagram.com/cipres.limpieza/">
                                <span><i class="fab fa-instagram"></i></span>
                            </a>

                            <a class="text-reset me-3" href="https://www.facebook.com/CipresLimpieza">
                                <span><i class="fab fa-facebook-f"></i></span>
                            </a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->



    </header>
    <!--Main Navigation-->
    <main class="">

        <div class="pt-44 md:pt-20">
            <div class="grid px-2 gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($products as $product)
                    <div class="flex-auto flex-col">
                        <div class="flex-auto bg-white shadow-md  rounded-3xl p-4">
                            <div class="flex">
                                <div class=" h-auto w-auto lg:h-40 lg:w-40   lg:mb-0 mb-3">
                                    <img src="@if ($product->image) {{ Storage::url($product->image->url) }} @else {{ asset('img/nodisponible.jpg') }} @endif"
                                        alt="CIPRES"
                                        class="w-auto h-40 object-cover lg:object-cover  lg:h-40 rounded-2xl">
                                </div>
                                <div class="flex-auto ml-3 justify-evenly py-2">
                                    <div class="flex flex-wrap ">

                                        <h2 class="flex-auto text-lg font-medium">{{ $product->nombre }}</h2>
                                    </div>
                                    <p class="mt-3"></p>

                                    <div class="flex pt-2 pb-2 border-t border-gray-200 "></div>

                                    <div class="h-auto">
                                        <div class="flex text-sm text-gray-500">
                                            <div class="flex-1 inline-flex items-center">
                                                <p class="">Costo</p>
                                            </div>
                                        </div>
                                        <div class="flex pb-4 pt-1 text-sm text-gray-500">
                                            <div class="flex-1 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-1 text-gray-400" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>

                                                <p class="">
                                                    @if ($tipo == 'revendedor')
                                                        {{ $product->precioventa2 }}
                                                    @elseif($tipo == 'consfinal')
                                                        {{ $product->precioventa3 }}
                                                    @endif
                                                <p>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <footer>
        
        <div class="fixed-bottom bg-gray-800  text-white text-center py-3">
            <p>Precios sujetos a modificación sin previo aviso.</p>
        </div>
    </footer>
</div>
