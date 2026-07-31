<?php
declare(strict_types=1);
namespace SangPortfolio;
if (! defined('ABSPATH')) { exit; }
final class WordpressPerformanceAuditToolkitFeature {
    private const OPTION = 'wordpress_performance_audit_toolkit_enabled';
    private const SLUG = 'wordpress-performance-audit-toolkit';
    private const TITLE = 'WordPress Performance Audit Toolkit';
    public function register(): void {
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_menu', [$this, 'registerPage']);
        if (Support::enabled(self::OPTION)) { $this->registerFeature(); }
    }
    public function registerSettings(): void { register_setting(self::SLUG, self::OPTION, ['sanitize_callback' => static fn($value): string => empty($value) ? '0' : '1']); }
    public function registerPage(): void { add_options_page(self::TITLE, self::TITLE, 'manage_options', self::SLUG, [$this, 'renderPage']); }
    public function renderPage(): void { if (! current_user_can('manage_options')) { return; } echo '<div class="wrap"><h1>' . esc_html(self::TITLE) . '</h1><form method="post" action="options.php">'; settings_fields(self::SLUG); echo '<label><input type="checkbox" name="' . esc_attr(self::OPTION) . '" value="1" ' . checked(Support::enabled(self::OPTION), true, false) . '> ' . esc_html__('Enable feature', 'sang-portfolio') . '</label>'; submit_button(); echo '</form></div>'; }
    private function registerFeature(): void { add_action('admin_notices', [$this, 'renderAuditNotice']); }
    public function renderAuditNotice(): void { if (! current_user_can('manage_options')) { return; } $checks = ['home' => get_option('show_on_front') !== '', 'permalinks' => get_option('permalink_structure') !== '', 'discourage_search' => ! get_option('blog_public')]; $passing = count(array_filter($checks)); echo '<div class="notice notice-info"><p><strong>Performance audit:</strong> ' . esc_html((string) $passing) . '/3 baseline checks passed. Open Tools → ' . esc_html(self::TITLE) . ' for implementation notes.</p></div>'; }
}
