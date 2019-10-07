<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessLogFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $userId;
    public $message;
    public $event_id;

    public function __construct($userId, $message, $event_id)
    {
        $this->userId = $userId;   
        $this->message = $message;   
        $this->event_id = $event_id;   
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $log_message = date("Y-m-d H:i:s")." ".$this->userId." \"$this->message\" ".$this->event_id.PHP_EOL;
        $filePath = 'D:\\xampp\\htdocs\erpv01\public\assets\log.txt';
        $log_file = fopen($filePath, 'a');
        fwrite($log_file, $log_message);
        fclose($log_file);
    }
}
