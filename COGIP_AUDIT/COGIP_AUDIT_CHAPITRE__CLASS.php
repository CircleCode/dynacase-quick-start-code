<?php

namespace COGIP;

use \Dcp\AttributeIdentifiers\COGIP_AUDIT_CHAPITRE as MyAttributes;

Class COGIP_AUDIT_CHAPITRE extends \Dcp\Family\COGIP_AUDIT_BASE {

    /**
     * Compute the title of the chapter family
     *
     * @return string
     */
    public function getCustomTitle()
    {
        //Get the attr cac_titre value
        $title = $this->getAttributeValue(MyAttributes::cac_titre);
        //Get the title of the referenced referentiel
        $chapterTitle = $this->getTitle($this->getAttributeValue(MyAttributes::cac_ref));
        // Compose the title
        return sprintf("%s : %s", $chapterTitle, $title);
    }

}