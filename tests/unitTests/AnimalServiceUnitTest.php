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
final class AnimalServiceUnitTest extends TestCase {
    private $animalService;

    private $name;
    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->name = $name;
        $this->animalService = new AnimalService();
    }

    public function testCreateAnimalWithValidInputs() {
        $result = $this->animalService->createAnimal('Chien', '123456');
        $this->assertTrue($result);
    }

    public function testCreationAnimalWithoutAnyText() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom doit être renseigné');
        $this->animalService->createAnimal(null, null);
    }

    public function testCreateAnimalWithEmptyName() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom doit être renseigné');
        $this->animalService->createAnimal('', '123456');
    }

    public function testCreateAnimalWithEmptyIdentification() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le numeroIdentification doit être renseigné');
        $code = 20;
        $this->animalService->createAnimal('Chat', empty($code));
    }

    public function testCreationAnimalWithoutName() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom doit être renseigné');
        $this->animalService->createAnimal(null, '52515255');
    }

    public function testCreationAnimalWithoutNumber() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le numeroIdentification doit être renseigné');
        $this->animalService->createAnimal('Chat', null);
    }

    public function testSearchAnimalWithValidSearch() {
        $this->animalService->createAnimal('Chien', '123456');
        $result = $this->animalService->searchAnimal('Chien');
        $this->assertIsArray($result);
    }
    public function testSearchAnimalWithEmptySearch() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('search doit être renseigné');
        $nom = "chien";
        $this->animalService->searchAnimal(empty($nom));
    }

    public function testSearchAnimalWithNumber() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('search doit être une chaine de caractères');
        $this->animalService->searchAnimal(55584147);
    }

    public function testModifyAnimalWithValidInputs() {
        $result = $this->animalService->updateAnimal(1, 'Chat', '654321');
        $this->assertTrue($result);
    }
    public function testModifyAnimalWithEmptyName() {
        $this->expectException(InvalidInputException::class);
        $this->expectExceptionMessage('le nom  doit être renseigné');
        $nom =  "Chat";
        $this->animalService->updateAnimal(1, empty($nom), '654321');
    }

    public function testModifyAnimalWithNullName() {
        $this->expectException(InvalidInputException::class);
        $this->expectExceptionMessage('le nom  doit être renseigné');
        $this->animalService->updateAnimal(1, null, '654321');
    }

    public function testModifyAnimalWithInvalidId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('l\'id doit être renseigné');
        $id = 2 ;
        $this->animalService->updateAnimal(empty($id),'chat','15852415852');
    }

    public function testModifyAnimalWithNonNumericId() {
        $this->expectException(InvalidInputException::class);
        $this->expectExceptionMessage('l\'id doit être un entier non nul');
        $this->animalService->updateAnimal("Hello", 'Nouveau nom', '654321');
    }

    public function testModifyAnimalWithNegativeId() {
        $this->expectException(InvalidInputException::class);
        $this->expectExceptionMessage('l\'id doit être un entier non nul');
        $this->animalService->updateAnimal(-1, 'Nouveau nom', '654321');
    }

    public function testModifyAnimalWithEmptyIdentification() {
        $this->expectException(InvalidInputException::class);
        $this->expectExceptionMessage('le numeroIdentification doit être renseigné');
        $code = 15225255;
        $this->animalService->updateAnimal(1, 'Nouveau nom', empty($code));
    }

    public function testDeleteAnimalWithTextAsId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('l\'id doit être un entier non nul');
        $this->animalService->deleteAnimal("animal");
    }

    public function testDeleteAnimalWithValidId() {
        $result =  $this->animalService->deleteAnimal(1);
        $this->assertTrue($result);
    }

    public function testDeleteAnimalWithNegatifAsId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('l\'id doit être un entier non nul');
        $this->animalService->deleteAnimal(-1);
    }
    public function testDeleteAnimalWithNullAsId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('l\'id doit être renseigné');
        $this->animalService->deleteAnimal(null);
    }
}
