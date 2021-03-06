<?PHP
namespace Captions\Helper;

class SrtHelper extends Helper
{
	public static function string_to_time($string)
	{
		list($hours, $minutes, $seconds, $milliseconds) = preg_split("[:|,]", $string);
		return self::make_time($hours, $minutes, $seconds, $milliseconds);
	}

	public static function time_to_string($time)
	{
		// Let's hardcode hack this floating point bitch
		$time = (string) $time;
		$time = (float) $time;

		$hours = floor($time/60/60);

		$minutes = floor(($time/60) % 60);

		$seconds = floor($time % 60);

		$milliseconds = (float) ($time * 1000) % 1000;

		return sprintf("%02d:%02d:%02d,%03d", $hours, $minutes, $seconds, $milliseconds);
	}

	public static function is_srt($string)
	{
		return preg_match("/^(\d)+[\r|\n][\r\n]?(\d{2}:\d{2}:\d{2},\d{3}) --> (\d{2}:\d{2}:\d{2},\d{3})[\r\n]{1,2}/", $string);
	}
}
