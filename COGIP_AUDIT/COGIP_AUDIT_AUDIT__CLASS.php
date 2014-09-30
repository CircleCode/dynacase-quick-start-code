<?php

namespace COGIP;

use \Dcp\AttributeIdentifiers\COGIP_AUDIT_AUDIT as MyAttributes;

Class COGIP_AUDIT_AUDIT extends \Dcp\Family\COGIP_AUDIT_BASE {

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
    }

}