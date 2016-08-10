<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\Sprite\Generators;

use Maslosoft\Sprite\Interfaces\SpriteGeneratorInterface;
use Maslosoft\Sprite\Traits\CollectionAwareTrait;
use Maslosoft\Sprite\Traits\ConfigurationAwareTrait;

/**
 * ImgGenerator
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class ImgGenerator implements SpriteGeneratorInterface
{

	use ConfigurationAwareTrait,
	  CollectionAwareTrait;

	public function generate()
	{
		$collection = $this->getCollection();
		$config = $this->getConfig();

		$sprite = imagecreatetruecolor($collection->width, $collection->height);
		imagesavealpha($sprite, true);
		$transparent = imagecolorallocatealpha($sprite, 0, 0, 0, 127); //127 not 100
		imagefill($sprite, 0, 0, $transparent);
		foreach ($collection->getGroups() as $group)
		{
			$top = 0;
			foreach ($group->sprites as $image)
			{
				$img = '';
				$path = $image->getFullPath();
				switch ($image->type)
				{
					case 'png':
						$img = imagecreatefrompng($path);
						break;
					case 'jpg':
						$img = imagecreatefromjpeg($path);
						break;
					case 'gif':
						$img = imagecreatefromgif($path);
						break;
					default:
						continue;
						break;
				}
				if (empty($img))
				{
					continue;
				}
				imagecopy($sprite, $img, $group->offset, $top, 0, 0, $image->width, $image->height);
				$top += $image['height'];
			}
		}

		$filename = sprintf('%s/%s.png', $config->generatedPath, $config->basename);
		imagepng($sprite, $filename);
		imagedestroy($sprite);
	}

}
