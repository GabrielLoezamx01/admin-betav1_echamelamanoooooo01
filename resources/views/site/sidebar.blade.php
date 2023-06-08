    {{-- <h5>Servicios TOP</h5>
    <div v-for="servicio in apiServiciossidebar" class="p-1">
        <div class="m-2 fw-bold">
            <button class="btn fw-light btn-minimalista">
                @{{ servicio.name }}
            </button>
        </div>
    </div> --}}
    <div class="sidebar">
        <ul class="p-3">
            <li class="m-3"><a href="#"><i class="fas fa-envelope"></i> Mensajes</a></li>
            <li class="mt-4 m-3">
                <a href="#" onclick="toggleSubMenu(event)">
                    <i class="fas fa-list"></i> Categorías
                </a>
                <ul class="sub-menu">
                    <div v-for="servicio in apiServiciossidebar" class="p-3">
                        <li><a href="#"> @{{ servicio.name }}</a></li>
                    </div>

                </ul>
            </li>
        </ul>
    </div>
