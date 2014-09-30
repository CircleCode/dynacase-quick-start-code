<?php

namespace COGIP;

use \Dcp\AttributeIdentifiers\COGIP_AUDIT_REFERENTIEL as MyAttributes;

Class COGIP_AUDIT_REFERENTIEL extends \Dcp\Family\COGIP_AUDIT_BASE {


    public function preDelete()
    {
        $msg = parent::preDelete();
        $msg .= $this->checkIfAssociatedChapterExist();
        return $msg;
    }

    /**
     * Check if exist chapter associated to the current referentiel
     *
     * @return string
     */
    public function checkIfAssociatedChapterExist()
    {
        $return = "";
        $search = new \SearchDoc("", "COGIP_AUDIT_CHAPITRE");
        $search->addFilter("%s = '%d'",
            \Dcp\AttributeIdentifiers\COGIP_AUDIT_CHAPITRE::cac_ref,
            $this->getPropertyValue("initid")
        );
        $search->setSlice(1);
        $nb = $search->onlyCount();
        if ($nb > 0) {
            $return = ___("You have to delete all associated chapter before delete the ref", "COGIP_AUDIT:REFERENTIEL");
        }
        return $return;
    }

}