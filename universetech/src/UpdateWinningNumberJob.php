<?php
use Lottery\AbstractLottery;

class UpdateWinningNumberJob
{
    protected $lottery;

    public function __construct(AbstractLottery $lottery)
    {
        $this->lottery = $lottery;
    }

    public function handle()
    {
        try {
            // $this->lottery->gameId 為 int，指彩種編號，
            // 重慶時時彩 = 1
            // 北京11選5 = 2
            // $this->lottery->issue 為 string , 為此 lottery 期號（e.g. "20190903001"）
            // $target = new xxxx($this->lottery); // 請實現此 class
            /**
             * 此處調整為直接將取得開獎號碼的函式getWinningNumber()實作在Lottery中
             * 並將訊號源另外封裝成一個Service
             */
            $winningNumber = $this->lottery->getWinningNumber();
            if (!empty($winningNumber)) {
                $this->lottery->update([
                    'winning_number' => $winningNumber,
                ]);
            }
        } catch (FetchFailureException $e) {
            Log::error('Something went wrong.');
        }
    }
}
