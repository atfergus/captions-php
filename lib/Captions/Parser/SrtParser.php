<?PHP
namespace Captions\Parser;

class SrtParser
	implements IParser
{
	protected $_captions_string;

	public function __construct($content)
	{
		// Remove any BOM from the file
		$this->_captions_string = str_replace(pack("CCC",0xef,0xbb,0xbf), "", $content);
	}

	public function parse()
	{
		$split_regex = "/(\d)+[\r|\n][\r\n]?(\d{2}:\d{2}:\d{2},\d{3}) --> (\d{2}:\d{2}:\d{2},\d{3})[\r\n]{1,2}/";

		$pieces = preg_split($split_regex, $this->_captions_string, -1, PREG_SPLIT_DELIM_CAPTURE);

		if(count($pieces) < 4) throw new \Captions\Parser\Exception("Parse Error: Split created no captions");

		$first = $pieces[0];

		if(empty($pieces[0])) array_shift($pieces);

		$captions = new \Captions\Set;

		for($i=0, $j = count($pieces); $i<$j; $i+=4)
		{
			$caption = new \Captions\Caption;
			$caption->start(\Captions\Helper\SrtHelper::string_to_time($pieces[$i+1]));
			$caption->end(\Captions\Helper\SrtHelper::string_to_time($pieces[$i+2]));
			$caption->text(trim($pieces[$i+3]));

			$captions->add_caption($caption);
		}

		$captions->renderer(new \Captions\Renderer\SrtRenderer);

		return $captions;
	}
}
