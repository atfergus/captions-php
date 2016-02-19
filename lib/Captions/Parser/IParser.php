<?PHP
namespace Captions\Parser;

interface IParser
{
	public function __construct($content);
	public function parse();
}
