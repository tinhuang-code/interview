<?php
namespace Lottery;

/**
 * Class LotteryCQ
 * 彩種1： 重慶時時彩
 */
class LotteryCQ extends AbstractLottery
{
    /** @var int 彩種編號 */
    private $gameId = 1;
    /** @var int 主號源編號 */
    private $mainSignalId = 1;

    function update(array $param)
    {
        // TODO 待實作更新開獎號碼
    }
}
