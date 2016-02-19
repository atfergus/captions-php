<?PHP
namespace Captions\Renderer;

interface IRenderer
{
	public function render($caption_set, $file = false);
}
