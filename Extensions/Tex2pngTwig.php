<?php

namespace Gregwar\Tex2pngBundle\Extensions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\TwigFunction;

/**
 * Tex2pngTwig extension
 *
 * @author Gregwar <g.passault@gmail.com>
 */
class Tex2pngTwig extends \Twig_Extension
{
	private $container;


	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}


	public function getFunctions()
	{
		return [
			'tex'     => new TwigFunction('tex', [$this, 'tex']),
			'tex_img' => new TwigFunction('tex_img', [$this, 'tex_img']),
		];
	}


	public function tex($tex, $density = 155)
	{
		return $this->container->get('tex2png')->create($tex, $density)->generate();
	}


	public function tex_img($tex, $density = 155)
	{
		return $this->tex($tex, $density)->html();
	}


	public function getName()
	{
		return 'tex2png';
	}
}

