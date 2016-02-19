<?PHP
namespace Captions\Renderer;

class SrtRenderer
	implements IRenderer
{
	public function render(\Captions\Set $caption_set, $file = false)
	{
		$captions = array();

		foreach($caption_set->captions() as $index => $caption)
		{
			$captions[] = sprintf("%d\n%s --> %s\n%s",
				$index+1,
				\Captions\Helper\SrtHelper::time_to_string($caption->start()),
				\Captions\Helper\SrtHelper::time_to_string($caption->end()),
				$caption->text()
			);
		}

		$string = implode("\n\n", $captions);

		if($file)
			return file_put_contents($file, $string);
		else
			return $string;
	}
}
