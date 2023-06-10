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
            <li class="m-3 fw-bold fs-5"><a href="#"><i class="fas fa-envelope"></i> Mensajes</a></li>
            <li class="mt-4 m-3 fw-bold fs-5">
                <a href="#" onclick="toggleSubMenu(event)">
                    <i class="fas fa-list"></i> Categorías
                </a>
                <ul class="sub-menu">
                    <div v-for="servicio in apiServiciossidebar" class="p-3">
                        <li><a href="#"> <span class="fas fa-caret-right"></span> @{{ servicio.name }}</a></li>
                    </div>
                </ul>
            </li>
            <li class="m-3 fw-bold fs-5 mt-4">
                <a href="Sucursales">
                    <i class="fas fa-store"></i> Surcursales
                </a>
            </li>
            <li class="m-3 fw-bold fs-5 mt-4">
                <div v-if="countNotify > 0" class="text-danger">
                    <i class="fas fa-bell"></i> Notificaciones
                    <div class="fs-6 fw-light">
                        <div v-for="notify in arrayNotify" class="m-3">
                            <div class="notification p-3">
                                <div class="content">
                                    <div class="text-dark">
                                        <p class="message"><strong>@{{ notify.titulo }}</strong></p>
                                        <label for="">@{{ notify.mensaje }}</label>
                                        <p class="timestamp">@{{ notify.fecha_envio }}</p>
                                        @{{ getJsonValue(notify.json) }}
                                        <a v-if="settingsNotify.type = 1"
                                            :href="'comments?id=' + settingsNotify.id_post" @click="updateNotify(notify.id)" class="text-center btn">Ver
                                            Comentario </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else="countNotify = []">
                    <i class="fas fa-bell"></i>
                    Notificaciones
                </div>
            </li>
        </ul>
        <hr class="shadow">
    </div>
