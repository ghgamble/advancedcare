<?php
add_filter('pre_set_site_transient_update_themes', 'advancedcare_github_theme_update');

function advancedcare_github_theme_update($transient) {
    $theme_slug = 'advancedcare';
    $repo_owner = 'ghgamble';
    $repo_name  = 'advancedcare';

    // Load token from config.php inside theme
    $config_path = get_template_directory() . '/config.php';
    $token = '';
    if (file_exists($config_path)) {
        $config = include $config_path;
        $token = isset($config['github_token']) ? $config['github_token'] : '';
    }

    $headers = [
        'User-Agent' => 'AdvancedCare-Updater'
    ];

    if (!empty($token)) {
        $headers['Authorization'] = 'token ' . $token;
    }

    $response = wp_remote_get(
        "https://api.github.com/repos/$repo_owner/$repo_name/releases/latest",
        ['headers' => $headers]
    );

    if (is_wp_error($response)) return $transient;

    $release = json_decode(wp_remote_retrieve_body($response));
    if (empty($release) || empty($release->tag_name)) return $transient;

    $new_version = str_replace('v', '', $release->tag_name);
    $theme = wp_get_theme($theme_slug);
    $current_version = $theme->get('Version');

    if (version_compare($current_version, $new_version, '<')) {
        $transient->response[$theme_slug] = [
            'theme'       => $theme_slug,
            'new_version' => $new_version,
            'url'         => $release->html_url,
            'package'     => "https://github.com/$repo_owner/$repo_name/releases/download/{$release->tag_name}/advancedcare-v{$new_version}.zip",
        ];
    }

    return $transient;
}
