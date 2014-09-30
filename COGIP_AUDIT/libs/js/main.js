!function () {
    $(window).ready(function () {
        var $mainDoc = $("#main-doc"), $mainSection = $(".css-doc-section"), $mainTabBar = $(".css-main-tab-bar"),
            setCurrentDocument, getDocumentList;
        /**************************************************************************************************************/
        /** Utilities                                                                                                **/
        /**************************************************************************************************************/
        /**
         * Set the current document in the main iframe
         * @param hash
         */
        setCurrentDocument = function (hash) {
            var doc = $mainDoc[0].contentDocument || $mainDoc[0].contentWindow.document,
                currentInitid = $(doc).find("[name=document-initid]").attr("content");
            if (hash && currentInitid !== hash) {
                $mainDoc.attr("src", "?app=FDL&action=OPENDOC&mode=view&latest=Y&id=" + encodeURIComponent(hash));
            }
        };
        /**
         * Get the document list with a post XHR
         */
        getDocumentList = function () {
            var data = {}, $form = $(".js-list-form");
            if ($form.length > 0) {
                data = $form.serialize();
            }
            $.post("?app=COGIP_AUDIT&action=DOCUMENT_LIST", data)
                .done(function (data) {
                    var $data = $(data);
                    $data.find(".js-list-form").on("submit", function (event) {
                        event.preventDefault();
                        getDocumentList();
                    });
                    $(".js-document-list").html($data);
                })
                .fail(function (event) {
                    console.log("Unable to get document list");
                    console.log(event);
                });
        };
        /**************************************************************************************************************/
        /** Events                                                                                                   **/
        /**************************************************************************************************************/
        /**
         * Add the create document event
         */
        $(".js-create-button").on("click", function (event) {
            event.preventDefault();
            if (event.currentTarget.href) {
                $("#main-doc").attr("src", event.currentTarget.href);
            }
        });
        /**
         * Listen the load event of the main iframe, update the docTitle
         */
        $mainDoc.on("load", function () {
            var doc = $mainDoc[0].contentDocument || $mainDoc[0].contentWindow.document,
                title = doc.title || "",
                initid = $(doc).find("[name=document-initid]").attr("content");
            $(".js-current-frame-title").text(title);
        });
        /**
         * Add a listener for the upper left audit button
         */
        $(".js-audits").on("click", function (event) {
            event.preventDefault();
            $(".js-document-menu").trigger("click");
        });
        /**
         * Add a listener for the disconnect button
         * Send the hidden disconnect form when there is a click on the button
         */
        $(".js-disconnect").on("click", function (event) {
            event.preventDefault();
            $("#disconnect").submit();
        });
        /**
         * Resize main element to take all the space
         */
        $(function () {
            var timer;
            $(window).resize(function () {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    var offset = $(".js-main").offset(), size = $(window).height() - offset.top;
                    $('.inner-wrap').css("min-height", size + "px");
                    size = size - $mainTabBar.outerHeight();
                    $mainSection.height(size);
                    $mainDoc.height($mainSection.innerHeight() - 5);
                }, 40);
            }).resize();
        });
        /**
         * Handle events on the audit list
         */
        $(".js-document-list").on("click", ".js-doc-link",function (event) {
            event.preventDefault();
            if (event.currentTarget.href) {
                $("#main-doc").attr("src", event.currentTarget.href);
            }
        }).on("click", ".js-button-list-form",function (event) {
            event.preventDefault();
            getDocumentList();
        }).on("click", ".js-previous",function (event) {
            var $previous = $(event.currentTarget), $offset;
            event.preventDefault();
            if (!$previous.hasClass("unavailable")) {
                $offset = $("[name=offset]");
                $offset.val($offset.val() - 1);
                getDocumentList();
            }
        }).on("click", ".js-next", function (event) {
            var $previous = $(event.currentTarget), $offset;
            event.preventDefault();
            if (!$previous.hasClass("unavailable")) {
                $offset = $("[name=offset]");
                $offset.val($offset.val() + 1);
                getDocumentList();
            }
        });
        /**************************************************************************************************************/
        /** Initialisation                                                                                           **/
        /**************************************************************************************************************/
        /**
         * Use the hash to open a selected document
         */
        if (window.location.hash) {
            var hash = window.location.hash.slice(1);
            setCurrentDocument(hash);
        } else {
            $(".js-document-menu").trigger("click");
        }

        //Get the initial document list
        getDocumentList();
        //Init the foundation framework
        $(document).foundation();

    });
}();

