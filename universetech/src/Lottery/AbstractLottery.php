<?php
namespace Lottery;
use Signal\SignalCenter;

/**
 * Class Lottery
 * 彩種抽象類別
 */
abstract class AbstractLottery
{
    /** @var int 彩種編號(由子類別設定) */
    protected $gameId;
    /** @var int 主訊號源編號(由子類別設定) */
    protected $mainSignalId;
    /** @var string 此 lottery 期號（e.g. "20190903001"） */
    protected $issue;

    function __construct($issue)
    {
        $this->issue = $issue;
    }

    /**
     * 更新開獎資料，可視情況是否需由子類別實作或統一實作
     * @param array $param 要更新的開獎資料
     */
    abstract function update(array $param);

    /**
     * 取得整合過的開獎號碼
     * @return string 開獎號碼
     */
    public function getWinningNumber()
    {
        $signal = new SignalCenter($this->mainSignalId);
        return $signal->getWinningNumber($this->gameId, $this->issue);
    }
}
