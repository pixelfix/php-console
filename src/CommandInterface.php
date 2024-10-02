<?php

namespace PixelFix\Console;

interface CommandInterface
{
	public function execute(array $args = []): int;

	public static function getName(): string;
}
