<?php

namespace Tests\Unit\CleanArchitecture\EnterpriseBusinessRule\Entities;

use App\CleanArchitecture\EnterpriseBusinessRule\Entities\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function test_calc_2倍のsalaryを返すことを確認()
    {
        //  arrange
        $id = 1;
        $salary = 10000;
        $entity = new Entity($id, $salary);

        $expected = 20000;

        //  act
        $actual = $entity->calc();

        //  assert
        $this->assertSame($expected, $actual);
    }
}