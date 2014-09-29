<?php
namespace Dcp\Family {
	/**   */
	class Cogip_audit_fnc extends \COGIP\COGIP_AUDIT_FNC { const familyName="COGIP_AUDIT_FNC";}
}

namespace Dcp\AttributeIdentifiers {
	/**   */
	class Cogip_audit_fnc extends Cogip_audit_base {
		/** [frame] Descriptif */
		const caf_f_descriptif='caf_f_descriptif';
		/** [text] Titre */
		const caf_titre='caf_titre';
		/** [docid("COGIP_AUDIT_AUDIT")] Audit */
		const caf_audit='caf_audit';
		/** [account] Rédacteur */
		const caf_redacteur='caf_redacteur';
		/** [tab] Écarts */
		const caf_t_ecart='caf_t_ecart';
		/** [frame] Écarts */
		const caf_f_ecart='caf_f_ecart';
		/** [array] Écarts */
		const caf_a_ecart='caf_a_ecart';
		/** [docid("COGIP_AUDIT_REFERENTIEL")] Référentiel */
		const caf_ecart_ref='caf_ecart_ref';
		/** [docid("COGIP_AUDIT_CHAPITRE")] Chapitre */
		const caf_ecart_chapitre='caf_ecart_chapitre';
		/** [longtext] Ecart */
		const caf_ecart_ecart='caf_ecart_ecart';
		/** [tab] Actions */
		const caf_t_action='caf_t_action';
		/** [frame] Actions */
		const caf_f_action='caf_f_action';
		/** [array] Actions */
		const caf_a_action='caf_a_action';
		/** [longtext] Descriptif */
		const caf_action_desc='caf_action_desc';
		/** [text] Responsable */
		const caf_action_resp='caf_action_resp';
		/** [date] Date de prise en compte */
		const caf_action_date='caf_action_date';
	}
}
