<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\User;


class UserBackup extends Command
{
      /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'backup user from database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $user;
    public function __construct()
    {
        parent::__construct();
       
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $table = $this->argument('table');
         $user = User::exclude(['id'])->get();
       $user = json_encode($user);
        echo implode(explode(" ",$user));
        $storage_path = "storage/app/".$table.".sql";
         $file = fopen($storage_path,"w");
                  fwrite($file,$user);
                  fclose($file);
    }
  
}