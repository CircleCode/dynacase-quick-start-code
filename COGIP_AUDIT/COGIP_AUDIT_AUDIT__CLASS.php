<?php

namespace COGIP;

use \Dcp\AttributeIdentifiers\COGIP_AUDIT_AUDIT as MyAttributes;

Class COGIP_AUDIT_AUDIT extends \Dcp\Family\COGIP_AUDIT_BASE {

    /**
     * Hook executed after the refresh
     *
     * @return string
     */
    public function postRefresh()
    {
        $err = parent::postRefresh();
        $err .= $this->checkEndDate();
        return $err;
    }

    public function postStore()
    {
        $err = parent::postStore();
        $err .= $this->computeFNC();
        if ($err) {
            error_log(__FILE__ . ":" . __LINE__ . ":" . __METHOD__ . " " . $err . "\n");
        }
    }

    public function postDuplicate(&$copyFrom)
    {
        $err = parent::postDuplicate($copyFrom);
        $err .= $this->cleanDate();
        if ($err) {
            error_log(__FILE__ . ":" . __LINE__ . ":" . __METHOD__ . " " . $err . "\n");
        }
    }

    /**
     * Compute the title of the audit family
     *
     * @return string
     */
    public function getCustomTitle()
    {
        //Get the attr cac_titre value
        $title = $this->getAttributeValue(MyAttributes::caa_titre);
        //Get the prefix
        $prefixe = $this->getFamilyParameterValue("caa_p_title_prefix");
        // Compose the title
        return sprintf("%s_%s", $prefixe, $title);
    }

    /**
     * Check if the date is inferior to today
     *
     * @param string $date iso date
     * @return string|null
     */
    public function checkBeginningDate($date)
    {
        if (!empty($date) && $date <= date("c")) {
            return _("coa:The date must be after today");
        }
        return null;
    }

    /**
     * Check if the end date is in the past
     *
     * @return string
     */
    public function checkEndDate()
    {
        $err = "";
        $date = $this->getAttributeValue(MyAttributes::caa_date_fin);
        if (!empty($date)
            && $this->getPropertyValue("state") === COGIP_AUDIT_AUDIT__WFL::e_brouillon
            && $this->getAttributeValue(MyAttributes::caa_date_fin) < new \DateTime()) {
            $err = ___("The end date of the audit is in the past", "COGIP_AUDIT:AUDIT");
        }
        return $err;
    }

    /**
     * Compute end date
     *
     * @param string $dateDebut iso
     * @param int $duree nb days
     * @return string
     */
    public function computeDateFin($dateDebut, $duree)
    {
        if (!empty($dateDebut) && !empty($duree)) {
            $date = new \DateTime($dateDebut);
            $interval = \DateInterval::createFromDateString(sprintf('%d day', $duree));
            $date->add($interval);
            return $date->format("o-m-d");
        }
        return " ";
    }

    /**
     * Compute the FNC attributes content
     *
     * @return string
     */
    public function computeFNC()
    {
        $err = "";
        $fncs = array();
        $search = new \SearchDoc('', 'COGIP_AUDIT_FNC');
        $search->setObjectReturn();
        $search->addFilter("%s = '%d'",
            \Dcp\AttributeIdentifiers\COGIP_AUDIT_FNC::caf_audit,
            $this->getPropertyValue("initid")
        );
        foreach ($search->getDocumentList() as $currentFNC) {
            /* @var \Dcp\Family\COGIP_AUDIT_FNC $currentFNC */
            $fncs[] = $currentFNC->getPropertyValue("initid");
        }
        $err .= $this->setValue(MyAttributes::caa_fnc_fnc, $fncs);
        if ($err) {
            $err = __FILE__ . ":" . __LINE__ . ":" . __METHOD__ . " " . $err . "\n";
        }
        return $err;
    }

    /**
     * Clean constat date
     *
     * @return string
     */
    public function cleanDate()
    {
        $err = "";
        $err .= $this->clearValue(MyAttributes::caa_date_debut);
        $err .= $this->clearValue(MyAttributes::caa_date_fin);
        $err .= $this->clearValue(MyAttributes::caa_duree);
        if ($err) {
            $err = __FILE__ . ":" . __LINE__ . ":" . __METHOD__ . " " . $err . "\n";
        }
        return $err;
    }

}