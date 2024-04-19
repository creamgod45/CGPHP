<?php

namespace Auth;

class Player
{
    // Base
    public string $UUID = "";
    public string $DisplayName = "";
    public string $Name = "";
    public string $IP = "";
    public string $Rank = "";
    public string $RankName = "";
    public string $PlayTime = "";
    public bool $AFK = false;
    public int $Ping = 0;
    public bool $canFly = false;
    public float $EXP = 0.0;
    public float $Health = 0.0;
    public int $ExpToLevel = 0;
    public int $Level = 0;
    public int $TotalLevel = 0;
    public float $WalkSpeed = 1.0;
    public int $FoodLevel = 0;
    public string $GameMode = "";
    public string $CustomName = "";

    public bool $OP = false;

    public bool $Fly = false;
    public bool $Sneaking = false;
    public bool $PlayerTimeRelative = false;
    public bool $Sleeping = false;
    public bool $Glowing = false;
    public bool $Valid = false;
    public bool $InsideVehicle = false;
    public bool $InWater = false;
    public bool $Persistent = false;
    public bool $Silent = false;
    public bool $Dead = false;
    public bool $Banned = false;
    public bool $Blocking = false;
    public bool $Climbing = false;
    public bool $Collidable = false;
    public bool $Frozen = false;
    public bool $Gliding = false;
    public bool $Swimming = false;
    public bool $Invisible = false;
    public bool $Invulnerable = false;
    public bool $Riptiding = false;
    public bool $Whitelist = false;

    public bool $init = false;
    public int $RPGLevel = 0;
    public float $MaxHealth = 0.0;
    public float $MaxMana = 0.0;
    public float $Mana = 0.0;
    public float $MaxStamina = 0.0;
    public float $Stamina = 0.0;
    public int $AttributePoints = 0;
    public int $SkillPoints = 0;
    public int $ClassPoints = 0;

    /**
     * @param string $UUID
     * @param string $DisplayName
     * @param string $Name
     * @param string $IP
     * @param string $Rank
     * @param string $RankName
     * @param string $PlayTime
     * @param bool $AFK
     * @param int $Ping
     * @param bool $canFly
     * @param float $EXP
     * @param float $Health
     * @param int $ExpToLevel
     * @param int $Level
     * @param int $TotalLevel
     * @param float $WalkSpeed
     * @param int $FoodLevel
     * @param string $GameMode
     * @param string $CustomName
     * @param bool $OP
     * @param bool $Fly
     * @param bool $Sneaking
     * @param bool $PlayerTimeRelative
     * @param bool $Sleeping
     * @param bool $Glowing
     * @param bool $Valid
     * @param bool $InsideVehicle
     * @param bool $InWater
     * @param bool $Persistent
     * @param bool $Silent
     * @param bool $Dead
     * @param bool $Banned
     * @param bool $Blocking
     * @param bool $Climbing
     * @param bool $Collidable
     * @param bool $Frozen
     * @param bool $Gliding
     * @param bool $Swimming
     * @param bool $Invisible
     * @param bool $Invulnerable
     * @param bool $Riptiding
     * @param bool $Whitelist
     * @param int $RPGLevel
     * @param float $MaxHealth
     * @param float $MaxMana
     * @param float $Mana
     * @param float $MaxStamina
     * @param float $Stamina
     * @param int $AttributePoints
     * @param int $SkillPoints
     * @param int $ClassPoints
     */
    public function __construct(string $UUID, string $DisplayName, string $Name, string $IP, string $Rank, string $RankName, string $PlayTime, bool $AFK, int $Ping, bool $canFly, float $EXP, float $Health, int $ExpToLevel, int $Level, int $TotalLevel, float $WalkSpeed, int $FoodLevel, string $GameMode, string $CustomName, bool $OP, bool $Fly, bool $Sneaking, bool $PlayerTimeRelative, bool $Sleeping, bool $Glowing, bool $Valid, bool $InsideVehicle, bool $InWater, bool $Persistent, bool $Silent, bool $Dead, bool $Banned, bool $Blocking, bool $Climbing, bool $Collidable, bool $Frozen, bool $Gliding, bool $Swimming, bool $Invisible, bool $Invulnerable, bool $Riptiding, bool $Whitelist, int $RPGLevel, float $MaxHealth, float $MaxMana, float $Mana, float $MaxStamina, float $Stamina, int $AttributePoints, int $SkillPoints, int $ClassPoints)
    {
        $this->UUID = $UUID;
        $this->DisplayName = $DisplayName;
        $this->Name = $Name;
        $this->IP = $IP;
        $this->Rank = $Rank;
        $this->RankName = $RankName;
        $this->PlayTime = $PlayTime;
        $this->AFK = $AFK;
        $this->Ping = $Ping;
        $this->canFly = $canFly;
        $this->EXP = $EXP;
        $this->Health = $Health;
        $this->ExpToLevel = $ExpToLevel;
        $this->Level = $Level;
        $this->TotalLevel = $TotalLevel;
        $this->WalkSpeed = $WalkSpeed;
        $this->FoodLevel = $FoodLevel;
        $this->GameMode = $GameMode;
        $this->CustomName = $CustomName;
        $this->OP = $OP;
        $this->Fly = $Fly;
        $this->Sneaking = $Sneaking;
        $this->PlayerTimeRelative = $PlayerTimeRelative;
        $this->Sleeping = $Sleeping;
        $this->Glowing = $Glowing;
        $this->Valid = $Valid;
        $this->InsideVehicle = $InsideVehicle;
        $this->InWater = $InWater;
        $this->Persistent = $Persistent;
        $this->Silent = $Silent;
        $this->Dead = $Dead;
        $this->Banned = $Banned;
        $this->Blocking = $Blocking;
        $this->Climbing = $Climbing;
        $this->Collidable = $Collidable;
        $this->Frozen = $Frozen;
        $this->Gliding = $Gliding;
        $this->Swimming = $Swimming;
        $this->Invisible = $Invisible;
        $this->Invulnerable = $Invulnerable;
        $this->Riptiding = $Riptiding;
        $this->Whitelist = $Whitelist;
        $this->RPGLevel = $RPGLevel;
        $this->MaxHealth = $MaxHealth;
        $this->MaxMana = $MaxMana;
        $this->Mana = $Mana;
        $this->MaxStamina = $MaxStamina;
        $this->Stamina = $Stamina;
        $this->AttributePoints = $AttributePoints;
        $this->SkillPoints = $SkillPoints;
        $this->ClassPoints = $ClassPoints;
        $this->init = false;
    }

    /**
     * @return string
     */
    public function getUUID(): string
    {
        return $this->UUID;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->DisplayName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @return string
     */
    public function getIP(): string
    {
        return $this->IP;
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->Rank;
    }

    /**
     * @return string
     */
    public function getRankName(): string
    {
        return $this->RankName;
    }

    /**
     * @return string
     */
    public function getPlayTime(): string
    {
        return $this->PlayTime;
    }

    /**
     * @return bool
     */
    public function isAFK(): bool
    {
        return $this->AFK;
    }

    /**
     * @return int
     */
    public function getPing(): int
    {
        return $this->Ping;
    }

    /**
     * @return bool
     */
    public function isCanFly(): bool
    {
        return $this->canFly;
    }

    /**
     * @return float
     */
    public function getEXP(): float
    {
        return $this->EXP;
    }

    /**
     * @return float
     */
    public function getHealth(): float
    {
        return $this->Health;
    }

    /**
     * @return int
     */
    public function getExpToLevel(): int
    {
        return $this->ExpToLevel;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->Level;
    }

    /**
     * @return int
     */
    public function getTotalLevel(): int
    {
        return $this->TotalLevel;
    }

    /**
     * @return float
     */
    public function getWalkSpeed(): float
    {
        return $this->WalkSpeed;
    }

    /**
     * @return int
     */
    public function getFoodLevel(): int
    {
        return $this->FoodLevel;
    }

    /**
     * @return string
     */
    public function getGameMode(): string
    {
        return $this->GameMode;
    }

    /**
     * @return string
     */
    public function getCustomName(): string
    {
        return $this->CustomName;
    }

    /**
     * @return bool
     */
    public function isOP(): bool
    {
        return $this->OP;
    }

    /**
     * @return bool
     */
    public function isFly(): bool
    {
        return $this->Fly;
    }

    /**
     * @return bool
     */
    public function isSneaking(): bool
    {
        return $this->Sneaking;
    }

    /**
     * @return bool
     */
    public function isPlayerTimeRelative(): bool
    {
        return $this->PlayerTimeRelative;
    }

    /**
     * @return bool
     */
    public function isSleeping(): bool
    {
        return $this->Sleeping;
    }

    /**
     * @return bool
     */
    public function isGlowing(): bool
    {
        return $this->Glowing;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->Valid;
    }

    /**
     * @return bool
     */
    public function isInsideVehicle(): bool
    {
        return $this->InsideVehicle;
    }

    /**
     * @return bool
     */
    public function isInWater(): bool
    {
        return $this->InWater;
    }

    /**
     * @return bool
     */
    public function isPersistent(): bool
    {
        return $this->Persistent;
    }

    /**
     * @return bool
     */
    public function isSilent(): bool
    {
        return $this->Silent;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->Dead;
    }

    /**
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->Banned;
    }

    /**
     * @return bool
     */
    public function isBlocking(): bool
    {
        return $this->Blocking;
    }

    /**
     * @return bool
     */
    public function isClimbing(): bool
    {
        return $this->Climbing;
    }

    /**
     * @return bool
     */
    public function isCollidable(): bool
    {
        return $this->Collidable;
    }

    /**
     * @return bool
     */
    public function isFrozen(): bool
    {
        return $this->Frozen;
    }

    /**
     * @return bool
     */
    public function isGliding(): bool
    {
        return $this->Gliding;
    }

    /**
     * @return bool
     */
    public function isSwimming(): bool
    {
        return $this->Swimming;
    }

    /**
     * @return bool
     */
    public function isInvisible(): bool
    {
        return $this->Invisible;
    }

    /**
     * @return bool
     */
    public function isInvulnerable(): bool
    {
        return $this->Invulnerable;
    }

    /**
     * @return bool
     */
    public function isRiptiding(): bool
    {
        return $this->Riptiding;
    }

    /**
     * @return bool
     */
    public function isWhitelist(): bool
    {
        return $this->Whitelist;
    }


    // RPG

    /**
     * @return int
     */
    public function getRPGLevel(): int
    {
        return $this->RPGLevel;
    }

    /**
     * @return float
     */
    public function getMaxHealth(): float
    {
        return $this->MaxHealth;
    }

    /**
     * @return float
     */
    public function getMaxMana(): float
    {
        return $this->MaxMana;
    }

    /**
     * @return float
     */
    public function getMana(): float
    {
        return $this->Mana;
    }

    /**
     * @return float
     */
    public function getMaxStamina(): float
    {
        return $this->MaxStamina;
    }

    /**
     * @return float
     */
    public function getStamina(): float
    {
        return $this->Stamina;
    }

    /**
     * @return int
     */
    public function getAttributePoints(): int
    {
        return $this->AttributePoints;
    }

    /**
     * @return int
     */
    public function getSkillPoints(): int
    {
        return $this->SkillPoints;
    }

    /**
     * @return int
     */
    public function getClassPoints(): int
    {
        return $this->ClassPoints;
    }

}