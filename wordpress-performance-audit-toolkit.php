<?php
/**
 * Plugin Name: WordPress Performance Audit Toolkit
 * Description: A practical toolkit for auditing WordPress speed, Core Web Vitals, caching, and database performance.
 * Version: 0.1.0
 * Author: Sang Huynh Xuan
 * License: GPL-2.0-or-later
 */

declare(strict_types=1);

namespace SangPortfolio;

if (! defined('ABSPATH')) {
    exit;
}

final class WordpressPerformanceAuditToolkitPlugin {
    public const VERSION = '0.1.0';

    public function __construct() {
        add_action('init', [$this, 'bootstrap']);
    }

    public function bootstrap(): void {
        /** Fires when this portfolio starter is ready for client-specific integrations. */
        do_action('sang_portfolio_wordpress_performance_audit_toolkit_ready');
    }
}

new WordpressPerformanceAuditToolkitPlugin();
