<?php

use Base\License as BaseLicense;

/**
 * Skeleton subclass for representing a row from the 'license' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class License extends BaseLicense
{
    /* (non-PHPdoc)
     * @see \Base\License::setLicensenumber()
     */
    public function setLicensenumber($l) {
		if (strlen($l) == 0) {
			throw new Exception("License number cannot be null or empty");
		} else {
			parent::setLicensenumber($l);
		}
	}
}
