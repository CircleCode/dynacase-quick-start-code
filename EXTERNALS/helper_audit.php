<?php

function selectReferentiel($caf_audit, $userInput = "")
{

    $return = array();
    // Get the audit doc with the id
    $audit = new_Doc("", $caf_audit, true);
    if (!$audit->isAlive()) {
        return _("coa:You need to select an audit before");
    }
    // Get the referentiel doc
    $auditReferentiel = $audit->getAttributeValue(\Dcp\AttributeIdentifiers\COGIP_AUDIT_AUDIT::caa_ref);

    if (is_array($auditReferentiel)) {
        $auditReferentiel = implode(",", $auditReferentiel);
    }

    // Search the associated referentiel
    $searchDoc = new \SearchDoc("", "COGIP_AUDIT_REFERENTIEL");
    $searchDoc->setObjectReturn();
    /* @var $auditReferentiel \COGIP\COGIP_AUDIT_AUDIT */
    //Add a filter to select only the referentiel in the audit
    if (!empty($auditReferentiel)) {
        $searchDoc->addFilter("id in (%s)", $auditReferentiel);
    }
    //Add a filter on the title that take the userInput
    if (!empty($userInput)) {
        $searchDoc->addFilter("title ~* '%s'", preg_quote($userInput));
    }

    $htmlUserInput = htmlentities($userInput);
    foreach ($searchDoc->getDocumentList() as $currentRef) {
        /* @var $currentRef \COGIP\COGIP_AUDIT_AUDIT */
        $enhancedTitle = $currentRef->getHTMLTitle();
        if (!empty($userInput)) {
            //Enhance the title to emphasize the userInput
            $enhancedTitle = str_replace($userInput, "<strong>$htmlUserInput</strong>", $currentRef->getHTMLTitle());
        }
        //Set the return value
        $return[] = array(
            $enhancedTitle,
            $currentRef->getPropertyValue("initid"),
            $currentRef->getTitle()
        );
    }

    return $return;
}

function selectChapter($caf_referentiel, $userInput = "")
{
    if (empty($caf_referentiel)) {
        return _("coa:You need to select a referentiel");
    }

    $return = array();

    // Search the associated referentiel
    $searchDoc = new \SearchDoc("", "COGIP_AUDIT_CHAPITRE");
    $searchDoc->setObjectReturn();
    /* @var $auditReferentiel \COGIP\COGIP_AUDIT_CHAPITRE */
    //Add a filter to select only the referentiel in the audit
    $searchDoc->addFilter("cac_ref = '%s'", $caf_referentiel);
    //Add a filter on the title that take the userInput
    if (!empty($userInput)) {
        $searchDoc->addFilter("title ~* '%s'", preg_quote($userInput));
    }

    $htmlUserInput = htmlentities($userInput);
    foreach ($searchDoc->getDocumentList() as $currentRef) {
        /* @var $currentRef \COGIP\COGIP_AUDIT_CHAPITRE */
        $enhancedTitle = $currentRef->getHTMLTitle();
        if (!empty($userInput)) {
            //Enhance the title to emphasize the userInput
            $enhancedTitle = str_replace($userInput, "<strong>$htmlUserInput</strong>", $currentRef->getHTMLTitle());
        }
        //Set the return value
        $return[] = array(
            $enhancedTitle,
            $currentRef->getPropertyValue("initid"),
            $currentRef->getTitle()
        );
    }

    return $return;
}