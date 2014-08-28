<?php 
namespace Adapter;
class Helper {
	public static function writeln($message, $type = "success")
	{
		if ($type == 'success') {
            $result = <<< RESULT
           echo "\033[1;32m[^.^]::{$message}\033[0m"
RESULT;
			system($result);
        } else {
            $result = <<< RESULT
           echo "\033[1;31m[^_^]::{$message}\033[0m"
RESULT;
			system($result);
			exit();
        }

        
	}
}
?>