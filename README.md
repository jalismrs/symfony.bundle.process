# symfony.bundle.process

Adds Symfony process service

## Test

`phpunit` or `vendor/bin/phpunit`

coverage reports will be available in `var/coverage`

## Use

```php
use Jalismrs\Symfony\Bundle\JalismrsProcessBundle\ProcessManager;

class SomeClass {
    private ProcessManager $processManager;

    public function someCall1(): void {
        $processes = [
            new Symfony\Component\Process\Process(
                [],
            ),
        ];
    
        foreach($processes as $process) {
            $this->processManager->addProcess(
                $process
            );
        }
        
        // wait for processes to finish
        $this->processManager->finish();
    }
    
    public function someCall2(): void {
        $processes = [
            new Symfony\Component\Process\Process(
                [],
            ),
        ];
    
        foreach($processes as $process) {
            $this->processManager->addProcess(
                $process
            );
        }
        
        // wait for processes to finish
        // and clears stored processes
        $this->processManager->clear();
    }
    
    public function someCall3(): void {
        $processes = [
            new Symfony\Component\Process\Process(
                [],
            ),
        ];
    
        foreach($processes as $process) {
            $this->processManager->addProcess(
                $process
            );
        }
        
        // wait for processes to finish
        // and clears stored processes
        // and returns failed processes
        $failedProcesses = $this->processManager->getFailedProcesses();
    }
}
```

## Configuration

```yaml
# config/packages/jalismrs_process.yaml

jalismrs_process:
    cap: 1
```
