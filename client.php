<?php
namespace client\discordphp;
class Bot
{
	public $token;
	function __construct($token)
	{
		$this->token = $token;
	}

	public function getHeaderToken()
	{
		return ["Authorization: Bot ".$this->token, "Content-Type: application/json"];
	}

	public function CreateWebhook($channel_id, $username)
	{
		$js = json_encode(array("name" => $username));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://discord.com/api/channels/".$channel_id."/webhooks");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $js);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaderToken());
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
		$php = curl_exec($ch);
		$arrayName = array();
		array_push($arrayName, $php->token);
		array_push($arrayName, $php->id);
		return $arrayName;
	}
	public function send($app_id, $app_token, $content)
	{
		$js = json_encode(array("content" => $content));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://discord.com/api/webhooks/".$app_id."/".$app_token);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $js);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaderToken());
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
		$php = curl_exec($ch);
		return $php;
	}
	public function sendfromurl($webhook_url, $content)
	{
		$js = json_encode(array("content" => $content));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $webhook_url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $js);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaderToken());
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
		$php = curl_exec($ch);
		return $php;
	}
	public function sendembedfromurl($webhook_url, $username,$title = null, $description = null, $author_name = null, $author_url = null, $url = null)
	{

		$embed = array("embeds" => array(["author" => ["name" => $author_name, "url" => $author_url, "icon_url" => $author_icon_url],"title" => $title, "description" => $description, "url" => $url, "color" => hexdec(ff00ff), ]));
		
		$js = json_encode($embed);
		echo $js;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $webhook_url);
		curl_setopt($ch, CURLOPT_POST, true);		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $js);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaderToken());
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
		$php = curl_exec($ch);
		return $php;
	}
}