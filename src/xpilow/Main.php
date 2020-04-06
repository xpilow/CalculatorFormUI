<?php

namespace xpilow;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\Config;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info(C::GREEN . "[Enabled] Plugin CalculatorUI By RezaG");
    }

    public function onLoad(){
        $this->getLogger()->info(C::YELLOW . "[Loading] Plugin Sedang Loading");
    }

    public function onDisable(){
        $this->getLogger()->info(C::RED . "[Disable] Plugin Terdapat Error / Butuh FormAPI");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "cal":
                if($sender instanceof Player){
                    if($sender->hasPermission("calculator.ui")){
                        $this->CalculatorUI($sender);
                        return true;
                    }else{
                        $sender->sendMessage("§cKamu Tidak Mempunyai Permissions");
                        return true;
                    }

                }else{
                    $sender->sendMessage("§cGunakan Command Dalam Game!");
                    return true;
                } 
        }
    }

    public function CalculatorUI($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $this->Tambah($sender);
                break;
                case 1:
                    $this->Kurang($sender);
                break;
                case 2:
                    $this->Kalian($sender);
                break;
                case 3:
                    $this->Bagian($sender);
                break;
                case 4:
                    $sender->sendMessage("§aSemangat yah belajar §cMatematikan§anya By §bRezaG§2!");
                break;

                }
            });
            $form->setTitle("§6§kiii§r§8CalculatorUI§6§kiii§r");
            $form->setContent("Pilih beberapa menu berikut!");
            $form->addButton("TAMBAH §7(§a+§7)",0,"textures/ui/feedIcon");
            $form->addButton("KURANG §7(§a-§7)",0,"textures/ui/feedIcon");
            $form->addButton("KALIAN §7(§ax§7)",0,"textures/ui/feedIcon");
            $form->addButton("BAGIAN §7(§a/§7)",0,"textures/ui/feedIcon");
            $form->addButton("CONFIRM");
            $form->sendToPlayer($sender);
            return $form;
    }

    public function Tambah($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 + $angka2;
                       $sender->sendMessage("§l§5-(●)>> §aNih hasilnya§f: §7(§b" . $hasil . "§7)");
				    }
				});
				$form->setTitle("Tambah §7(§a+§7)");
				$form->addLabel("Silakan Ketiklah Sesuka Hati!");
				$form->addInput("Angka Pertama:", "§f1");
				$form->addInput("Angka Kedua:", "§f1");
				$form->sendToPlayer($sender);
    }

    public function Kurang($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 - $angka2;
                       $sender->sendMessage("§l§5-(●)>> §aNih hasilnya§f: §7(§b" . $hasil . "§7)");
				    }
				});
				$form->setTitle("Kurang §7(§a-§7)");
				$form->addLabel("Silakan Ketiklah Sesuka Hati!");
				$form->addInput("Angka Pertama:", "§f1");
				$form->addInput("Angka Kedua:", "§f1");
				$form->sendToPlayer($sender);
    }

    public function Kalian($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 * $angka2;
                       $sender->sendMessage("§l§5-(●)>> §aNih hasilnya§f: §7(§b" . $hasil . "§7)");
				    }
				});
				$form->setTitle("Kalian §7(§ax§7)");
				$form->addLabel("Silakan Ketiklah Sesuka Hati!");
				$form->addInput("Angka Pertama:", "§f1");
				$form->addInput("Angka Kedua:", "§f1");
				$form->sendToPlayer($sender);
    }

    public function Bagian($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 / $angka2;
                       $sender->sendMessage("§l§5-(●)>> §aNih hasilnya§f: §7(§b" . $hasil . "§7)");
				    }
				});
				$form->setTitle("Bagian §7(§a/§7)");
				$form->addLabel("Silakan Ketiklah Sesuka Hati!");
				$form->addInput("Angka Pertama:", "§f1");
				$form->addInput("Angka Kedua:", "§f1");
				$form->sendToPlayer($sender);
    }
}
