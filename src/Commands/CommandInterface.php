<?php namespace Hampel\SynergyWholesale\Commands;

interface CommandInterface
{
	public function getCommand();

	/**
	 * @return array    			the array of key-value pairs to sent for the command
	 */
	public function build();
}