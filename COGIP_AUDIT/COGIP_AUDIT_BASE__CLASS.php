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

    /** Total edition */

    /**
     * Controller of total admin
     *
     * @templateController
     */
    public function edit_admin()
    {
        if ($this->userIsAdmin()) {
            //Choice of the default zone (FDL:EDITBODYCARD)
            $message = _("coa:Admin edition : beware !");
            $css = <<<CSS
.normal::before {
    display: block;
    width: 100%;
    text-align: center;
    content: "$message";
    color: red;
    font-size: 2em;
}
CSS;
            global $action;
            /* @var \Action $action */
            $action->parent->addCssCode($css);
            $zonebodycard = "FDL:EDITBODYCARD";
            $attributes = $this->getAttributes();
            foreach ($attributes as $currentAttribute) {
                /* @var \NormalAttribute $currentAttribute */
                if (is_a($currentAttribute, "NormalAttribute") && $currentAttribute->mvisibility !== "I") {
                    $currentAttribute->setVisibility("W");
                }
            }
            $this->lay->set("DOCUMENT", $this->viewDoc($zonebodycard));
            return;
        }
        $this->lay->set("DOCUMENT", "<h1>You cannot access to this page</h1>");
    }

    /**
     * Compute if user have the admin role
     *
     * @return bool
     */
    protected function userIsAdmin()
    {
        global $action;

        if ($action->user->id === 1) {
            return true;
        }
        $roles = $action->user->getAllRoles();
        foreach ($roles as $currentRole) {
            if (strtolower($currentRole["login"]) === "role_admin_fonctionnel") {
                return true;
            }
        }
        return false;
    }


    /**
     *    Compute menu visibility
     *
     *    @return int
     */
    public function visibilityAdminMenu()
    {
        if ($this->userIsAdmin()) {
            return MENU_ACTIVE;
        } else {
            return MENU_INVISIBLE;
        }
    }
}