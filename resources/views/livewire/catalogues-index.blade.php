<div>

    <!--Main Navigation-->
    <header class="mb-5 fixed-top w-full">
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

                            <input wire:model.live="search" autocomplete="off" type="search"
                                class="form-control rounded" placeholder="Buscar producto..." />
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
    <main class="footer-space">

        <div class="pt-44 md:pt-20 z-0">
            @foreach ($catalogoWeb->categorias as $categoria)
                @if ($categoria->productos->count() == 0)
                    @continue
                @endif
                <div class="row">
                    <div class="col col-md-1 col-sm-0 col-0">

                    </div>
                    <div class="col col-md-10 col-sm-12 col-12">
                        <div class="card mt-10 md:mt-10">
                            <div class="card-header">
                                <h2 class="text-2xl font-bold text-center">{{ $categoria->nombre }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-left">PRODUCTO</th>
                                                <th class="text-center">PRECIO</th>
                                                <th class="text-center">FOTO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categoria->productosPublicados as $producto)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="name-column text-sm font-bold">{{ $producto->nombre }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @if ($tipo == 'revendedor')
                                                            <p class="text-sm sm:text-truncate text-gray-500">
                                                                ${{ $producto->precioventa2 }}</p>
                                                        @elseif($tipo == 'consfinal')
                                                            <p class="text-sm sm:text-truncate text-gray-500">
                                                                ${{ $producto->precioventa3 }}</p>
                                                        @endif

                                                    </td>
                                                    <td class="text-center">

                                                        <button type="button" class="btn btn-xs btn-primary"
                                                            data-mdb-ripple-init data-mdb-modal-init
                                                            data-mdb-target="#photoModal"
                                                            wire:click="showModal('{{ $producto->id }}')">
                                                            <i class="fas fa-camera"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </main>

    <footer>
        <div class="fixed-bottom bg-gray-800  text-white text-center py-3">
            <p>Precios sujetos a modificación sin previo aviso.</p>
        </div>
    </footer>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Foto del Producto</h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($foto_url)
                        <img src="{{ $foto_url }}" class="img-fluid" alt="Foto del Producto">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
