<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteData extends Command
{
    protected $signature = "delete:data";

    protected $description = "This will delete datas.";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->deleteRaw("twodnumber_user", null, 30);
        $this->deleteRaw("threednumber_user", null, 30);
        $this->deleteRaw("vouchers", null, 30);
        $this->deleteRaw("twod_histories", null, 7);
        $this->deleteRaw("threed_histories", null, 30);
        $this->deleteRaw("deposits", "deposits", 7);
        $this->deleteRaw("withdraws", null, 7);
        $this->deleteRaw("transactions", null, 30);
    }
    private function deleteRaw($tableName, $type, $time)
    {
        $datas = DB::table($tableName)
            ->where(
                "created_at",
                "<=",
                (new Carbon())
                    ->subDays($time)
                    ->startOfDay()
                    ->toDateString()
            )
            ->get();
        if ($type === "deposits") {
            for ($i = 0; $i < count($datas); $i++) {
                $this->deleteExitImage($datas[$i]->transaction_image);
            }
        }
        $datas->delete();
    }
    public function deleteExitImage($deleteImage)
    {
        $filename = substr($deleteImage, 36);
        $isExit = Storage::disk("public")->exists("/images/" . $filename);
        if ($isExit) {
            Storage::disk("public")->delete("/images/" . $filename);
        }
        return;
    }
}
