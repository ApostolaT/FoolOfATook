<?php


namespace FoolOfATook\Service;


use FoolOfATook\Exception\NotEnoughCharactersException;
use FoolOfATook\Model\Balrog;
use FoolOfATook\Model\ChildOfIluvatar;
use FoolOfATook\Model\ChildrenOfIluvatarCollection;
use FoolOfATook\Model\Dwarf;
use FoolOfATook\Model\Elf;
use FoolOfATook\Model\Goblin;
use FoolOfATook\Model\Hobbit;
use FoolOfATook\Model\Man;
use FoolOfATook\Model\Orc;
use FoolOfATook\Model\Trol;
use FoolOfATook\Model\Wizard;

class RandomEntityCollectionGenerator
{
    private const NAMES = [
        "Harold",   "Rourke", "Canmore", "Jory",     "Hanover", "Tayshaun",  "Frodo", "Gendalf",
        "Ewan",     "Taras",  "Aras",    "Aragorn",  "Windsor", "Lancaster", "Jory",  "Harry"
    ];
    private RandomNumberGenerator $randomNumberGenerator;

    public function __construct(RandomNumberGenerator $randomNumberGenerator)
    {
        $this->randomNumberGenerator = $randomNumberGenerator;
    }

    public function createCharacters(int $numOfCharacters): ChildrenOfIluvatarCollection
    {
        if ($numOfCharacters <= 1) {
            throw new NotEnoughCharactersException("Given number of Characters must be greater than 1" . PHP_EOL);
        }
        echo "=>Creating $numOfCharacters random entities" . PHP_EOL;
        $childrenOfIluvatar = new ChildrenOfIluvatarCollection();
        for ($i = 0; $i < $numOfCharacters; $i++) {
            $childrenOfIluvatar->add($this->createRandomCharacter());
        }
        echo "=>Random entities created" . PHP_EOL;
        return $childrenOfIluvatar;
    }

    private function createRandomCharacter(): ChildOfIluvatar
    {
        $randomNumber = $this->randomNumberGenerator->generateRandomInt(1, 9);
        $randomCharacter = 0;
        $randomName = $this->randomNumberGenerator->generateRandomInt(1, 16) - 1;
        switch ($randomNumber) {
            case 1:
                $randomCharacter = new Balrog(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 2:
                $randomCharacter = new Dwarf(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 3:
                $randomCharacter = new Elf(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 4:
                $randomCharacter = new Goblin(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 5:
                $randomCharacter = new Hobbit(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 6:
                $randomCharacter = new Man(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 7:
                $randomCharacter = new Orc(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 8:
                $randomCharacter = new Trol(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
            case 9:
                $randomCharacter = new Wizard(
                    $this::NAMES[$randomName],
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99),
                    $this->randomNumberGenerator->generateRandomFloat(0.01, 0.99)
                );
                break;
        }
        echo "-->Entity " . $randomCharacter->getName() . " with " . $randomCharacter->getFightPower() . " fight power " .
            " created" . PHP_EOL;
        return $randomCharacter;
    }
}