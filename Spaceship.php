<?php

class spaceship
{
    // Properties
    protected bool $isAlive;
    protected int $fuel;
    protected int $hitPoints;
    protected int $ammo;
    protected string $cannonType;
    protected int $longitude;
    protected int $latitude;

    public function __construct(
        $ammo = 100,
        $fuel = 100,
        $hitPoints = 100,
        $longitude = 0,
        $latitude = 0,
        $cannonType = "basic",
    )
    {
        $this->ammo = $ammo;
        $this->fuel = $fuel;
        $this->hitPoints = $hitPoints;
        $this->cannonType = $cannonType;
        $this->isAlive = true;
    }

    //semi randomized damage or ammo consumption
    protected function shoot(): int
    {
        $shot = rand(4, 6);
        $damage = 5 * ($shot / 10);
        $validCannons = [
            "advanced",
            "supreme"
        ];
    
    //Placeholder (different cannons?)
        if (in_array($this->cannonType, $validCannons)) {
            switch ($this->cannonType) {
                case $validCannons[0]:
                    $damage = $damage * 2.5;
                    break;
                case $validCannons[1]:
                    $damage = $damage * 3;
                    break;
            }
        }

        if ($this->ammo - $shot >= 0) {
            $this->ammo -= $shot;
            return ($shot * $damage);
        } else {
            return 0;
        }   
    }


    protected function hit($damage) 
    {
        if ($this->hitPoints - $damage > 0) {
            $this->hitPoints -= $damage;
        } else {
            $this->isAlive = false;
        }
    }

    //Still am implementing position
    protected function move()
    {
        $fuelUsage = 2;
        if ($this->fuel - $fuelUsage > 0) {
            $this->fuel -= $fuelUsage;
        } else {
            $this->fuel = 0;
        }
    }
}

class fighterShip extends Spaceship
{

    public function setIsAlive(bool $isAlive): void
    {
        $this->isAlive = $isAlive;
    }

    public function isAlive(): bool
    {
        return $this->isAlive;
    }

    public function getAmmo()
    {
        return $this->ammo;
    }

    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }

    public function getFuel(): int
    {
        return $this->fuel;
    }

    public function getPosition(): int
    {
        return $this->position = array($longitude, $latitude);
    }

    public function changeCannonType(string $cannon): string
    {
        return $this->cannonType = $cannon;
    }

    public function shoot(): int
    {
        return parent::shoot();
    }

    public function hit($damage)
    {
        parent::hit($damage);
    }

}

class carrierShip extends spaceship {

}