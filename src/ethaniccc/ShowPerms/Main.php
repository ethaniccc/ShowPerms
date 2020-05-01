<?php

declare(strict_types=1);

namespace ethaniccc\ShowPerms;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

    private $perms = array();

    public function onEnable(){
        $perms = $this->getServer()->getPluginManager()->getPermissions();
        $this->perms = $perms;
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        switch($command->getName()){
            case "showperms":
                $perms = $this->perms;
                if($sender instanceof Player){
                    $sender->sendMessage(TextFormat::RED . "You must run this command through console!");
                } else {
                    $this->getLogger()->info(TextFormat::GREEN . "Here are all of the permission nodes: ");
                    $permArray = $this->getServer()->getPluginManager()->getPermissions(); //Gets all permissions objects
                    $permName_DescArray = NULL;
                    $INDEX = 0;
                    foreach($permArray as $perm)
                    {
                        $permName_DescArray[$INDEX] = TextFormat::DARK_PURPLE."Permission: ".TextFormat::GREEN.$perm->getName().TextFormat::YELLOW." Description: ".$perm->getDescription(); //Message parsing
                        $INDEX++;
                    }
                    $this->getServer()->getLogger()->info(implode(" \n ",$permName_DescArray));
                }
            break;
        }
        return true;
    }

}
