<?php
namespace Dcp\Family {
	/**   */
	class Cogip_audit_chapitre extends \COGIP\COGIP_AUDIT_CHAPITRE { const familyName="COGIP_AUDIT_CHAPITRE";}
}

namespace Dcp\AttributeIdentifiers {
	/**   */
	class Cogip_audit_chapitre extends Cogip_audit_base {
		/** [frame] Descriptif */
		const cac_f_desc='cac_f_desc';
		/** [text] Titre */
		const cac_titre='cac_titre';
		/** [docid("COGIP_AUDIT_REFERENTIEL")] Référentiel */
		const cac_ref='cac_ref';
		/** [htmltext] Contenu */
		const cac_content='cac_content';
	}
}
