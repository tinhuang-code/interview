<?php
namespace Signal;

/**
 * Class Signal01
 * 訊號源1
 */
class Signal01 extends AbstractSignal
{
    /** @var int 訊號源編號 */
    private $signalId = 1;
    /**
     * @var array gamekey對照表
     * 重慶時時彩(1) => ssc, 北京11選5(2) => bjsyxw
     */
    private $gamekey = [
        1 => 'ssc',
        2 => 'bjsyxw',
    ];

    /**
     * 取得開獎號碼
     * @param   int     彩種編號
     * @param   string  開獎期號
     * @return  string   開獎號碼
     */
    public function getWinningNumber($gameId, $issue)
    {
        try {
            /**
             * GET http://one.fake/v1?gamekey={gamekey}&issue={issue} gamekey 為彩種編號 issue 為開獎期號
             * 此處簡易使用file_get_contents取得資料 實際可能是使用curl去取得資料
             * $url = "http://one.fake/v1?gamekey={$this->gamekey[$gameId]}&issue={$issue}";
             * $data = file_get_contents($url);
             * $data = json_decode($data, true);
             * 為簡化資料 先固定傳回資料如下
             */
            $data = [
                'result' => [
                    'cache' => 0,
                    'data' => [
                        ['gid' => '20190903003', 'award' => '0,6,2,2,3', 'updatetime' => '1567446006'],
                    ],
                ],
                'errorCode' => 0,
            ];
            foreach ($data['result']['data'] as $result) {
                if ($result['gid'] !== $issue) { continue; }
                // 開獎期號相符回傳結果
                return $result['award'];
            }
        } catch (FetchFailureException $e) {
            Log::error('Something went wrong.');
        }
        // 找不到對應期號回傳空字串
        return '';
    }
}
