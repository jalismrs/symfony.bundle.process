<?php
declare(strict_types = 1);

namespace Jalismrs\Symfony\Bundle\JalismrsProcessBundle;

use Symfony\Component\Process\Process;
use function array_filter;
use function array_values;
use function count;

/**
 * Class ProcessManager
 *
 * @package Jalismrs\Symfony\Bundle\JalismrsProcessBundle
 */
class ProcessManager
{
    /**
     * cap
     *
     * @var int
     */
    private int $cap;
    /**
     * runningProcesses
     *
     * @var array
     */
    private array $runningProcesses = [];
    /**
     * completedProcesses
     *
     * @var array
     */
    private array $completedProcesses = [];
    
    /**
     * ProcessManager constructor.
     *
     * @param int $cap
     */
    public function __construct(
        int $cap
    ) {
        $this->cap = $cap;
    }
    
    /**
     * addProcess
     *
     * @param \Symfony\Component\Process\Process $process
     * @param callable|null                      $callback
     * @param array                              $env
     *
     * @return void
     *
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    public function addProcess(
        Process $process,
        callable $callback = null,
        array $env = []
    ) : void {
        if ($this->cap > 0) {
            $this->wait($this->cap);
        }
        
        $process->start(
            $callback,
            $env
        );
        
        $this->runningProcesses[] = $process;
    }
    
    /**
     * wait
     *
     * @param int $cap
     *
     * @return void
     */
    private function wait(
        int $cap
    ) : void {
        while (count($this->runningProcesses) > $cap) {
            /**
             * @var Process $process
             */
            foreach ($this->runningProcesses as $index => $process) {
                if (!$process->isRunning()) {
                    $this->completedProcesses[] = $process;
                    unset($this->runningProcesses[$index]);
                }
            }
        }
    }
    
    /**
     * finish
     *
     * @return void
     */
    public function finish() : void
    {
        $this->wait(0);
    }
    
    /**
     * clear
     *
     * @return void
     */
    public function clear() : void
    {
        $this->finish();
        
        $this->completedProcesses = [];
        $this->runningProcesses   = [];
    }
    
    /**
     * getFailedProcesses
     *
     * @return array
     */
    public function getFailedProcesses() : array
    {
        $this->finish();
        
        $processes = array_filter(
            $this->completedProcesses,
            static function(
                Process $process
            ) : bool {
                return !$process->isSuccessful();
            },
        );
        
        $this->clear();
        
        return array_values($processes);
    }
}
