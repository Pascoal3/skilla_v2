<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use Carbon\Carbon;

class ExpireInactiveJobs extends Command
{
    protected $signature = 'jobs:expire';
    protected $description = 'Cancela automaticamente trabalhos que ultrapassaram a data de expiração';

    public function handle()
    {
        $count = Job::where('status', 'aberto')
                    ->where('expira_em', '<', Carbon::now())
                    ->update(['status' => 'cancelado']);

        $this->info("O sistema cancelou $count trabalhos expirados.");
    }
}