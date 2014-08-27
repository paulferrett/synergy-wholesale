<?php  namespace SynergyWholesale\Responses; 

use SynergyWholesale\Types\UsAppPurpose;
use SynergyWholesale\Types\UsNexusCategory;

class GetUsNexusDataResponse extends Response
{
	protected $expectedFields = array(
		'nexusCategory', 'nexusApplication',
	);

	public function getNexusCategory()
	{
		return new UsNexusCategory($this->response->nexusCategory);
	}

	public function getNexusCategoryString()
	{
		return strval($this->getNexusCategory());
	}

	public function getNexusApplication()
	{
		return new UsAppPurpose($this->response->nexusApplication);
	}

	public function getNexusApplicationString()
	{
		return strval($this->getNexusApplication());
	}
}

?>
 