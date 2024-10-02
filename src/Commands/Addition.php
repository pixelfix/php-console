<?php

namespace PixelFix\Console\Commands;

use PixelFix\Console\CommandInterface;

class Addition implements CommandInterface
{
	private static string $name = 'math:addition';

	public function execute(array $args = []): int
	{
		$total = 0;

		foreach ($args as $value) {
			$total += $value;
		}

		echo "The total is: {$total}" . PHP_EOL;

		return 0;
	}

	public static function getName(): string
	{
		return static::$name;
	}
}
