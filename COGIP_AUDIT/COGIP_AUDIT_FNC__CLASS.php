<?php

namespace COGIP;

use \Dcp\AttributeIdentifiers\COGIP_AUDIT_FNC as MyAttributes;

Class COGIP_AUDIT_FNC extends \Dcp\Family\COGIP_AUDIT_BASE {

    /**
     * Compute the title of the FNC family
     *
     * @return string
     */
    public function getCustomTitle()
    {
        //Get the attr caf_titre value
        $title = $this->getAttributeValue(MyAttributes::caf_titre);
        //Get the title of the referenced audit
        $chapterTitle = $this->getTitle($this->getAttributeValue(MyAttributes::caf_audit));
        // Compose the title
        return sprintf("%s : %s", $chapterTitle, $title);
    }

}