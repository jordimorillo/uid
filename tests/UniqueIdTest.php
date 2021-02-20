<?php


namespace Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Async\Pool;
use Src\UniqueId;

class UniqueIdTest extends TestCase
{
    private const TOTAL_TESTS = 10;
    private const TOTAL_WORKERS = 100;
    private const TOTAL_GENERATED_IDS = 50;

    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(UniqueId::class, new UniqueId());
    }

    /**
     * @dataProvider setRepetitions()
     * @param int $repetition
     */
    public function testUniqueIdNotRepeated(int $repetition): void
    {
        $pool = Pool::create();
        ob_start();
        for ($i=0; $i<self::TOTAL_WORKERS; $i++) {
            $pool[] = async(
                static function(){
                    $ids = [];
                    for ($i=0; $i<self::TOTAL_GENERATED_IDS; $i++) {
                        $ids[] = new UniqueId();
                    }
                    return $ids;
                }
            )->then(
                static function(array $ids) {
                    foreach($ids as $id) {
                        echo $id."\r\n";
                    }
                }
            );
        }
        await($pool);
        $rawWorkersOutput = ob_get_clean();
        $workersOutput = explode("\r\n", $rawWorkersOutput);

        $comparingArray = [];
        foreach ($workersOutput as $uid) {
            if (!empty($comparingArray[$uid])) {
                self::fail('The sequence is not unique at repetition #'.$repetition);
            }
            $comparingArray[$uid] = $uid;
        }
        self::assertTrue(true);
    }

    public function setRepetitions(): array
    {
        $return = [];
        for ($i=1; $i <= self::TOTAL_TESTS; $i++) {
            $return['Cycle '.$i] = [$i];
        }
        return $return;
    }
}
