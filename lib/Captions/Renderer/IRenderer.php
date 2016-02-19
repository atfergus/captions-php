<?PHP
namespace Captions\Renderer;

interface IRenderer
{
	public function render(\Captions\Set $caption_set, $file = false);
}
