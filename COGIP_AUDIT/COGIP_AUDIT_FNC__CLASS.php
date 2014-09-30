<?php

namespace COGIP;

use \Dcp\AttributeIdentifiers\COGIP_AUDIT_FNC as MyAttributes;

Class COGIP_AUDIT_FNC extends \Dcp\Family\COGIP_AUDIT_BASE {

    /**
     * Hook executed after the store
     *
     * @return string|void
     */
    public function postStore()
    {
        $err = parent::postStore();
        $err .= $this->refreshAudit();
        if ($err) {
            error_log(__FILE__ . ":" . __LINE__ . ":" . __METHOD__ . " " . $err . "\n");
        }
    }

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

    /**
     * -   Refresh the list of the audit
     *
     * @return string
     */
    public function refreshAudit()
    {
        $err = "";
        $audit = $this->getAttributeValue(MyAttributes::caf_audit);
        $audit = new_Doc("", $audit, true);
        /* @var \Dcp\Family\COGIP_AUDIT_AUDIT $audit */
        $err .= $audit->computeFNC();
        $err .= $audit->store();
        if ($err) {
            $err = __FILE__ . ":" . __LINE__ . ":" . __METHOD__ . " " . $err . "\n";
        }
        return $err;
    }

}