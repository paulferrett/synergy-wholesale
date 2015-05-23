<?php namespace SynergyWholesale\Commands;

interface Command
{
	/**
	 * @return array    the array of key-value pairs to send for the command
	 */
	public function getRequestData();
}
