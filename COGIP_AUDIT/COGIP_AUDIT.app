<?php

$app_desc = array(
    "name" => "COGIP_AUDIT",
    "short_name" => N_("COGIP_AUDIT:COGIP_AUDIT"),
    "description" => N_("COGIP_AUDIT:COGIP_AUDIT"),
    "icon" => "COGIP_AUDIT.png",
    "displayable" => "N",
    "childof" => ""
);

$app_acl = array(
    array(
        "name" => "BASIC",
        "description" => N_("coa:basic access"),
        "group_default" => "Y"
    )
);

/* Actions for this application */
$action_desc = array(
    array(
        "name" => "MAIN",
        "short_name" => N_("coa:main interface"),
        "script" => "action.main.php",
        "function" => "main",
        "layout" => "main.html",
        "root" => "Y",
        "acl" => "BASIC"
    ),
    array(
        "name" => "DOCUMENT_LIST",
        "short_name" => N_("coa:document list"),
        "script" => "action.document_list.php",
        "function" => "document_list",
        "layout" => "document_list.html",
        "acl" => "BASIC"
    )
);

