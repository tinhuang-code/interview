<?php
namespace Lottery;

/**
 * Class LotteryBJ
 * 彩種2： 北京11選5
 */
class LotteryBJ extends AbstractLottery
{
    /** @var int 彩種編號 */
    private $gameId = 2;
    /** @var int 主號源編號 */
    private $mainSignalId = 2;

    function update(array $param)
    {
        // TODO 待實作更新開獎號碼
    }
}
