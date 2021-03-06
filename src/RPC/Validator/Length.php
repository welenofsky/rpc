<?php

namespace RPC\Validator;

use RPC\Validator;


class Length extends Validator
{
	
	protected $min;
	
	protected $max;
	
	function __construct( $min = 0, $max = 0, $errormessage = '' )
	{
		$this->max = $max;
		$this->min = $min;
		
		parent::__construct( $errormessage );
	}
	
	/**
	 * Returns true if its length is greater than $min and less than
	 * $max, false otherwise. If one of the given values is 0 it is not taken
	 * into consideration anymore.
	 * 
	 * @param mixed $value
	 * @return bool
	 */
	public function validate( $value )
	{
		if( $this->min == 0 &&
		    $this->max == 0 )
		{
			throw new \Exception( 'Illegal arguments' );
		}
		
		$length = strlen( $value );
		
		$valid_min = ( $this->min <= $length );
		$valid_max = ( $length <= $this->max );

		if( $this->min == -1 )
		{
			$valid_min = true;
		}

		if( $this->max == -1 )
		{
			$valid_max = true;
		}

		return ( $valid_min && $valid_max );
	}
	
}

?>
