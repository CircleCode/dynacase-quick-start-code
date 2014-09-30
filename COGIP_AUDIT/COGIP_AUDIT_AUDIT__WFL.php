<?php

namespace COGIP;

class COGIP_AUDIT_AUDIT__WFL extends \Dcp\Family\WDoc
{
    public $attrPrefix = 'caaw';
    public $firstState = self::e_brouillon;
    public $viewlist = "none";

    //region MyAttributes-constants
    //endregion

    //region States
    /* @stateLabel _("coa_e1") */
    const e_brouillon = 'coa_e1';
    /* @stateLabel _("coa_e2") */
    const e_annule = 'coa_e2';
    /* @stateLabel _("coa_e3") */
    const e_redaction = 'coa_e3';
    /* @stateLabel _("coa_e4") */
    const e_certifie = 'coa_e4';
    /* @stateLabel _("coa_e5") */
    const e_refus_certif = 'coa_e5';
    //endregion

    //region Transitions
    /* @stateLabel _("coa_t1") */
    const t_brouillon__redaction = 'coa_t1';
    /* @stateLabel _("coa_t2") */
    const t_brouillon__annule = 'coa_t2';
    /* @stateLabel _("coa_t3") */
    const t_redaction__brouillon = 'coa_t3';
    /* @stateLabel _("coa_t4") */
    const t_redaction__certif = 'coa_t4';
    /* @stateLabel _("coa_t5") */
    const t_redaction__refus_certif = 'coa_t5';
    //endregion

    public $stateactivity = array(
        /* @stateLabel _("coa_planning") */
        self::e_brouillon => "coa_planning",
        /* @stateLabel _("coa_writing") */
        self::e_redaction => "coa_writing"
    );

    public $transitions = array(
        self::t_brouillon__redaction => array("nr" => true),
        self::t_brouillon__annule => array("nr" => true,
            "ask" => array("caaw_raison"),
            "m2" => "handleRaison"
        ),
        self::t_redaction__brouillon => array("nr" => true),
        self::t_redaction__certif => array("nr" => true, "m0" => "checkAssociatedFNC"),
        self::t_redaction__refus_certif => array("nr" => true, "m0" => "checkAssociatedFNC"),
    );

    public $cycle = array(
        array("t" => self::t_brouillon__redaction, "e1" => self::e_brouillon, "e2" => self::e_redaction),
        array("t" => self::t_brouillon__annule, "e1" => self::e_brouillon, "e2" => self::e_annule),
        array("t" => self::t_redaction__brouillon, "e1" => self::e_redaction, "e2" => self::e_brouillon),
        array("t" => self::t_redaction__certif, "e1" => self::e_redaction, "e2" => self::e_certifie),
        array("t" => self::t_redaction__refus_certif, "e1" => self::e_redaction, "e2" => self::e_refus_certif),
    );

    public function checkAssociatedFNC()
    {
        //Search in the FNC
        $searchDoc = new \SearchDoc("", \Dcp\Family\Cogip_audit_fnc::familyName);
        //If you find one FNC it's enough (speed the search)
        $searchDoc->setSlice(1);
        $searchDoc->addFilter("%s = '%d'", \Dcp\AttributeIdentifiers\Cogip_audit_fnc::caf_audit, $this->doc->getPropertyValue("initid"));
        $searchDoc->addFilter("state <> '%s'", COGIP_AUDIT_FNC__WFL::e_clos);
        if ($searchDoc->onlyCount() > 0) {
            return _("coa:You have to close all FNC before change state");
        }
        return "";
    }

    public function handleRaison()
    {
        $this->doc->addHistoryEntry($this->getRawValue("caaw_raison"));
    }

}
