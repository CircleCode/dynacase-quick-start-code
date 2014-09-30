<?php

namespace COGIP;

use \Dcp\AttributeIdentifiers\COGIP_AUDIT_BASE as MyAttributes;

Class COGIP_AUDIT_BASE extends \Dcp\Family\Document {

    public function preEdition()
    {
        $err = parent::preEdition();
        $this->addCSS();
        return $err;
    }

    public function preConsultation()
    {
        $err = parent::preConsultation();
        $this->addCSS();
        return $err;
    }

    /**
     * Inject a CSS
     */
    public function addCSS()
    {
        global $action;
        $action->parent->addCssRef("COGIP_AUDIT:specRefresh.css");
    }

}