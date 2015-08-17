<?php

/**
 * This software package is licensed under `AGPL, Commercial` license[s].
 *
 * @package maslosoft/sprite
 * @license AGPL, Commercial
 *
 * @copyright Copyright (c) Peter Maselkowski <pmaselkowski@gmail.com>
 *
 */

namespace Maslosoft\Sprite\Application;

use Maslosoft\Sprite\Commands\GenerateCommand;
use Maslosoft\Sprite\Generator;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Command\Command;

/**
 * Application
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Application extends ConsoleApplication
{

	/**
	 * Logo
	 * font: slant
	 */
	const Logo = <<<LOGO
   _____            _ __
  / ___/____  _____(_) /____
  \__ \/ __ \/ ___/ / __/ _ \
 ___/ / /_/ / /  / / /_/  __/
/____/ .___/_/  /_/\__/\___/
    /_/

LOGO;

	public function __construct()
	{
		parent::__construct('Sprite', (new Generator)->getVersion());
	}

	public function getHelp()
	{
		return self::Logo . parent::getHelp();
	}

}
