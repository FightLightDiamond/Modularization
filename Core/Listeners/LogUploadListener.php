<?php

namespace Modularization\Core\Listeners;
use Modularization\Core\Events\LogUploadEvent;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class LogUploadListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogUploadEvent $event
     * @return void
     */
    public function handle(LogUploadEvent $event)
    {
        $data = "TYPE: " . $event->type . " | LINK: " . $event->path . "| FIX: " . env('PREFIX_UPLOAD') . " | creator:" . auth()->user()->username . "|IP: " . Request::ip() . " | Time: " . date('Y-m-d H:m:i');
        $file = 'log-report.txt';
        $exists = Storage::disk('local')->exists($file);
        if ($exists === false) {
            Storage::disk('local')->put($file, $data);
        }
        Storage::disk('local')->prepend($file, $data);
    }
}
