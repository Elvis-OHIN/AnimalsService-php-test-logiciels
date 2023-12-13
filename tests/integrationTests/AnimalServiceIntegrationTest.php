<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;


require __DIR__ . '/../../src/AnimalService.php';

/**
 * * @covers invalidInputException
 * @covers \AnimalService
 *
 * @internal
 */
final class AnimalServiceIntegrationTest extends TestCase
{
    private $animalService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->animalService = new AnimalService();
    }

    // test de suppression de toute les données, nécessaire pour nettoyer la bdd de tests à la fin
    public function testDeleteAll()
    {
        $response = $this->animalService->deleteAllAnimal();
        $this->assertInstanceOf(PDOStatement::class,  $response);
    }


    public function testCreation()
    {
        $response = $this->animalService->createAnimal('Chat', '55858551');
        $this->assertTrue($response);
    }

    public function testSearch()
    {
        $this->animalService->createAnimal('Chat', '55858551');
        $response = $this->animalService->searchAnimal('Chat');
        $this->assertIsArray($response);
    }

    public function testModify()
    {
        $response = $this->animalService->updateAnimal(1,'Chat', '55858551');
        $this->assertTrue($response);
    }

    public function testDelete()
    {
        $response = $this->animalService->deleteAnimal(1);
        $this->assertTrue($response);
    }

}
