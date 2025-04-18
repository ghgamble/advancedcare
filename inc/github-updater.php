<?php
add_filter('pre_set_site_transient_update_themes', 'advancedcare_github_theme_update');

function advancedcare_github_theme_update($transient) {
    $theme_slug = 'advancedcare';
    $repo_owner = 'ghgamble';
    $repo_name  = 'advancedcare';

    $headers = [
        'User-Agent' => 'AdvancedCare-Updater'
    ];

    // Optional: use GitHub token if defined
    if (defined('GITHUB_TOKEN') && GITHUB_TOKEN) {
        $headers['Authorization'] = 'token ' . GITHUB_TOKEN;
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
            'package'     => "https://github.com/$repo_owner/$repo_name/releases/download/{$release->tag_name}/advancedcare.zip",
        ];
    }

    return $transient;
}

add_filter('upgrader_source_selection', 'advancedcare_github_theme_source_selection', 10, 3);
function advancedcare_github_theme_source_selection($source, $remote_source, $upgrader) {
    global $wp_filesystem;
    $theme_slug = 'advancedcare';

    if (strpos($source, $theme_slug) !== false) {
        $corrected_source = trailingslashit($remote_source) . $theme_slug;
        $wp_filesystem->move($source, $corrected_source);
        return $corrected_source;
    }

    return $source;
}
