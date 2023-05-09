<?php
use Illuminate\Console\Command;
use SocketIO\Server;
use App\Http\Controllers\PublicacionesController;

class Socket extends Command
{
    protected $signature = 'socket:serve';
    protected $description = 'Start the socket server';

    public function handle()
    {
        $server = new Server(3000);
        $server->on('connection', function ($socket) use ($server) {
            $publicaciones = new PublicacionesController();
            $socket->on('actualizar_tareas', function () use ($socket, $server, $publicaciones) {
                $tareas = $publicaciones->index();
                $server->emit('publicaciones_actualizadas', $tareas);
            });
        });
        $server->serve();
    }
}
