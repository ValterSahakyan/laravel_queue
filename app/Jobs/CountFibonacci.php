<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Fibonacci;

class CountFibonacci implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validatedData, $result, $arr = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Fibonacci $validatedData)
    {
        $this->validatedData = $validatedData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fibonacci = $this->validatedData;
        $result = $this->fibonacciRecursion($fibonacci->number);
        $fibonacci->update([
            'result' => $result,
            'status' => "successed"
        ]);
    }

    /**
     *  fibonacci formula recursion
     *  @param int
     *  @return int
     */
    protected function fibonacciRecursion($index){
        if(array_key_exists($index,$this->arr)) return $this->arr[$index];
        if($index === 2 || $index === 1) return 1;
        $sum = $this->fibonacciRecursion($index - 2) + $this->fibonacciRecursion($index - 1);
        $this->arr[$index]  = $sum;
        return $sum;
    }
}
