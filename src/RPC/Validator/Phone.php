<?php

namespace RPC\Validator;

use RPC\Validator;

/**
 * Validates a phone number
 * 
 * @package Validate
 */
class Phone extends Validator
{
	
	/**
	 * Country code
	 * 
	 * @var string
	 */
	protected $country;

	/**
	 * TRUE, if the validator has to validate the US area code
	 * 
	 * @var bool
	 */
	protected $validateUsAreaCode;
	
	/**
	 * Sets the country code and error message
	 * 
	 * @param string $country
	 * @param string $errormessage
	 */
	function __construct( $country = 'RO', $errormessage = '', $validateUsAreaCode = false )
	{
		$this->country = $country;
		$this->validateUsAreaCode = $validateUsAreaCode;
		parent::__construct( $errormessage );
	}
	
	/**
	 * Returns value if it is a valid phone number format, FALSE
	 * otherwise. The optional second argument indicates the country.
	 * 
	 * @param mixed $value
	 * 
	 * @return mixed
	 */
	public function validate( $value )
	{
		switch( $this->country )
		{
			case 'RO':
				return ctype_digit( $value );
				break;
			case 'US':
				$number = preg_replace( '/[^\d]/', '', $value );
				
				if( strlen( $number ) != 10 )
				{
					return false;
				}
				
				$areaCode = substr( $number, 0, 3 );
				
				$areaCodes = array
				(
					201, 202, 203, 204, 205, 206, 207, 208,
					209, 210, 212, 213, 214, 215, 216, 217,
					218, 219, 224, 225, 226, 228, 229, 231,
					234, 239, 240, 242, 246, 248, 250, 251,
					252, 253, 254, 256, 260, 262, 264, 267,
					268, 269, 270, 276, 281, 284, 289, 301,
					302, 303, 304, 305, 306, 307, 308, 309,
					310, 312, 313, 314, 315, 316, 317, 318,
					319, 320, 321, 323, 325, 330, 334, 336,
					337, 339, 340, 345, 347, 351, 352, 360,
					361, 386, 401, 402, 403, 404, 405, 406,
					407, 408, 409, 410, 412, 413, 414, 415,
					416, 417, 418, 419, 423, 424, 425, 430,
					432, 434, 435, 438, 440, 441, 443, 445,
					450, 469, 470, 473, 475, 478, 479, 480,
					484, 501, 502, 503, 504, 505, 506, 507,
					508, 509, 510, 512, 513, 514, 515, 516,
					517, 518, 519, 520, 530, 540, 541, 555,
					559, 561, 562, 563, 564, 567, 570, 571,
					573, 574, 580, 585, 586, 600, 601, 602,
					603, 604, 605, 606, 607, 608, 609, 610,
					612, 613, 614, 615, 616, 617, 618, 619,
					620, 623, 626, 630, 631, 636, 641, 646,
					647, 649, 650, 651, 660, 661, 662, 664,
					670, 671, 678, 682, 684, 700, 701, 702,
					703, 704, 705, 706, 707, 708, 709, 710,
					712, 713, 714, 715, 716, 717, 718, 719,
					720, 724, 727, 731, 732, 734, 740, 754,
					757, 758, 760, 763, 765, 767, 769, 770,
					772, 773, 774, 775, 778, 780, 781, 784,
					785, 786, 787, 800, 801, 802, 803, 804,
					805, 806, 807, 808, 809, 810, 812, 813,
					814, 815, 816, 817, 818, 819, 822, 828,
					829, 830, 831, 832, 833, 835, 843, 844,
					845, 847, 848, 850, 855, 856, 857, 858,
					859, 860, 863, 864, 865, 866, 867, 868,
					869, 870, 876, 877, 878, 888, 900, 901,
					902, 903, 904, 905, 906, 907, 908, 909,
					910, 912, 913, 914, 915, 916, 917, 918,
					919, 920, 925, 928, 931, 936, 937, 939,
					940, 941, 947, 949, 951, 952, 954, 956,
					959, 970, 971, 972, 973, 978, 979, 980,
					985, 989
				);
				
				if( $this->validateUsAreaCode && ! in_array( $areaCode, $areaCodes ) )
				{
					return false;
				}
				
				return $areaCode .
				       '-' .
				       substr( $number, 3, 3 ) .
				       '-' .
				       substr( $number, 6, 4 );
				break;
			default:
				break;
		}
		
		return false;
	}
	
}

?>
