<?php

namespace PixelFix\Console;

use DirectoryIterator;

class Application
{
	private array $commands = [];
	private array $args = [];
	private string $commandName = '';

	public function __construct(private string $namespace, private array $argv) {}

	public function run(): int
	{
		$this->registerCommands();
		$this->parseOptions();

		if (!array_key_exists($this->commandName, $this->commands)) {
			throw new CommandException('Command not found');
		}

		$command = $this->commands[$this->commandName];

		$commandInstance = new $command;

		if (!($commandInstance instanceof CommandInterface)) {
			throw new CommandException('Command is not implementing the correct interface.');
		}

		$status = $commandInstance->execute($this->args);

		return $status;
	}

	private function registerCommands(): void
	{
		$commandFiles = new DirectoryIterator(__DIR__ . '/Commands');

		foreach ($commandFiles as $commandFile) {
			if (!$commandFile->isFile()) {
				continue;
			}

			$command = $this->namespace . pathinfo($commandFile, PATHINFO_FILENAME);
			$commandName = $command::getName();

			$this->commands[$commandName] = $command;
		}
	}

	private function parseOptions(): void
	{
		if (!isset($this->argv[1])) {
			throw new CommandException('Command not provided.');
		}

		$this->commandName = $this->argv[1];

		$this->args = array_slice($this->argv, 2);
	}
}
