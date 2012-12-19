<?php if(sfConfig::get('app_sbExternalLinkClick_enabled', false)): ?>
<?php a_js_call('sbExternalLinkClickTrack(?)', url_for('@sb_external_link_click_save')); ?>
<?php endif; ?>
