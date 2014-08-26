<?php 
namespace Adapter;
class Filedata {
	public static function setData($data)
	{
		$nowData = static::getData();
		$nowData[$data['key']] = $data;

		$handle = fopen(static::getLogPath(),"w");
		fwrite($handle, json_encode($nowData));
		fclose($handle);
	}

	public static function getData()
	{
		$data = array();
		$logFile = static::getLogPath();
		if (is_file($logFile)) {
			$data = json_decode(file_get_contents($logFile), true);
		}

		return $data;
	}

	public static function getLogPath()
	{
		return DATABASEPATH;
	}
}