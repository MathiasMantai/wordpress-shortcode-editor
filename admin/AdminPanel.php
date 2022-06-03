<?php 

class AdminPanel() {
    private $db;

    function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        add_action('admin_enqueue_scripts', 'loadCSS');
        add_action('admin_enqueue_scripts', 'loadJS');
        add_action('admin_menu', 'createAdminPanel');
    }

    public function createAdminPanel() {
        add_menu_page('Shortcode Editor', 'Shortcode Editor', 10, __FILE__, 'adminPanelLayout');
    }

    private function adminPanelLayout() {
        $shortcodes = $this->getShortcodes();
        print '<div class="shortcode-editor-admin-panel-main">
                <h1>Shortcode Editor</h1>
                <div class="shortcode-editor-admin-panel-card">
                <table class="shortcode-editor-admin-panel-table"><thead><tr></tr></thead><tbody class="test">';
        foreach($shortcodes as $shortcode) {
            print '<tr><td class="test">' . $shortcode->label . '</td><td class="test">' . $shortcode->shortcode . '</td><td><button role="button" onclick="javascript:changeShortcode('.$shortcode->id.')">Ändern</button></tr>';
        }
        print '</tbody></table></div>';
        print '<form method="POST" action="'.esc_html(admin_url('shortcode-editor.php')).'">';
        print '<input type="text"><input type="submit">';
        print '</form>';
        print '</div>';
    }

    private function loadJS() {
        wp_enqueue_script('admin', plugin_dir_url(__FILE__) . '/admin/admin.js', array('jquery'), '', false);
    }

    private function loadCSS() {
        wp_register_style( 'shortcode-editor-admin', plugin_dir_url( __FILE__ ) . '/admin/adminstyle.css');
        wp_enqueue_style('shortcode-editor-admin');
    }

    private function getShortcodes() {
        return $this->db->get_results("SELECT * FROM `".$this->db->prefix."shortcode-editor` WHERE 1=1");
    }
}

?>