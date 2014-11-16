<?php
//note: to execute -> open cmd at location C:\wamp\www\Symfony (ie. localhost/Symfony)
//
//      GENERATE ENTITIES
//      run: php app/console doctrine:generate:entities Rendonan
//
//      CREATE TBL
//      run: php app/console doctrine:schema:update --force
//
//      CLEAR CACHE
//      run: php app/console cache:clear



namespace Rendonan\MiniBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbl_Highscore")
 * @UniqueEntity(fields="username", message="Sorry, this username is already taken.")
 */

Class Highscore
{
/////////////////////////////////////////////////////////////////
//////////////////////REQUIRED FOR REGISTRATION//////////////////
/////////////////////////////////////////////////////////////////
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=100)
     */
    protected $username;


    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $user_score = 0;
/////////////////////////////////////////////////////////////////
////////////////////////USER GAME STATISTICS/////////////////////
/////////////////////////////////////////////////////////////////
//xp        -> Level and score are based of this
//coins     -> In-game upgrade purchase
//hp        -> Health points
//strength  -> Damage multiplier
//agility   -> Requirement for certain items

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $user_experience = 0;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $user_coins = 0;

    /**
     * @ORM\Column(type="integer", options={"default" = 100})
     */
    protected $stat_hp = 100; //max hp level

    /**
     * @ORM\Column(type="integer", options={"default" = 1})
     */
    protected $stat_strength = 1;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $stat_agility = 0;



/////////////////////////////////////////////////////////////////
//////////////////////////USER PROTECTION////////////////////////
/////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////
/////////////////////////GETTERS / SETTERS///////////////////////
/////////////////////////////////////////////////////////////////
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setScore($user_score)
    {
        $this->user_score = $user_score;
    }

    public function getScore()
    {
        return $this->user_score;
    }
    ///////////////////////////////////////

    public function setStatAgility($stat_agility)
    {
        $this->stat_agility = $stat_agility;
    }

    public function getStatAgility()
    {
        return $this->stat_agility;
    }

    public function setStatHp($stat_hp)
    {
        $this->stat_hp = $stat_hp;
    }

    public function getStatHp()
    {
        return $this->stat_hp;
    }

    public function setStatStrength($stat_strength)
    {
        $this->stat_strength = $stat_strength;
    }

    public function getStatStrength()
    {
        return $this->stat_strength;
    }

    public function setUserCoins($user_coins)
    {
        $this->user_coins = $user_coins;
    }

    public function getUserCoins()
    {
        return $this->user_coins;
    }

    public function setUserExperience($user_experience)
    {
        $this->user_experience = $user_experience;
    }

    public function getUserExperience()
    {
        return $this->user_experience;
    }
}
