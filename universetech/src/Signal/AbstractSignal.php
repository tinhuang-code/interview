<?php
namespace Signal;

/**
 * Class Signal
 * 訊號源抽象類別
 */
abstract class AbstractSignal
{
    /** @var int 訊號源編號(由子類別設定) */
    protected $signalId;

    /**
     * 取得該訊號源的開獎號碼
     * @param   int     彩種編號
     * @param   string  開獎期號
     * @return  string   開獎號碼
     */
    abstract public function getWinningNumber($gameId, $issue);
}
