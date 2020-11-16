# symfony.bundle.process

Adds Symfony process service

## Test

`phpunit` or `vendor/bin/phpunit`

coverage reports will be available in `var/coverage`

## Use

```php
use Jalismrs\Symfony\Bundle\JalismrsProcessBundle\ProcessManager;

class SomeApiClass {
    private ProcessManager $processManager;

    public function someApiCall(): void {
        $processes = [
        
        ];
    
        foreach($processes as $process) {
            $this->processManager->addProcess(
                $process
            );
        }
        
        
    }
}
```

## Configuration

```yaml
# config/packages/jalismrs_api_throttler.yaml

jalismrs_api_throttler:
    cap: 1
```
