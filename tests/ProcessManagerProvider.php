<?php
declare(strict_types = 1);

namespace Tests;

use Symfony\Component\Process\PhpProcess;

/**
 * Class ProcessManagerProvider
 *
 * @package Tests
 */
final class ProcessManagerProvider
{
    /**
     * provideProcessManager
     *
     * @return array
     */
    public function provideProcessManager() : array
    {
        $scriptWillSucceed = <<<EOF
<?php
    \usleep(100);
    echo('completed');
EOF;
        $scriptWillFail    = <<<EOF
<?php
    \usleep(100);
    throw new \Exception('failed');
EOF;
        $process           = new PhpProcess($scriptWillSucceed);
        $processA          = clone $process;
        $processB1         = clone $process;
        $processB2         = clone $process;
        $processB3         = clone $process;
        $proccessB4        = new PhpProcess($scriptWillFail);

        return [
            'one process'    => [
                'input'  => [
                    $processA,
                ],
                'output' => [],
            ],
            'many processes' => [
                'input'  => [
                    $processB1,
                    $processB2,
                    $processB3,
                    $proccessB4,
                ],
                'output' => [
                    $proccessB4,
                ],
            ],
        ];
    }
}
