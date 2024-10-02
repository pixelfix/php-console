<?php

namespace PixelFix\Console\Commands;

use PixelFix\Console\CommandInterface;

class Substraction implements CommandInterface
{
	private static string $name = 'math:subtraction';

	public function execute(array $args = []): int
	{
		$total = $args[0] - $args[1];

		echo "The total is: {$total}" . PHP_EOL;

		return 0;
	}

	public static function getName(): string
	{
		return static::$name;
	}
}
