<?php
namespace Signal;

/**
 * Class SignalCenter
 * 訊號源操作類別
 */
class SignalCenter
{
    /** @var int 主訊號源編號 */
    private $mainSignalId;
    /** @var array 訊號源對應表 gameID => className */
    private $signals = [
        1 => Signal01::class,
        2 => Signal02::class,
    ];

    public function __construct($mainSignalId)
    {
        $this->mainSignalId = $mainSignalId;
    }

    /**
     * 取得整合過的開獎號碼
     * @param int    $gameId 彩種編號
     * @param string $issue  期號
     * @return string 開獎號碼(以逗號區隔)
     */
    public function getWinningNumber($gameId, $issue)
    {
        /**
         * 建立主訊號源實例並取得開獎資料
         * @var AbstractSignal $signal 主訊號源編號
         */
        $signal = new $this->signals[ $this->mainSignalId ]();
        $resultMain = $signal->getWinningNumber($gameId, $issue);
        // 檢查其他訊號源
        foreach ($this->signals as $signalId => $className) {
            // 主訊號源跳過
            if ($this->mainSignalId == $signalId) { continue; }
            /**
             * 建立其他訊號源實例並取得開獎資料
             * @var AbstractSignal $signal 主訊號源編號
             */
            $signal = new $className();
            $resultVice = $signal->getWinningNumber($gameId, $issue);
            // 結果符合主訊號源結果 回傳結果
            if ($resultMain !== '' && $resultMain === $resultVice) {
                return $resultMain;
            }
        }
        // 找不到結果符合主訊號源 回傳空字串
        return '';
    }
}
