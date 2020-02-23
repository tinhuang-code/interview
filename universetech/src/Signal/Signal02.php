<?php
namespace Signal;

/**
 * Class Signal02
 * 訊號源2
 */
class Signal02 extends AbstractSignal
{
    /** @var int 訊號源編號 */
    private $signalId = 2;
    /**
     * @var array code對照表
     * 重慶時時彩(1) => cqssc, 北京11選5(2) => bj11x5
     */
    private $code = [
        1 => 'cqssc',
        2 => 'bj11x5',
    ];

    /**
     * 取得開獎號碼
     * @param   int     彩種編號
     * @param   string  開獎期號
     * @return  string  開獎號碼
     */
    public function getWinningNumber($gameId, $issue)
    {
        try {
            /**
             * GET https://two.fake/newly.do?code={code} code 為彩種編號
             * 此處簡易使用file_get_contents取得資料 實際可能是使用curl去取得資料
             * $url = "https://two.fake/newly.do?code={$this->code[$gameId]}";
             * $data = file_get_contents($url);
             * $data = json_decode($data, true);
             * 為簡化資料 先固定傳回資料如下
             */
            $data = [
                'rows' => 3,
                'code' => 'cqssc',
                'data' => [
                    ['expect' => '20190902003', 'opencode' => '3,8,1,9,5', 'opentime' => '2019-09-02 01:12:46'],
                    ['expect' => '20190902002', 'opencode' => '3,1,5,8,6', 'opentime' => '2019-09-02 00:52:37'],
                    ['expect' => '20190902001', 'opencode' => '6,1,9,0,3', 'opentime' => '2019-09-02 00:32:03'],
                ],
            ];
            foreach ($data['data'] as $result) {
                if ($result['expect'] !== $issue) { continue; }
                // 開獎期號相符回傳結果
                return $result['opencode'];
            }
        } catch (FetchFailureException $e) {
            Log::error('Something went wrong.');
        }
        // 找不到對應期號回傳空字串
        return '';
    }
}
