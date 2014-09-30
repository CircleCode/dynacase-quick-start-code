<?php

namespace COGIP;

class COGIP_AUDIT_FNC__WFL extends \Dcp\Family\WDoc
{
    public $attrPrefix = 'caaf';
    public $firstState = self::e_brouillon;
    public $viewlist = "none";

    //region MyAttributes-constants
    //endregion

    //region States
    /* @stateLabel _("coa_fnc_e1") */
    const e_brouillon = 'coa_fnc_e1';
    /* @stateLabel _("coa_fnc_e2") */
    const e_planifie = 'coa_fnc_e2';
    /* @stateLabel _("coa_fnc_e3") */
    const e_clos = 'coa_fnc_e3';
    //endregion

    //region Transitions
    /* @stateLabel _("coa_fnc_t1") */
    const t_brouillon__planifie = 'co_fnc_t1';

    /* @stateLabel _("coa_fnc_t2") */
    const t_planifie__brouillon = 'co_fnc_t2';

    /* @stateLabel _("coa_fnc_t3") */
    const t_planifie__clos = 'coa_fnct3';

    //endregion

    public $stateactivity = array(
        /* @stateLabel _("coa_fnc:writing") */
        self::e_brouillon => "coa_fnc:writing",
        /* @stateLabel _("coa_fnc:implementation of corrective actions") */
        self::e_planifie => "coa_fnc:implementation of corrective actions"
    );


    public $transitions = array(
        self::t_brouillon__planifie => array("nr" => true),
        self::t_planifie__brouillon => array("nr" => true),
        self::t_planifie__clos => array("nr" => true),
    );

    public $cycle = array(
        array("t" => self::t_brouillon__planifie, "e1" => self::e_brouillon, "e2" => self::e_planifie),
        array("t" => self::t_planifie__brouillon, "e1" => self::e_planifie, "e2" => self::e_brouillon),
        array("t" => self::t_planifie__clos, "e1" => self::e_planifie, "e2" => self::e_clos)
    );

}

?>