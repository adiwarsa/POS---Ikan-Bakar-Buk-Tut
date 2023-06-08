<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stock = Stock::where('qtytype', '<=', 1)->where('remind', '=', 0)->latest()->orderBy('created_at', 'desc')->get();
        $pegawai = User::where('role', '=', 2)->where('status', '=', 'active')->get();
        $phoneNumbers = $pegawai->pluck('phone')->implode(',');
        $message = 'Halo *Pegawai* 
Some stocks will run out
';
if (!$stock->isEmpty()) {
        foreach ($stock as $item) {
            $name = $item->name;
            $qtytype = $item->qtytype;
            $type = $item->type;
            $qty = $item->qty;
            $item->remind = 1;
            $item->save();

            $message .= '
Stock name *' . $name;
            $message .= ' Stock remaining *' . $qty . ' pcs'. ' = ' . $qtytype . '* ' . $type . ' ' ;
            $message .= PHP_EOL;
        }

        $message .= '
Please restock!';

        $fonnte = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'JHo@f!MiddUTWVCfZERS',
        ])->asForm()->post('https://api.fonnte.com/send', [
            "target" => $phoneNumbers,
            "type"  => "text",
            "message" => $message,
            "delay" => 3,
        ]);

        foreach ($stock as $item) {
            Log::info($item->name . ' ' . date('Y-m-d H:i:s'));
        }
    }
}
}
