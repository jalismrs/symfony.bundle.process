<?php
declare(strict_types = 1);

namespace Tests;

use Jalismrs\Symfony\Bundle\JalismrsProcessBundle\ProcessManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;
use function count;

/**
 * Class ProcessManagerTest
 *
 * @package Tests
 *
 * @covers  \Jalismrs\Symfony\Bundle\JalismrsProcessBundle\ProcessManager
 */
final class ProcessManagerTest extends
    TestCase
{
    /**
     * testProcessManager
     *
     * @param array $providedInput
     * @param array $providedOutput
     *
     * @return void
     *
     * @throws \PHPUnit\Framework\Exception
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     *
     * @dataProvider \Tests\ProcessManagerProvider::provideProcessManager
     */
    public function testProcessManager(
        array $providedInput,
        array $providedOutput
    ) : void {
        // arrange
        $systemUnderTest = $this->createSUT();
        
        // act
        foreach ($providedInput as $process) {
            $systemUnderTest->addProcess($process);
        }
        $output = $systemUnderTest->getFailedProcesses();
    
        // assert
        /**
         * @var Process[] $providedInput
         */
        foreach ($providedInput as $process) {
            self::assertTrue(
                $process->isTerminated()
            );
        }
        
        self::assertCount(
            count($providedOutput),
            $output
        );
        self::assertContainsOnlyInstancesOf(
            Process::class,
            $output
        );
        /**
         * @var Process $process
         */
        foreach ($providedOutput as $process) {
            self::assertFalse(
                $process->isSuccessful()
            );
            self::assertContains(
                $process,
                $output
            );
        }
    }
    
    /**
     * createSUT
     *
     * @return \Jalismrs\Symfony\Bundle\JalismrsProcessBundle\ProcessManager
     */
    private function createSUT() : ProcessManager
    {
        return new ProcessManager(
            2
        );
    }
}
