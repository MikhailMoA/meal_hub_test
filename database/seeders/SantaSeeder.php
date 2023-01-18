<?php

namespace Database\Seeders;

use App\Models\Santa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;

class SantaSeeder extends Seeder
{
    private const COUNT = 50;

    public array $santasIds = [];

    private bool $wrongMapping = false;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $santas = $this->generateSantas();
        $mapping = $this->getMapping($santas);
        $this->saveSantas($mapping);
    }

    /**
     * @return array
     */
    private function generateSantas(): array
    {
        $santas = [];
        for ($i = 0; $i < self::COUNT; $i++) {
            $santa = new Santa();
            $santa->name = $this->generateName();;
            $santa->save();
            $santas[] = $santa;
            $this->santasIds[$santa->id] = $santa->id;
        }

        return $santas;
    }

    /**
     * @return string
     */
    private function generateName(): string
    {
        $name = fake()->name();
        $validator = Validator::make(['name' => $name], [
            'name' => 'unique:santas,name',
        ]);

        if ($validator->failed()) {
            return $this->generateName();
        }

        return $name;
    }

    /**
     * @param array $santas
     * @return array
     */
    private function getMapping(array $santas): array
    {
        $mapping = [];
        /** @var Santa $santa */
        foreach ($santas as $santa) {
            $santaId = $this->getSantaId($santa);
            if ($this->wrongMapping) {
                break;
            }
            $mapping[$santaId] = $santa;
        }

        if ($this->wrongMapping) {
            $this->wrongMapping = false;
            return $this->getMapping($santas);
        }

        return $mapping;
    }

    /**
     * @param Santa $santa
     * @return int
     */
    private function getSantaId(Santa $santa): int
    {
        $id = array_rand($this->santasIds);
        if ($id !== $santa->id) {
            unset($this->santasIds[$id]);
            return $id;
        }

        if (count($this->santasIds) === 1) {
            $this->wrongMapping = true;
        } else {
            return $this->getSantaId($santa);
        }
    }

    /**
     * @param array $mapping
     * @return void
     */
    public function saveSantas(array $mapping): void
    {
        foreach ($mapping as $santaId => $santa) {
            $santa->santa_id = $santaId;
            $santa->save();
        }
    }
}
