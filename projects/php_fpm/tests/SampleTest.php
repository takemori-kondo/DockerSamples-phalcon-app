<?php
// PHP8.3
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SampleTest extends TestCase
{
    public function testSample(): void
    {
        $val = true;
        $this->assertSame(true, $val);
    }
}
