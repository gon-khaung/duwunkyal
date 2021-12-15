<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Unitinout;
use App\Models\Transaction;
use Illuminate\Console\Command;

class AddedUnitInOutDailyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "add:unitinout";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "To add each commissiner's unit in out transaction";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where("roles", "comissioner")->get();
        for ($i = 0; $i < count($users); $i++) {
            $total_unit_in = 0;
            $total_unit_out = 0;
            $transactions = Transaction::where("user_id", $users[$i]->id)
                ->whereDate("created_at", "=", Carbon::today()->toDateString())
                ->get();
            for ($t = 0; $t < count($transactions); $t++) {
                if ($transactions[$t]->status === "in") {
                    $total_unit_in += $transactions[$t]->amount;
                } else {
                    $total_unit_out += $transactions[$t]->amount;
                }
            }

            $unit = new Unitinout();
            $unit->unit_in = $total_unit_in;
            $unit->unit_out = $total_unit_out;
            $unit->unit_rest = $users[$i]->amount;
            $unit->user_id = $users[$i]->id;
            $unit->save();
        }
    }
}
